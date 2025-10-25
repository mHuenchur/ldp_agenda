<?php

namespace app\core\service;

use app\core\model\base\InterfaceDTO;
use app\core\service\base\Service;
use app\core\service\base\InterfaceService;
use app\libs\connection\Connection;
use app\core\model\dao\UsuarioDAO;
use app\core\model\dto\UsuarioDTO;


final class UsuarioService extends Service implements InterfaceService{
    
    public function save(array $object): void{
        $conn = Connection::get();
        $dao = new UsuarioDAO($conn);
        $dao->save(new UsuarioDTO($object));
    }

    public function load($id): InterfaceDTO{
        return new InterfaceDTO;
    }

    public function update(array $object): void{

    }

    public function delete($id): void{

    }

    public function list(): array{
        return [];
    }
    /*
    public function emailCheck($email): string{
        $conn = Connection::get();
        $dao = new UsuarioDAO($conn);
        return $dao->emailCheck($email);
    }
    public function createPassword($email): string{
        $conn = Connection::get();
        $dao = new UsuarioDAO($conn);
        return $dao->createPassword($email);
    }*/
}