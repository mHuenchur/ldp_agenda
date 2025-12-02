<?php

namespace app\core\controller;

use app\core\controller\base\InterfaceController;
use app\core\controller\base\Controller;
use app\core\service\ContactoService;
use app\core\service\RecordatorioService;
use app\libs\response\Response;
use app\libs\request\Request;
use Dompdf\Dompdf;

final class RecordatorioController extends Controller implements InterfaceController{

    public function __construct()
    {
        parent::__construct([
            "public/app/js/recordatorio/recordatorioController.js",
            "public/app/js/recordatorio/recordatorioService.js",
        ]);
    }
    // BUSCA EL INICIO DE LA VISTA CORRESPONDIENTE
    public function index(Request $request, Response $response): void{
        $serviceContactos = new ContactoService();
        $listadoContactos = $serviceContactos->list();

        $serviceRecordatorio = new RecordatorioService();
        $listadoVigentes = $serviceRecordatorio->listarVigentes();
        $listadoVencidos = $serviceRecordatorio->listarVencidos();
        $this->view = "recordatorio/index.php";
        require_once APP_TEMPLATE . "template.php";
    }
    // BUSCA UN ELEMENTO EN PARTICULAR
    public function load(Request $request, Response $response): void{

    }
    // BUSCA LA VISTA DE CREAR UNA NUEVA ENTIDAD
    public function create(Request $request, Response $response): void{

    }
    // GESTIONA EL GUARDADO DE UNA NUEVA ENTIDAD EN EL SISTEMA
    public function save(Request $request, Response $response): void{
        $service = new RecordatorioService();
        $valores = $request->getData();
        $valores["usuario_id"] = $_SESSION["id"];
        //guardar recordatorio
        $valorRecordatorio = $service->save($valores);

        $response->setMessage("El recordatorio se registro correctamente");

        //GUARDAR RELACION RECORDATORIO CONTACTOS

        $contactos = $valores["contactos"];
        foreach ($contactos as $contacto) {
            $contacto["recordatorio_id"] = $valorRecordatorio;
            $service->guardarRelacion($contacto);
        }
        $response->send();
    }
    // BUSCA LA VISTA DE EDITAR UNA ENTIDAD EXISTENTE EN EL SISTEMA
    public function edit(Request $request, Response $response): void{
        $serviceContactos = new ContactoService();
        $listadoContactos = $serviceContactos->list();


        $serviceRecordatorio = new RecordatorioService();
        $recordatorio = $serviceRecordatorio->load($request->getId())->toArray();

        $listadoRelacion = $serviceRecordatorio->listarRelacion($request->getId());
        $this->view = "recordatorio/edit.php";
        require_once APP_TEMPLATE . "template.php";
    }
    // BUSCA LA VISTA DE EDITAR UNA ENTIDAD EXISTENTE EN EL SISTEMA
    public function update(Request $request, Response $response): void{
        $service = new RecordatorioService();
        $valores = $request->getData();
        //guardar recordatorio
        $service->update($valores);
        $response->setMessage("El recordatorio se actualizo correctamente");
        //elimino relaciones anteriores
        $service->eliminarRelacion($valores["id"]);
        //guardo nuevas relaciones
        $contactos = $valores["contactos"];
        foreach ($contactos as $contacto) {
            $contacto["recordatorio_id"] = $valores["id"];
            $service->guardarRelacion($contacto);
        }
        $response->send();
    }
    //GESTIONA LA ELIMINACION DE UNA ENTIDAD DEL SISTEMA
    public function delete(Request $request, Response $response): void{
        
    }

    public function pdf(Request $request, Response $response){

        $serviceRecordatorio = new RecordatorioService();
        $listadoVigentes = $serviceRecordatorio->listarVigentes();

        $html = "";
        if (!empty($listadoVigentes)) {
            $count = 1;
            foreach ($listadoVigentes as $recordatorio) {
                $html .= '<tr>
                            <td class="col-num">'. $count .'</td>
                            <td class="col-desc">
                            '. $recordatorio["nombre"]. '
                            </td>
                            <td class="col-fecha">
                            '. date('d/m/Y H:i', strtotime($recordatorio["fecha_hora"])). '
                            </td>
                            <td class="col-lugar">
                            '. $recordatorio["lugar"]. '
                            </td>
                        </tr>';
            $count++;
            }
         }

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $dompdf->loadHtml('<!DOCTYPE html>
                            <html lang="es">
                            <head>
                                <meta charset="UTF-8">
                                <title>Listado de recordatorios</title>
                                <style>
                                    body {
                                        font-family: DejaVu Sans, sans-serif;
                                        font-size: 11pt;
                                        margin: 20px;
                                    }

                                    h1 {
                                        font-size: 18pt;
                                        margin: 0 0 5px 0;
                                    }

                                    .subtitulo {
                                        font-size: 10pt;
                                        color: #555;
                                        margin-bottom: 15px;
                                    }

                                    .meta {
                                        font-size: 9pt;
                                        color: #777;
                                        margin-bottom: 10px;
                                    }

                                    table {
                                        width: 100%;
                                        border-collapse: collapse;
                                        margin-top: 8px;
                                    }

                                    th, td {
                                        border: 1px solid #444;
                                        padding: 4px 6px;
                                        vertical-align: top;
                                    }

                                    th {
                                        background-color: #eee;
                                        font-weight: bold;
                                        text-align: left;
                                    }

                                    .col-num {
                                        width: 25px;
                                        text-align: center;
                                    }

                                    .col-desc {
                                        width: 35%;
                                    }

                                    .col-fecha {
                                        width: 18%;
                                        text-align: center;
                                    }

                                    .col-lugar {
                                        width: 25%;
                                    }

                                    .col-contactos {
                                        width: 12%;
                                        text-align: center;
                                    }

                                    .footer {
                                        margin-top: 20px;
                                        font-size: 8pt;
                                        color: #777;
                                        text-align: right;
                                    }
                                </style>
                            </head>
                            <body>

                                <h1>Listado de recordatorios</h1>
                                <div class="subtitulo">
                                    Usuario: '. $_SESSION["usuario"] .'
                                </div>

                                <div class="meta">
                                    Generado el: '. date("d/m/Y") .'
                                </div>

                                <table>
                                <thead>
                                    <tr>
                                        <th class="col-num">#</th>
                                        <th class="col-desc">Descripción</th>
                                        <th class="col-fecha">Fecha y hora</th>
                                        <th class="col-lugar">Lugar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                '. $html .'
                                </tbody>
                                </table>

                                <div class="footer">
                                    Sistema de Agenda Web
                                </div>

                            </body>
                            </html>
                            ');

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream('ListadoRecordatorios.pdf', [
            'Attachment' => 0, // 0 = mostrar en el navegador, 1 = descargar
        ]);
    }

}