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
    $this->setUsuarioId($data["user"] ?? "");
}

public function getId(): int{
    return $this->id;
}
public function getNombre(): string{
    return $this->nombre;
}
public function getUsuarioId(): int{
    return $this->id_usuario;
}

//

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
public function setUsuarioId($user): void{
    $this->id_usuario =
    (is_numeric($user) && $user > 0) 
    ? $user 
    : 5;
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