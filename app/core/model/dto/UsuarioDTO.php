<?php

namespace app\core\model\dto;

use app\core\model\base\InterfaceDTO;

final class UsuarioDTO  implements InterfaceDTO
{
    private $id, $nombre, $apellido, $nombreUsuario, $clave, $correo, $perfilId, $tiempoNotificacion;


    public function __construct($data = [])
    {
        $this->setId($data["id"] ?? "0");
        $this->setNombre($data["nombre"] ?? "");
        $this->setApellido($data["apellido"] ?? "");
        $this->setNombreUsuario($data["nombreUsuario"] ?? "");
        $this->setClave($data["clave"] ?? "");
        $this->setCorreo($data["correo"] ?? "");
        $this->setPerfilId($data["perfilID"] ?? "3");
        $this->setTiempoNotificacion($data["tiempo"] ?? "30");
    }

    public function getId(): int{
        return $this->id;
    }
    public function getApellido(): string{
        return $this->apellido;
    }
    public function getNombre(): string{
        return $this->nombre;
    }
    public function getNombreUsuario(): string{
        return $this->nombreUsuario;
    }
    public function getCorreo(): string{
        return $this->correo;
    }
    public function getClave(): string{
        return $this->clave;
    }
    public function getPerfilId(): int{
        return $this->perfilId;
    }
    public function getTiempoNotificacion(): int{
        return $this->tiempoNotificacion;
    }


    // ** SETTERS **
    public function setId($id): void{
        $this->id =
        (is_numeric($id) && $id > "0") 
        ? $id 
        : "0";
    }
    public function setApellido($apellido): void{
        $this->apellido =
        (is_string($apellido) && (strlen(trim($apellido)) <= 45))
        ? $apellido
        : "";
    }
    public function setNombre($nombre): void{
        $this->nombre =
        (is_string($nombre) && (strlen(trim($nombre)) <= 45))
        ? $nombre
        : "";
    }
    public function setNombreUsuario($nombreUsuario): void{
        $this->nombreUsuario =
        (is_string($nombreUsuario) && (strlen(trim($nombreUsuario)) <= 45))
        ? $nombreUsuario
        : "";
    }
    public function setCorreo($correo): void{
        $this->correo =
        (is_string($correo) && (strlen(trim($correo)) <= 255))
        ? $correo
        : "";
    }
    public function setClave($clave): void{
        $this->clave =
        (is_string($clave) && (strlen(trim($clave)) <= 255))
        ? $clave
        : "";
    }
    public function setPerfilId($perfilId): void{
        $this->perfilId =
        (is_numeric($perfilId) && $perfilId > "0") 
        ? $perfilId 
        : "0";
    }
    public function setTiempoNotificacion($tiempo): void{
        $this->tiempoNotificacion =
        (is_numeric($tiempo) && $tiempo > "0") 
        ? $tiempo 
        : "30";
    }

    // ** METODOS **
    public function toArray(): array{
        return [
            "id" => $this->getId(),
            "nombre" => $this->getNombre(),
            "apellido" => $this->getApellido(),
            "nombre_usuario" => $this->getNombreUsuario(),
            "email" => $this->getCorreo(),
            "clave" => $this->getClave(),
            "tiempo_notificacion" => $this->getTiempoNotificacion(),
            "perfil_id" => $this->getPerfilId(),
        ];
    }
}