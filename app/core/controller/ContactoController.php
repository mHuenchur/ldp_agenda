<?php

namespace app\core\controller;

use app\core\controller\base\InterfaceController;
use app\core\controller\base\Controller;
use app\core\service\ContactoService;
use app\libs\response\Response;
use app\libs\request\Request;

final class ContactoController extends Controller implements InterfaceController{

    public function __construct()
    {
        parent::__construct([
            "public/app/js/contacto/contactoController.js",
            "public/app/js/contacto/contactoService.js"
        ]);
    }
    // BUSCA EL INICIO DE LA VISTA CORRESPONDIENTE
    public function index(Request $request, Response $response): void{
        $service = new ContactoService();
        $listadoContactos = $service->list();
        $this->view = "contacto/index.php";
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
        $service = new ContactoService();
        $valores = $request->getData();
        $valores["usuario"] = $_SESSION["id"];
        $service->save($valores);
        $response->setMessage("El contacto se registró correctamente");
        $response->send();
    }
    // BUSCA LA VISTA DE EDITAR UNA ENTIDAD EXISTENTE EN EL SISTEMA
    public function edit(Request $request, Response $response): void{

    }
    // BUSCA LA VISTA DE EDITAR UNA ENTIDAD EXISTENTE EN EL SISTEMA
    public function update(Request $request, Response $response): void{

    }
    //GESTIONA LA ELIMINACION DE UNA ENTIDAD DEL SISTEMA
    public function delete(Request $request, Response $response): void{
        
    }

    public function filter(Request $request, Response $response): void{
        $service = new ContactoService();
        $service->filter($request->getData());
    }


}