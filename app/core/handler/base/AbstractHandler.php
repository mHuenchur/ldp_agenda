<?php

namespace app\core\handler\base;
use app\core\handler\base\Handler;
use app\libs\request\Request;
use app\libs\response\Response;

abstract class AbstractHandler implements Handler{

    private $nextHandler;

    public function setNext(Handler $handler): Handler{

        $this->nextHandler = $handler;

        return $handler;
    }

    public function handle(Request $request, Response $response){

        if($this->nextHandler){
            return $this->nextHandler->handle($request, $response);
        }
    }

}