<?php

namespace app\libs\request;

final class Request{

    private $controller, $action, $id, $data;

    public function __construct(){

        $this->controller = $_GET["controller"] ?? "";
        $this->action = $_GET["action"] ?? APP_DEFAULT_ACTION;
        $this->id = $_GET["id"] ?? 0;
        $this->data = json_decode(file_get_contents("php://input"), true);
    }

    public function getController(): string{
        return $this->controller;
    }
    public function getAction(): string{
        return $this->action;
    }
    public function getId(): string{
        return $this->id;
    }
    public function getData(): array{
        if ($this->data == null) {
            throw new \Exception("ACCION INVALIDA!");
        } else {
            return $this->data;
        }
    }
    public function getRequestMethod(): string{
        return $_SERVER["REQUEST_METHOD"];
    }
    public function setController($controller): void{
        $this->controller = $controller;
    }
    public function setAction($action): void{
        $this->action = $action;
    }
}