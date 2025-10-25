<?php

namespace app\core\controller;

use app\core\controller\base\InterfaceController;
use app\core\controller\base\Controller;
use app\core\service\CarteleraVigenteService;
use app\core\service\FuncionService;
use app\libs\request\Request;
use app\libs\response\Response;
use app\libs\autentication\Authentication;
use app\core\service\UsuarioService;
use app\libs\mailManager\MailManager;

final class AutenticacionController extends Controller{

    public function __construct()
    {
        parent::__construct([
            "public/app/js/autenticacion/autenticacionController.js",
            "public/app/js/autenticacion/autenticacionService.js"
        ]);
    }

    public function index(Request $request, Response $response): void{
        $this->view = "autenticacion/index.php";
        require_once APP_TEMPLATE . "template.php";
    }

    public function login(Request $request, Response $response): void{
        $data = $request->getData();
        Authentication::login($data["nombreUsuario"], $data["clave"]);
        $response->setMessage("OK");
        $response->setController($_SESSION["perfil"]);

        $response->send();
    }

    public function save(Request $request, Response $response){
        $service = new UsuarioService();
        $valores = $request->getData();
        $valores["perfilID"] = "3";
        $service->save($valores);
        $_SESSION["token"] = APP_TOKEN;
        $_SESSION["usuario"] = $valores["nombreUsuario"];
        $_SESSION["perfil"] = "usuario";
        $response->setController($_SESSION["perfil"]);
        $response->setMessage("El usuario se registró correctamente");
        $response->send();
    }


}