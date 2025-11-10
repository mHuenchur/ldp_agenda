<?php

namespace app\core\model\dto;

use app\core\model\base\InterfaceDTO;

final class ContactoDTO  implements InterfaceDTO
{
    private $id, $nombre, $apellido, $razon_social, $direccion, $email, 
            $sitio_web, $fecha_nacimiento, $observaciones, $id_tipo, $id_categoria, $id_usuario;


public function __construct($data = [])
{

}

public function getId(): int{
    return $this->id;
}
public function getNombre(): string{
    return $this->nombre;
}
public function getApellido(): string{
    return $this->apellido;
}
public function getRazonSocial(): string{
    return $this->razon_social;
}
public function getDireccion(): string{
    return $this->direccion;
}
public function getEmail(): string{
    return $this->email;
}
public function getSitioWeb(): string{
    return $this->sitio_web;
}
public function getFechaNacimiento(): string{
    return $this->fecha_nacimiento;
}
public function getObservaciones(): string{
    return $this->observaciones;
}
public function getIdTipo(): int{
    return $this->id_tipo;
}
public function getIdCategoria(): int{
    return $this->id_categoria;
}
public function getIdUsuario(): int{
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
public function setApellido($apellido): void{
    $this->apellido =
    (is_string($apellido) && (strlen(trim($apellido)) <= 45))
    ? $apellido
    : "";
}
public function setRazonSocial($razonSocial): void{
    $this->razon_social =
    (is_string($razonSocial) && (strlen(trim($razonSocial)) <= 45))
    ? $razonSocial
    : "";
}
public function setDireccion($direccion): void{
    $this->direccion =
    (is_string($direccion) && (strlen(trim($direccion)) <= 45))
    ? $direccion
    : "";
}
public function setEmail($email): void{
    $this->email =
    (is_string($email) && (strlen(trim($email)) <= 255))
    ? $email
    : "";
}
public function setSitioWeb($sitioWeb): void{
    $this->sitio_web =
    (is_string($sitioWeb) && (strlen(trim($sitioWeb)) <= 100))
    ? $sitioWeb
    : "";
}
public function setFechaNacimiento(): void{
    
}
public function setObservaciones(): void{
    
}
public function setIdTipo(): void{
    
}
public function setIdCategoria(): void{
    
}
public function setIdUsuario(): void{
    
}


// ** METODOS **
public function toArray(): array{
    return [

    ];
}
}