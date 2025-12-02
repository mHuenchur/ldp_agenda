<?php

namespace app\core\controller;

use app\core\controller\base\InterfaceController;
use app\core\controller\base\Controller;
use app\core\service\CategoriaService;
use app\libs\response\Response;
use app\libs\request\Request;
use Dompdf\Dompdf;

final class CategoriaController extends Controller implements InterfaceController{

    public function __construct()
    {
        parent::__construct([
            "public/app/js/categoria/categoriaController.js",
            "public/app/js/categoria/categoriaService.js"
        ]);
    }
    // BUSCA EL INICIO DE LA VISTA CORRESPONDIENTE
    public function index(Request $request, Response $response): void{
        $service = new CategoriaService();
        $listadoCategorias = $service->list();
        $this->view = "categoria/index.php";
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
        $service = new CategoriaService();
        $valores = $request->getData();
        $valores["usuario_id"] = $_SESSION["id"];
        $service->save($valores);
        $response->setMessage("La categoria se registró correctamente");
        $response->send();
    }
    // BUSCA LA VISTA DE EDITAR UNA ENTIDAD EXISTENTE EN EL SISTEMA
    public function edit(Request $request, Response $response): void{
        $service = new CategoriaService();
        $categoria = $service->load($request->getId())->toArray();
        $this->view = "categoria/edit.php";
        require_once APP_TEMPLATE . "template.php";
    }
    // BUSCA LA VISTA DE EDITAR UNA ENTIDAD EXISTENTE EN EL SISTEMA
    public function update(Request $request, Response $response): void{
        $service = new CategoriaService();
        $service->update($request->getData());
        $response->setMessage("La categoria se actualizo correctamente");
        $response->send();
    }
    //GESTIONA LA ELIMINACION DE UNA ENTIDAD DEL SISTEMA
    public function delete(Request $request, Response $response): void{
        
    }

    public function pdf(Request $request, Response $response){

        $categoria = new CategoriaService();

        $listadoCategorias = $categoria->list();
        $html = "";
        if (!empty($listadoCategorias)) {
            $count = 1;
            foreach ($listadoCategorias as $categoria) {
                $html .= '<tr>
                            <td class="col-num">'. $count.'</td>
                            <td class="col-nombre">'. $categoria["nombre"] .'</td>
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
                                <title>Listado de categorías</title>
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
                                    }

                                    th {
                                        background-color: #eee;
                                        font-weight: bold;
                                        text-align: left;
                                    }

                                    .col-num {
                                        width: 30px;
                                        text-align: center;
                                    }

                                    .col-nombre {
                                        width: 35%;
                                    }

                                    .col-descripcion {
                                        width: 45%;
                                    }

                                    .col-extra {
                                        width: 20%;
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

                                <h1>Listado de categorías</h1>
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
                                            <th class="col-nombre">Nombre</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        '. $html. '
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
        $dompdf->stream('ListadoCategorias.pdf', [
            'Attachment' => 0, // 0 = mostrar en el navegador, 1 = descargar
        ]);
    }

}