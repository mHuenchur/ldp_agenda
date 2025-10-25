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

}


?>