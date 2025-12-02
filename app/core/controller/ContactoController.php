<?php

namespace app\core\controller;

use app\core\controller\base\InterfaceController;
use app\core\controller\base\Controller;
use app\core\service\CategoriaService;
use app\core\service\ContactoService;
use app\core\service\TelefonoService;
use app\core\service\TipoService;
use app\libs\response\Response;
use app\libs\request\Request;
use Dompdf\Dompdf;

final class ContactoController extends Controller implements InterfaceController{

    public function __construct()
    {
        parent::__construct([
            "public/app/js/contacto/contactoController.js",
            "public/app/js/contacto/contactoService.js",
        ]);
    }
    // BUSCA EL INICIO DE LA VISTA CORRESPONDIENTE
    public function index(Request $request, Response $response): void{
        $service = new ContactoService();
        $categoria = new CategoriaService();
        $tipo = new TipoService();
        $this->scripts[] = "public/app/js/contacto/listado.js";
        $listadoCategorias = $categoria->list();
        $listadoTipos = $tipo->list();
        $listadoContactos = $service->list();
        $this->view = "contacto/index.php";
        require_once APP_TEMPLATE . "template.php";
    }
    // BUSCA UN ELEMENTO EN PARTICULAR
    public function load(Request $request, Response $response): void{

    }
    // BUSCA LA VISTA DE CREAR UNA NUEVA ENTIDAD
    public function create(Request $request, Response $response): void{
        $tipo = new TipoService();
        $categoria = new CategoriaService();
        $listadoTipos = $tipo->list();
        $listadoCategorias = $categoria->list();
        $this->scripts[] = "public/app/js/contacto/formContacto.js";
        $this->view = "contacto/create.php";
        require_once APP_TEMPLATE . "template.php";
    }
    // GESTIONA EL GUARDADO DE UNA NUEVA ENTIDAD EN EL SISTEMA
    public function save(Request $request, Response $response): void{
        $service = new ContactoService();
        $valores = $request->getData();
        $valores["usuario"] = $_SESSION["id"];
        $valorContacto = $service->save($valores);
        $response->setMessage("El contacto se registro correctamente");
        //GUARDAR LOS TELEFONOS
        $serviceTelefono = new TelefonoService();
        $telefonos = $valores["telefonos"];
        foreach ($telefonos as $telefono) {
            $telefono["contacto_id"] = $valorContacto;
            $serviceTelefono->save($telefono);
        }
        $response->send();
    }
    // BUSCA LA VISTA DE EDITAR UNA ENTIDAD EXISTENTE EN EL SISTEMA
    public function edit(Request $request, Response $response): void{
        $service = new ContactoService();
        $serviceTipo = new TipoService();
        $serviceCategoria = new CategoriaService();
        $serviceTelefono = new TelefonoService();

        $contacto = $service->load($request->getId())->toArray();

        $listadoTelefonos = $serviceTelefono->listByContacto($contacto["id"]);

        $listadoTipos = $serviceTipo->list();

        $listadoCategorias = $serviceCategoria->list();

        $this->view = "contacto/edit.php";
        $this->scripts[] = "public/app/js/contacto/formContacto.js";
        require_once APP_TEMPLATE . "template.php";
    }
    // BUSCA LA VISTA DE EDITAR UNA ENTIDAD EXISTENTE EN EL SISTEMA
    public function update(Request $request, Response $response): void{
        $serviceTelefono = new TelefonoService();
        $serviceContacto = new ContactoService();

        $valores = $request->getData();
        $serviceTelefono->delete($valores["id"]);

        $serviceContacto->update($valores);
        $response->setMessage("El contacto se actualizo correctamente");

        $serviceTelefono = new TelefonoService();
        $telefonos = $valores["telefonos"];
        foreach ($telefonos as $telefono) {
            $telefono["contacto_id"] = $valores["id"];
            $serviceTelefono->save($telefono);
        }
        $response->send();
    }
    //GESTIONA LA ELIMINACION DE UNA ENTIDAD DEL SISTEMA
    public function delete(Request $request, Response $response): void{
        
    }

    public function filter(Request $request, Response $response): void{
        $service = new ContactoService();
        $listadoFiltrado = $service->filter($request->getData());
        $tbody = "";
        if (!empty($listadoFiltrado)) {
            $count = 1;
            foreach ($listadoFiltrado as $contacto) {
                $row = "<tr>";
                $row .= "<th scope='row'>". $count ."</th>";
                if ($contacto["tipo_id"] == 1) {
                $row .= "<td>". $contacto["apellido"] . " " . $contacto["nombre"] ."</td>";
                } else {
                $row .= "<td>". $contacto["razon_social"] ."</td>";
                }
                $row .= "<td>". $contacto["direccion"] ."</td>";
                $row .= "<td>". $contacto["email"] ."</td>";
                $row .= '<td>'. '<a id="" class="btn btn-warning mx-1" href="contacto/edit/'. $contacto["id"]. '">Modificar</a><a id="" class="btn btn-danger mx-1" href="">Eliminar</a>' .'</td>';
                $row .= "</tr>";
                $tbody .= $row;
                $count++;
            }
        }
        $response->setResult($tbody);
        $response->send();
    }

    public function pdf(Request $request, Response $response){
        $service = new ContactoService();
        $listadoContactos = $service->list();

        $serviceCategoria = new CategoriaService();
        $listadoCategorias = $serviceCategoria->list();

        $html = "";
        if (!empty($listadoContactos)) {
            $count = 1;
            foreach ($listadoContactos as $contacto) {
                if ($contacto["razon_social"] == "") {
                    $valorTipo = $contacto["apellido"]. " " .$contacto["nombre"];
                    $valorFecha = date('d/m/Y', strtotime($contacto["fecha_nacimiento"]));
                } else {
                    $valorTipo = $contacto["razon_social"];
                    $valorFecha = "-";
                }
                foreach ($listadoCategorias as $categoria) {
                    if ($categoria["id"] == $contacto["categoria_id"]) {
                        $valorCategoria = $categoria["nombre"];
                    }
                }
                $html .= '<tr>
                            <td class="col-num">'. $count .'</td>
                            <td class="col-nombre">'. $valorTipo .'</td>
                            <td class="col-fecha">'. $valorFecha .'</td>
                            <td class="col-direccion">'. $contacto["direccion"] .'</td>
                            <td class="col-email">'. $contacto["email"] .'</td>
                            <td class="col-web">'. $contacto["sitio_web"] .'</td>
                            <td class="col-categoria">'. $valorCategoria .'</td>
                            <td class="col-obs">'. $contacto["observaciones"] .'.</td>
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
                                <title>Listado de contactos</title>
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

                                <h1>Listado de contactos</h1>
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
                                        <th class="col-nombre">Nombre / Razón social</th>
                                        <th class="col-fecha">F. nac.</th>
                                        <th class="col-direccion">Dirección</th>
                                        <th class="col-email">Email</th>
                                        <th class="col-web">Sitio web</th>
                                        <th class="col-categoria">Categoría</th>
                                        <th class="col-obs">Observaciones</th>
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
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream('ListadoCategorias.pdf', [
            'Attachment' => 0, // 0 = mostrar en el navegador, 1 = descargar
        ]);
    }

    public function contactoPDF(Request $request, Response $response){
        $service = new ContactoService();
        $serviceTipo = new TipoService();
        $serviceCategoria = new CategoriaService();
        $serviceTelefono = new TelefonoService();

        $contacto = $service->load($request->getId())->toArray();

        $listadoTelefonos = $serviceTelefono->listByContacto($contacto["id"]);
        $listadoTipos = $serviceTipo->list();
        $listadoCategorias = $serviceCategoria->list();

        if ($listadoTipos[0]["id"] == $contacto["tipo_id"]) {
            $dataTipo = $listadoTipos[0]["nombre"];
        } else {
            $dataTipo = $listadoTipos[1]["nombre"];
        }
        foreach ($listadoCategorias as $categoria) {
            if ($categoria["id"] == $contacto["categoria_id"]) {
                $dataCategoria = $categoria["nombre"];
            }
        }
        $telefonos = '';
        if (!empty($listadoTelefonos)) {
            foreach ($listadoTelefonos as $telefono) {
                $telefonos .= '<tr>
                                    <td>'.$telefono["etiqueta"].'</td>
                                    <td>'.$telefono["numero"].'</td>
                                </tr>';
            }
        }

        $tr = '';
        if ($contacto["razon_social"] == "") {
            $tr .= '<tr>
                        <th>Nombre</th>
                        <td>'. $contacto["nombre"] .'</td>
                    </tr>
                    <tr>
                        <th>Apellido</th>
                        <td>'. $contacto["apellido"] .'</td>
                    </tr>
                    <tr>
                        <th>Fecha de nacimiento</th>
                        <td>
                            '. date('d/m/Y', strtotime($contacto["fecha_nacimiento"])) .'
                        </td>
                    </tr>';
        } else {
            $tr = '<tr>
                        <th>Razón social</th>
                        <td>'. $contacto["razon_social"] .'</td>
                    </tr>';
        }
        

        $dompdf = new Dompdf();
        $dompdf->loadHtml('<!DOCTYPE html>
                            <html lang="es">
                            <head>
                                <meta charset="UTF-8">
                                <title>Detalle de contacto</title>
                                <style>
                                    body {
                                        font-family: DejaVu Sans, sans-serif;
                                        font-size: 11pt;
                                        margin: 20px;
                                    }

                                    h1 {
                                        font-size: 18pt;
                                        margin: 0 0 8px 0;
                                    }

                                    .subtitulo {
                                        font-size: 10pt;
                                        color: #555;
                                        margin-bottom: 12px;
                                    }

                                    .meta {
                                        font-size: 9pt;
                                        color: #777;
                                        margin-bottom: 15px;
                                    }

                                    table {
                                        width: 100%;
                                        border-collapse: collapse;
                                        margin-top: 6px;
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

                                    .tabla-detalle th {
                                        width: 25%;
                                    }

                                    .seccion {
                                        margin-top: 18px;
                                        font-weight: bold;
                                        font-size: 12pt;
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

                                <h1>Detalle de contacto</h1>
                                <div class="subtitulo">
                                    Usuario: '. $_SESSION["usuario"] .'
                                </div>

                                <div class="meta">
                                    Generado el: '. date("d/m/Y") .'
                                </div>

                                <div class="seccion">Datos generales</div>
                                <table class="tabla-detalle">
                                    <tbody>
                                        '.$tr.'
                                        <tr>
                                            <th>Tipo</th>
                                            <td>'.$dataTipo.'</td>
                                        </tr>
                                        <tr>
                                            <th>Categoría</th>
                                            <td>'.$dataCategoria.'</td>
                                        </tr>
                                        <tr>
                                            <th>Dirección</th>
                                            <td>'.$contacto["direccion"].'</td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td>'.$contacto["email"].'</td>
                                        </tr>
                                        <tr>
                                            <th>Sitio web</th>
                                            <td>'.$contacto["sitio_web"].'</td>
                                        </tr>
                                        <tr>
                                            <th>Observaciones</th>
                                            <td>'.$contacto["observaciones"].'</td>
                                        </tr>
                                    </tbody>
                                </table>

                                <div class="seccion">Teléfonos</div>
                                <table>
                                    <thead>
                                        <tr>
                                            <th style="width: 30%;">Etiqueta</th>
                                            <th style="width: 70%;">Número</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    '.$telefonos.'
                                    </tbody>
                                </table>

                                <div class="footer">
                                    Sistema de Agenda Web
                                </div>

                            </body>
                            </html>
                            ');

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream('Categoria.pdf', [
            'Attachment' => 0, // 0 = mostrar en el navegador, 1 = descargar
        ]);
    }

}