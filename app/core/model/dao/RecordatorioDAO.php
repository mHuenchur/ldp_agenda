<?php

namespace app\core\model\dao;

use app\core\model\base\DAO;
use app\core\model\base\InterfaceDAO;
use app\core\model\base\InterfaceDTO;

final class RecordatorioDAO extends DAO implements InterfaceDAO
{
    public function __construct($conn)
    {
        parent::__construct($conn, "recordatorio");
    }

    public function save(InterfaceDTO $object)
    {
        $sql = "INSERT INTO {$this->table} VALUES (DEFAULT, :nombre, :fecha_hora, :lugar, :usuario_id)";
        $stmt = $this->conn->prepare($sql);
        $data = $object->toArray();
        unset($data["id"]);
        $data["usuario_id"] = $_SESSION["id"];


        $stmt->execute($data);
        return $this->conn->lastInsertId();
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
        //$sql = "SELECT id, nombre, fecha_hora, lugar, usuario_id FROM {$this->table} WHERE usuario_id  = ". $_SESSION["id"];
        $sql = "SELECT r.*
                FROM recordatorio r
                JOIN usuario u ON u.id = r.usuario_id
                WHERE r.usuario_id = :uid
                AND r.fecha_hora >= NOW()
                AND r.fecha_hora <= DATE_ADD(NOW(), INTERVAL u.tiempo_notificacion DAY);";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            "uid" => $_SESSION["id"],
        ]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function listarVigentes() {
        $sql = "SELECT r.*
                FROM recordatorio r
                WHERE r.usuario_id = :uid
                AND r.fecha_hora >= NOW()
                ORDER BY r.fecha_hora ASC;";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            "uid" => $_SESSION["id"],
        ]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function listarVencidos() {
        $sql = "SELECT r.*
                FROM recordatorio r
                WHERE r.usuario_id = :uid
                AND r.fecha_hora < NOW()
                ORDER BY r.fecha_hora DESC;";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            "uid" => $_SESSION["id"],
        ]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function guardarRelacion(array $object)
    {
        $sql = "INSERT INTO `recordatorio_contacto` VALUES (:recordatorio_id, :contacto_id)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'recordatorio_id' => $object["recordatorio_id"],
            'contacto_id' => $object["contacto"]
        ]);
    }

}


?>