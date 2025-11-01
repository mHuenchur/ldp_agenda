<?php

namespace app\core\service;

use app\core\model\base\InterfaceDTO;
use app\core\model\dao\TokenDAO;
use app\core\service\base\Service;
use app\core\service\base\InterfaceService;
use app\libs\connection\Connection;
use app\core\model\dao\UsuarioDAO;
use app\core\model\dto\UsuarioDTO;


final class PasswordService extends Service implements InterfaceService{
    
    public function save(array $object): void{

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
    
    public function emailCheck($email): string{
        $conn = Connection::get();
        $dao = new UsuarioDAO($conn);
        return $dao->emailCheck($email);
    }
    public function generateToken($id, $email): string{
        $conn = Connection::get();
        $token = bin2hex(random_bytes(32));
        $dao = new TokenDAO($conn);
        $dao->create($id, $email, $token);
        return $token;
    }
    public function validityCheck($token){
        $conn = Connection::get();
        $dao = new TokenDAO($conn);
        return $dao->validityCheck($token);
    }
    public function findUser($token){
        $conn = Connection::get();
        $dao = new TokenDAO($conn);
        return $dao->findUser($token);
    }
    public function usedToken($id){
        $conn = Connection::get();
        $dao = new TokenDAO($conn);
        $dao->usedToken($id);
    }
}