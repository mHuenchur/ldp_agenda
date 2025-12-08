<?php

namespace app\core\model\dao;

use app\core\model\base\DAO;
use app\core\model\base\InterfaceDAO;
use app\core\model\base\InterfaceDTO;
use app\core\model\dto\ContactoDTO;

final class ContactoDAO extends DAO implements InterfaceDAO
{
    public function __construct($conn)
    {
        parent::__construct($conn, "contacto");
    }

    public function save(InterfaceDTO $object)
    {
        $sql = "INSERT INTO {$this->table} VALUES 
        (DEFAULT, :nombre, :apellido, :razon_social, :direccion, :email, :sitio_web, :fecha_nacimiento, :observaciones, :tipo_id, :categoria_id, :usuario_id)";
        $stmt = $this->conn->prepare($sql);
        $data = $object->toArray();
        unset($data["id"]);
        $data["usuario_id"] = $_SESSION["id"];

        $stmt->execute($data);
        return $this->conn->lastInsertId();
    }

    public function load($id): InterfaceDTO
    {
        $sql = "SELECT * FROM `contacto` 
        WHERE contacto.id = :contacto_id
        AND contacto.usuario_id = :uid;";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            "contacto_id" => $id,
            "uid" => $_SESSION["id"],
        ]);
        return  new ContactoDTO($stmt->fetch(\PDO::FETCH_ASSOC));
    }

    public function update(InterfaceDTO $object): void
    {
        
        $sql = "UPDATE `contacto` 
        SET `nombre`=:nombre,`apellido`=:apellido,`razon_social`=:razon_social,`direccion`=:direccion,`email`=:email,`sitio_web`=:sitio_web
        ,`fecha_nacimiento`=:fecha_nacimiento,`observaciones`=:observaciones,`tipo_id`=:tipo_id,`categoria_id`=:categoria_id WHERE contacto.id = :id";
        $stmt = $this->conn->prepare($sql);
        $data = $object->toArray();

        $stmt->execute($data);
    }

    public function tieneRecordatorios($contactoId): bool
    {
        $sql = "SELECT EXISTS (
                    SELECT 1
                    FROM recordatorio_contacto rc
                    JOIN recordatorio r ON r.id = rc.recordatorio_id
                    WHERE rc.contacto_id = :cid
                    AND r.usuario_id = :uid
                ) AS tiene_recordatorios;";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            "cid" => $contactoId,
            "uid" => $_SESSION["id"],
        ]);
        return (bool)$stmt->fetchColumn();
    }

    public function delete($contactoId): void
    {
        $sql = "DELETE FROM `contacto` WHERE id = :cid;";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            "cid" => $contactoId,
        ]);
    }

    public function list(): array
    {
        $sql = "SELECT id, nombre, apellido, razon_social, direccion, email, sitio_web, fecha_nacimiento, observaciones, tipo_id, categoria_id FROM `contacto` WHERE contacto.usuario_id  = ". $_SESSION["id"];
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function filter(array $object): array
    {
        $tipo = isset($object['tipo']) && $object['tipo'] !== ''
        ? (int)$object['tipo']
        : null;

        $categoria = isset($object['categoria']) && $object['categoria'] !== ''
        ? (int)$object['categoria']
        : null;

        $sql = "SELECT `id`, `nombre`, `apellido`, `razon_social`, `direccion`, `email`, `sitio_web`, `fecha_nacimiento`, `observaciones`,  `tipo_id`
        FROM `contacto` 
        WHERE (usuario_id = :uid AND (:tipo IS NULL OR  tipo_id = :tipo) AND (:categoria IS NULL OR categoria_id = :categoria))";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
        'uid'       => $_SESSION['id'],
        'categoria' => $categoria,
        'tipo'      => $tipo 
        ]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function cumpleaños(): array
    {
        $sql = "SELECT *
        FROM contacto
        WHERE contacto.usuario_id = ". $_SESSION["id"] ."
        AND contacto.fecha_nacimiento IS NOT NULL
        AND contacto.fecha_nacimiento <> '0000-00-00' 
        AND DATE_FORMAT(fecha_nacimiento, '%m-%d') = DATE_FORMAT(CURDATE(), '%m-%d');";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function cumpleañosProximos(): array
    {
        $sql = "SELECT
            contacto.*,
            CASE
                -- verifico cumpleaños este año
                WHEN STR_TO_DATE(
                            CONCAT(YEAR(CURDATE()), '-', DATE_FORMAT(contacto.fecha_nacimiento, '%m-%d')),
                            '%Y-%m-%d'
                        ) >= CURDATE()
                THEN STR_TO_DATE(
                            CONCAT(YEAR(CURDATE()), '-', DATE_FORMAT(contacto.fecha_nacimiento, '%m-%d')),
                            '%Y-%m-%d'
                        )
                -- si es otro año, verifico el siguiente
                ELSE STR_TO_DATE(
                            CONCAT(YEAR(CURDATE()) + 1, '-', DATE_FORMAT(contacto.fecha_nacimiento, '%m-%d')),
                            '%Y-%m-%d'
                        )
            END AS proximo_cumple
            FROM contacto 
            JOIN usuario ON usuario.id = ". $_SESSION["id"] ."
            WHERE contacto.usuario_id = ". $_SESSION["id"] ." 
            AND contacto.fecha_nacimiento IS NOT NULL
            AND contacto.fecha_nacimiento <> '0000-00-00'
            HAVING proximo_cumple > CURDATE()
            AND proximo_cumple <= DATE_ADD(CURDATE(), INTERVAL 30 DAY);";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

}


?>