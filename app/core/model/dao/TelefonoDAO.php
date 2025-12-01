<?php

namespace app\core\model\dao;

use app\core\model\base\DAO;
use app\core\model\base\InterfaceDAO;
use app\core\model\base\InterfaceDTO;

final class TelefonoDAO extends DAO implements InterfaceDAO
{
    public function __construct($conn)
    {
        parent::__construct($conn, "telefono");
    }

    public function save(InterfaceDTO $object)
    {
        $sql = "INSERT INTO {$this->table} VALUES (DEFAULT, :numero, :etiqueta, :contacto_id)";
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
        $sql = "DELETE FROM {$this->table} WHERE contacto_id = :cid";
        $stmt = $this->conn->prepare($sql);

        $stmt->execute([
            "cid" => $id,
        ]);
    }

    public function list(): array
    {
        return array();
    }

    public function listByContacto($id)
    {
        $sql = "SELECT * FROM {$this->table}
        WHERE telefono.contacto_id = :cid";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            "cid" => $id,
        ]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

}


?>