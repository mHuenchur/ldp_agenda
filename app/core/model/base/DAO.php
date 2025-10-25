<?php

namespace app\core\model\base;

Class DAO {
    protected $conn, $table;

    public function __construct($conn, $table)
    {
        $this->conn = $conn;
        $this->table = $table;
    }
}