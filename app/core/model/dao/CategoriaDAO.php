<?php

namespace app\core\model\dao;

use app\core\model\base\DAO;
use app\core\model\base\InterfaceDAO;
use app\core\model\base\InterfaceDTO;

final class CategoriaDAO extends DAO implements InterfaceDAO
{
    public function __construct($conn)
    {
        parent::__construct($conn, "categoria");
    }

    public function save(InterfaceDTO $object): void
    {
        $sql = "INSERT INTO {$this->table} VALUES (DEFAULT, :nombre, :usuario_id)";
        $stmt = $this->conn->prepare($sql);
        $data = $object->toArray();
        unset($data["id"]);

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
        $sql = "SELECT * FROM `categoria` WHERE categoria.usuario_id  = ". $_SESSION["id"];
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

}


?>