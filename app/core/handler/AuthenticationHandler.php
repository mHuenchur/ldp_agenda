<?php

namespace app\core\handler;
use app\core\handler\base\AbstractHandler;
use app\libs\request\Request;
use app\libs\response\Response;

class AuthenticationHandler extends AbstractHandler{

    public function handle(Request $request, Response $response)
    {
        
        session_start();
        
        //si no esta el token o  el token no es app_token
        if(!isset($_SESSION["token"]) || $_SESSION["token"] !== APP_TOKEN){
            //si el controlador no es autenticaion o  la accion no es ninguna de las permitidas
            $accionesAdmitidasAutenticacion = ["index", "login", "save", "passwordLost", "resetPage", "reset"];
            if($request->getController() !== "autenticacion" || !in_array($request->getAction(), $accionesAdmitidasAutenticacion)){
                $request->setController("autenticacion");
                $request->setAction("index");
            }
        }else{
            if (!isset($_GET["controller"]) || ($_GET["controller"] == "autenticacion")) {
                $request->setController("usuario");
            }
        }

        return parent::handle($request, $response);
    }
}