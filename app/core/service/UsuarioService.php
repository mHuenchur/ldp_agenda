<?php

namespace app\core\service;

use app\core\model\base\InterfaceDTO;
use app\core\service\base\Service;
use app\core\service\base\InterfaceService;
use app\libs\connection\Connection;
use app\core\model\dao\UsuarioDAO;
use app\core\model\dto\UsuarioDTO;
use Exception;

final class UsuarioService extends Service implements InterfaceService{
    
    public function save(array $object){
        $conn = Connection::get();
        $dao = new UsuarioDAO($conn);
        $usuario = new UsuarioDTO($object);
        //VALIDACION
        if ($usuario->getNombre() == "") {
            throw new \Exception("NOMBRE VACIO");
        }
        if ($usuario->getApellido() == "") {
            throw new \Exception("APELLIDO VACIO");
        }
        if ($usuario->getCorreo() == "") {
            throw new \Exception("CORREO VACIO");
        }
        if ($usuario->getNombreUsuario() == "") {
            throw new \Exception("NOMBRE USUARIO VACIO");
        }
        if ($usuario->getClave() == "") {
            throw new \Exception("CLAVE VACIA");
        }
        if ($dao->existeUsuarioEmail($usuario->getNombreUsuario(), $usuario->getCorreo())) {
            throw new \Exception("Ya existe un usuario con ese nombre de usuario o correo.");
        }
        return $dao->save($usuario);
    }

    public function load($id): InterfaceDTO{
        $conn = Connection::get();
        $dao = new UsuarioDAO($conn);
        return $dao->load($id);
    }

    public function update(array $object): void{
        $conn = Connection::get();
        $dao = new UsuarioDAO($conn);
        $usuario = new UsuarioDTO($object);
        if ($usuario->getNombre() == "") {
            throw new \Exception("NOMBRE VACIO");
        }
        if ($usuario->getApellido() == "") {
            throw new \Exception("APELLIDO VACIO");
        }
        if ($usuario->getCorreo() == "") {
            throw new \Exception("CORREO VACIO");
        }
        if ($usuario->getNombreUsuario() == "") {
            throw new \Exception("NOMBRE USUARIO VACIO");
        }
        if ($usuario->getTiempoNotificacion() == "") {
            throw new \Exception("TIEMPO NOTIFICACION VACIO");
        }
        $usuario->setId($_SESSION["id"]);
        if ($dao->existeUsuarioEmailOtroUsuario($usuario->getId(), $usuario->getNombreUsuario(), $usuario->getCorreo())) {
            throw new \Exception("Nombre de usuario o correo ya están siendo utilizados por otra cuenta.");
        }
        $dao->update($usuario);
    }

    public function updateClave(array $object): void{
        $conn = Connection::get();
        $dao = new UsuarioDAO($conn);
        if ($object["clave"] == "" || $object["nueva"] == "") {
            throw new \Exception("CAMPOS VACIOS");
        }
        $dao->updateClave($object);
    }

    public function delete($id): void{

    }

    public function list(): array{
        return [];
    }

    public function updatePassword($id, $clave){

        $conn = Connection::get();
        $dao = new UsuarioDAO($conn);
        $dao->updatePassword($id, $clave);
    }
    
}