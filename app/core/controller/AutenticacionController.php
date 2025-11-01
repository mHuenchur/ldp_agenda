<?php

namespace app\core\controller;


use app\core\controller\base\Controller;
use app\libs\request\Request;
use app\libs\response\Response;
use app\libs\authentication\Authentication;
use app\core\service\UsuarioService;
use app\core\service\PasswordService;
use app\libs\mail\MailManager;

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

    public function passwordLost(Request $request, Response $response): void{
        $this->view = "autenticacion/changePassword.php";
        require_once APP_TEMPLATE . "template.php";
    }

    public function reset(Request $request, Response $response): void{
        $service = new PasswordService();
        $email = $request->getData();
        //verifica si el mail existe
        $valor = $service->emailCheck($email["correo"]);
        if ($valor !== NULL) {
            //genera token en bd
            $token = $service->generateToken($valor, $email["correo"]);
            //envia correo
            MailManager::createMail($email["correo"], $token);
            //ENVIAR MENSAJE GENERICO, MODIFICAR DESPUES A UN SOLO MESSAGE!
            $response->setMessage("Si todo esta bien se envia un correo!");
            
        } else {
            $response->setMessage("Dato incorrecto!");
        }
        $response->send();
    }

    public function resetPage(Request $request, Response $response): void{
        //verificamos que ese url(token) aun este valido
        $service = new PasswordService();
        $token = $request->getId();
        //si esta valido deberia permitir utilizar
        //sino muestro pagina de invalido
        if ($service->validityCheck($token)) {
            $this->view = "autenticacion/resetPage.php";
        } else {
            $this->view = "autenticacion/errorPage.php";
        }
        require_once APP_TEMPLATE . "template.php";
    }

    public function changePassword(Request $request, Response $response): void{
        $service = new PasswordService();
        $dato = $request->getData();
        //si lo es modificamos la clave y consumimos el token
        //sino, mensaje de error
        if ($service->validityCheck($dato["valor"])) {
            //encuentro usuraio por token
            $id = $service->findUser($dato["valor"]);
            //creo una instancia service usuario
            $user = new UsuarioService();
            //actualizo clave
            $user->updatePassword($id, $dato["clave"]);
            //consumo el token
            $service->usedToken($id);
            $response->setMessage("TODO JOYA");
        } else {
            $response->setMessage("TODO MAL");
        }
        $response->send();
    }
}