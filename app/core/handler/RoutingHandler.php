<?php

namespace app\core\handler;
use app\core\handler\base\AbstractHandler;
use app\libs\request\Request;
use app\libs\response\Response;

class RoutingHandler extends AbstractHandler{

    public function handle(Request $request, Response $response)
    {
        $controllerName = 'app\\core\\controller\\'. ucfirst($request->getController()) .'Controller';

        if (!class_exists($controllerName) || !method_exists($controllerName, $request->getAction())) {
            throw new \Exception("controlador y/o accion incorrectos");
        }

        $response->setController($request->getController());
        $response->setAction($request->getAction());

        call_user_func_array(array(new $controllerName, $request->getAction()), array($request, $response));

        return parent::handle($request, $response);
    }
}