<?php

namespace app\core\model\dto;

use app\core\model\base\InterfaceDTO;

final class RecordatorioDTO  implements InterfaceDTO
{
    private $id, $nombre, $fecha_hora, $lugar, $usuario_id;


public function __construct($data = [])
{
    $this->setId($data["id"] ?? "0");
    $this->setNombre($data["nombre"] ?? "");
    $this->setFechaHora($data["fecha_hora"] ?? "");
    $this->setLugar($data["lugar"] ?? "");
    $this->setUsuarioId($data["usuario_id"] ?? "0");
}


public function getId(): int{
    return $this->id;
}
public function getNombre(): string{
    return $this->nombre;
}
public function getFechaHora(): string{
    return $this->fecha_hora;
}
public function getLugar(): string{
    return $this->lugar;
}
public function getUsuarioId(): string{
    return $this->usuario_id;
}


public function setId($id): void{
    $this->id =
    (is_numeric($id) && $id > "0") 
    ? $id 
    : "0";
}
public function setNombre($nombre): void{
    $this->nombre =
    (is_string($nombre) && (strlen(trim($nombre)) <= 45))
    ? $nombre
    : "";
}
public function setFechaHora($fechaHora): void{
    $this->fecha_hora = $fechaHora;
}
public function setLugar($lugar): void{
    $this->lugar =
    (is_string($lugar) && (strlen(trim($lugar)) <= 45))
    ? $lugar 
    : "";
}
public function setUsuarioId($usuario): void{
    $this->usuario_id = $usuario;
}



// ** METODOS **
public function toArray(): array{
    return [
        "id" => $this->getId(),
        "nombre" => $this->getNombre(),
        "fecha_hora" => $this->getFechaHora(),
        "lugar" => $this->getLugar(),
        "usuario_id" => $this->getUsuarioId(),
    ];
}
}