<?php

namespace app\core\service;

use app\core\model\base\InterfaceDTO;
use app\core\service\base\Service;
use app\core\service\base\InterfaceService;
use app\libs\connection\Connection;
use app\core\model\dao\UsuarioDAO;
use app\core\model\dto\UsuarioDTO;


final class UsuarioService extends Service implements InterfaceService{
    
    public function save(array $object){
        $conn = Connection::get();
        $dao = new UsuarioDAO($conn);
        return $dao->save(new UsuarioDTO($object));
    }

    public function load($id): InterfaceDTO{
        $conn = Connection::get();
        $dao = new UsuarioDAO($conn);
        return $dao->load($id);
    }

    public function update(array $object): void{
        $conn = Connection::get();
        $dao = new UsuarioDAO($conn);
        $dao->update(new UsuarioDTO($object));
    }

    public function updateClave(array $object): void{
        $conn = Connection::get();
        $dao = new UsuarioDAO($conn);
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