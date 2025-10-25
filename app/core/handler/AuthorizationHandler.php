<?php

namespace app\core\handler;
use app\core\handler\base\AbstractHandler;
use app\libs\request\Request;
use app\libs\response\Response;

class AuthorizationHandler extends AbstractHandler{

    public function handle(Request $request, Response $response)
    {
        
        if(isset($_SESSION["token"]) && $_SESSION["token"] === APP_TOKEN){
            //print_r($request->getController());
            $contAdmitidosUsuario = ["usuario","autenticacion"];
            $contAdmitidosAdministrador = ["autenticacion"];

            $response->setController($request->getController());
            $response->setAction($request->getAction());
            
            if ($_SESSION["perfil"] == "administrador" && !in_array($request->getController(), $contAdmitidosAdministrador)) {
                throw new \Exception("ACCESO DENEGADO PARA ADMINISTRADOR");
            } else {
                if ($_SESSION["perfil"] == "usuario" && !in_array($request->getController(), $contAdmitidosUsuario)) {
                    throw new \Exception("ACCESO DENEGADO PARA USUARIO");
                }
            }
        }


        return parent::handle($request, $response);
    }
}