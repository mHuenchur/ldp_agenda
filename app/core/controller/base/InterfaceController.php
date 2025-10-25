<?php

namespace app\core\controller\base;

use app\libs\request\Request;
use app\libs\response\Response;

interface InterfaceController{

    public function index(Request $request, Response $response): void;

    public function load(Request $request, Response $response): void;

    public function create(Request $request, Response $response): void;

    public function save(Request $request, Response $response): void;

    public function edit(Request $request, Response $response): void;

    public function update(Request $request, Response $response): void;

    public function delete(Request $request, Response $response): void;
}