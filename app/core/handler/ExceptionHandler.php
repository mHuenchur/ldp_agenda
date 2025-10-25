<?php

namespace app\core\handler;
use app\core\handler\base\AbstractHandler;
use app\libs\request\Request;
use app\libs\response\Response;

class ExceptionHandler extends AbstractHandler{

    public function handle(Request $request, Response $response)
    {
        try {
            return parent::handle($request, $response);
        } catch (\Exception $ex) {
            $response->setError($ex->getMessage());
            $response->send();
        }
        
    }
}