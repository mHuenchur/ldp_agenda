<?php

namespace app\core\model\dao;

use app\core\model\base\DAO;
use app\core\model\base\InterfaceDAO;
use app\core\model\base\InterfaceDTO;

final class UsuarioDAO extends DAO implements InterfaceDAO
{
    public function __construct($conn)
    {
        parent::__construct($conn, "usuario");
    }

    public function save(InterfaceDTO $object): void
    {
        $sql = "INSERT INTO {$this->table} VALUES (DEFAULT, :nombre, :apellido, :nombreUsuario, :correo, :clave)";
        $stmt = $this->conn->prepare($sql);
        $data = $object->toArray();
        unset($data["id"]);
        unset($data["perfilID"]);


        $clave = password_hash($object->getClave(), PASSWORD_DEFAULT);
        $data["clave"] = $clave;


        $stmt->execute($data);
    }

    public function load($id): InterfaceDTO
    {
        return  new InterfaceDTO();
    }

    public function update(InterfaceDTO $object): void
    {
        
    }

    public function delete($id): void
    {
        
    }

    public function list(): array
    {
        return array();
    }

    public function emailCheck($email): string
    {
        $sql = "SELECT usuario.id FROM {$this->table} WHERE usuario.email = '{$email}'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $resultado = $stmt->fetchColumn();
        if($resultado === false){
            $resultado = NULL;
        }
        return $resultado;
    }

}


?>