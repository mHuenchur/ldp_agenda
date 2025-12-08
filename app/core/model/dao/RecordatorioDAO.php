<?php

namespace app\core\model\dao;

use app\core\model\base\DAO;
use app\core\model\base\InterfaceDAO;
use app\core\model\base\InterfaceDTO;
use app\core\model\dto\RecordatorioDTO;

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
        $sql = "SELECT `id`, `nombre`, `fecha_hora`, `lugar`, `usuario_id` FROM `recordatorio` WHERE id = :rid";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            "rid" => $id,
        ]);
        return  new RecordatorioDTO($stmt->fetch(\PDO::FETCH_ASSOC));
    }

    public function update(InterfaceDTO $object): void
    {
        $sql = 'UPDATE `recordatorio` SET `nombre`=:nombre,`fecha_hora`=:fecha_hora,`lugar`=:lugar WHERE recordatorio.id = :id AND recordatorio.usuario_id = :uid';
        $stmt = $this->conn->prepare($sql);
        $data = $object->toArray();
        $stmt->execute([
            "uid" => $_SESSION["id"],
            "id" => $data["id"],
            "nombre" => $data["nombre"],
            "fecha_hora" => $data["fecha_hora"],
            "lugar" => $data["lugar"],
        ]);
    }

    public function delete($id): void
    {
        $sql = "DELETE FROM recordatorio WHERE id = :rid;";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            "rid" => $id,
        ]);
    }

    public function list(): array
    {
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

    public function listarRelacion($id)
    {
        $sql = "SELECT `contacto_id` FROM `recordatorio_contacto` WHERE recordatorio_id = :rid";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            "rid" => $id,
        ]);
        return $stmt->fetchAll(\PDO::FETCH_COLUMN);
    }

    public function eliminarRelacion($id)
    {
        $sql = "DELETE FROM `recordatorio_contacto` WHERE recordatorio_id = :rid";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            "rid" => $id,
        ]);
    }
    
    public function findById($rid): ?InterfaceDTO
    {
        $sql = "SELECT `id`, `nombre`, `fecha_hora`, `lugar`, `usuario_id` FROM `recordatorio` 
                WHERE id = :rid";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            "rid" => $rid,
        ]);
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (!$row) {
            return null;
        }
        return new RecordatorioDTO($row);
    }

}


?>