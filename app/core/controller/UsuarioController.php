<?php

namespace app\core\controller;

use app\core\controller\base\InterfaceController;
use app\core\controller\base\Controller;
use app\core\service\ContactoService;
use app\core\service\RecordatorioService;
use app\core\service\UsuarioService;
use app\libs\authentication\Authentication;
use app\libs\response\Response;
use app\libs\request\Request;

final class UsuarioController extends Controller implements InterfaceController{

    public function __construct()
    {
        parent::__construct([
            "public/app/js/usuario/usuarioController.js",
            "public/app/js/usuario/usuarioService.js",
        ]);
    }
    // BUSCA EL INICIO DE LA VISTA CORRESPONDIENTE
    public function index(Request $request, Response $response): void{
        $serviceContacto = new ContactoService();
        $cumpleañosHoy = $serviceContacto->cumpleaños();

        $cumpleañosSiguientes =  $serviceContacto->cumpleañosProximos();

        $serviceRecordatorio = new RecordatorioService();
        $listadoRecordatorios = $serviceRecordatorio->list();
        
        $this->view = "usuario/index.php";
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

    }
    // BUSCA LA VISTA DE EDITAR UNA ENTIDAD EXISTENTE EN EL SISTEMA
    public function edit(Request $request, Response $response): void{

    }
    // ACTUALIZA UNA ENTIDAD EXISTENTE EN EL SISTEMA
    public function update(Request $request, Response $response): void{
        $service = new UsuarioService();
        $valores = $request->getData();
        try {
            $service->update($valores);
            $response->setMessage("se actualizó el usuario.");
            $response->send();
        } catch (\Exception $e) {
            $response->setError($e->getMessage());
            $response->send();
        }
    }
    public function updateClave(Request $request, Response $response){
        $service = new UsuarioService();
        $valores = $request->getData();
        try {
            $service->updateClave($valores);
            $response->setMessage("se actualizo la contraseña.");
            $response->send();
        } catch (\Exception $e) {
            $response->setError($e->getMessage());
            $response->send();
        }
    }
    //GESTIONA LA ELIMINACION DE UNA ENTIDAD DEL SISTEMA
    public function delete(Request $request, Response $response): void{
        
    }

    public function logout(): void{
        Authentication::logout();

        $this->view = "autenticacion/logout.php";
        header("refresh:2; url=" . APP_URL . "autenticacion/index");
        require_once APP_TEMPLATE . "template.php";
    }

    public function perfil(): void{
        $service = new UsuarioService();
        $usuario = $service->load($_SESSION["id"])->toArray();
        $this->view = "usuario/perfil.php";
        require_once APP_TEMPLATE . "template.php";
    }
}