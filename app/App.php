<?php

namespace app;

use app\core\handler\base\Handler;
use app\core\handler\ExceptionHandler;
use app\core\handler\AuthenticationHandler;
use app\core\handler\AuthorizationHandler;
use app\core\handler\RoutingHandler;
use app\libs\request\Request;
use app\libs\response\Response;

final class App{

    private function __construct(){

    }

    public static function run(){

        $exception = new ExceptionHandler();
        $authentication = new AuthenticationHandler();
        $authorization = new AuthorizationHandler();
        $routing = new RoutingHandler();

        $exception->setNext($authentication)->setNext($authorization)->setNext($routing);
        //$exception->setNext($routing);
        $request = new Request();
        $response = new Response();


        $exception->handle($request, $response);
    }
}