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
        //INSERT INTO `token_reset`(`usuario_id`, `proposito`, `token_hash`, `fecha_expiracion`, `utilizado`) 
        //VALUES ('10','password_reset','abc123',DATE_ADD(CURTIME(), INTERVAL 30 MINUTE), false)

        //generar la consulta y guardar en BD
        $clave = hash('sha256', $token);

        $sql = "INSERT INTO {$this->table} (`usuario_id`, `proposito`, `token_hash`, `fecha_expiracion`, `utilizado`) 
                VALUES ('{$id}','password_reset','{$clave}', DATE_ADD(CURTIME(), INTERVAL 30 MINUTE),false)";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute();
    }

}


?>