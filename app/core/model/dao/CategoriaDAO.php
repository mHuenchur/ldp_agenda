<?php

namespace app\core\model\dao;

use app\core\model\base\DAO;
use app\core\model\base\InterfaceDAO;
use app\core\model\base\InterfaceDTO;
use app\core\model\dto\CategoriaDTO;

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
        $sql = "SELECT `id`, `nombre` FROM {$this->table} WHERE categoria.id =:cid AND usuario_id = :uid";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            "cid" => $id,
            "uid" => $_SESSION["id"],
        ]);
        return  new CategoriaDTO($stmt->fetch(\PDO::FETCH_ASSOC));
    }

    public function update(InterfaceDTO $object): void
    {
        $data = $object->toArray();
        $sql = "UPDATE `categoria` SET `nombre`=:nombre WHERE categoria.id = :cid";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            "cid" => $data["id"],
            "nombre" => $data["nombre"],
        ]);
    }

    public function tieneContactos($categoriaId): bool
    {
        $sql = "SELECT EXISTS (
                    SELECT 1
                    FROM contacto
                    WHERE categoria_id = :cid
                ) AS tiene_contactos;";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            "cid" => $categoriaId,
        ]);
        return (bool)$stmt->fetchColumn();
    }

    public function delete($categoriaId): void
    {
        $sql = "DELETE FROM `categoria` WHERE id = :cid;";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            "cid" => $categoriaId,
        ]);
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