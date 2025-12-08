<?php

namespace app\core\model\dto;

use app\core\model\base\InterfaceDTO;

final class CategoriaDTO  implements InterfaceDTO
{
    private $id, $nombre, $id_usuario;


public function __construct($data = [])
{
    $this->setId($data["id"] ?? "0");
    $this->setNombre($data["nombre"] ?? "");
    $this->setUsuarioId($data["usuario_id"] ?? "");
}

public function getId(){
    return $this->id;
}
public function getNombre(): string{
    return $this->nombre;
}
public function getUsuarioId(){
    return $this->id_usuario;
}

//

public function setId($id): void{
    $id = (int)$id;
    $this->id = $id > 0 ? $id : 0;
}
public function setNombre($nombre): void{
    $this->nombre =
    (is_string($nombre) && (strlen(trim($nombre)) <= 45))
    ? $nombre
    : "";
}
public function setUsuarioId($user): void{
    $user = (int)$user;
    $this->id_usuario = $user > 0 ? $user : 0;
}


// ** METODOS **
public function toArray(): array{
    return [
        "id" => $this->getId(),
        "nombre" => $this->getNombre(),
        "usuario_id" => $this->getUsuarioId()
    ];
}
}