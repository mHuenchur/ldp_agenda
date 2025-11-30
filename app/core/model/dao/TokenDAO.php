<?php

namespace app\core\model\dao;

use app\core\model\base\DAO;
use app\core\model\base\InterfaceDAO;
use app\core\model\base\InterfaceDTO;

final class TokenDAO extends DAO
{
    public function __construct($conn)
    {
        parent::__construct($conn, "token_reset");
    }

    public function create($id, $email, $token)
    {
        $this->usedToken($id);
        //generar la consulta y guardar en BD
        $clave = hash('sha256', $token);

        $sql = "INSERT INTO {$this->table} (`usuario_id`, `proposito`, `token_hash`, `fecha_expiracion`, `utilizado`) 
                VALUES ('{$id}','password_reset','{$clave}', DATE_ADD(UTC_TIMESTAMP(), INTERVAL 30 MINUTE), false)";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute();
    }

    public function validityCheck($token)
    {
        $clave = hash('sha256', $token);

        $sql = "SELECT EXISTS (
        SELECT 1 
        FROM token_reset 
        WHERE token_reset.token_hash = :hash_hex
        AND token_reset.fecha_expiracion > UTC_TIMESTAMP() 
        AND token_reset.utilizado = 0)";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['hash_hex' => $clave]);

        return (bool)$stmt->fetchColumn();
    }

    public function findUser($token)
    {
        $clave = hash('sha256', $token);
        $sql = "SELECT token_reset.usuario_id FROM `token_reset` WHERE token_reset.token_hash = :hash_hex";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['hash_hex' => $clave]);
        
        return $stmt->fetchColumn();
    }
    public function usedToken($id)
    {
        $sql = "UPDATE `token_reset` SET token_reset.utilizado = 1 WHERE token_reset.usuario_id = '{$id}'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
    }

}


?>