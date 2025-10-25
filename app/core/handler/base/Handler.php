<?php

namespace app\core\handler\base;

use app\libs\request\Request;
use app\libs\response\Response;

interface Handler {
    public function setNext(Handler $handler): Handler;

    public function handle(Request $request, Response $response);
}