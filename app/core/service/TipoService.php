<?php

namespace app\core\service;

use app\core\model\base\InterfaceDTO;
use app\core\model\dao\TipoDAO;
use app\core\service\base\Service;
use app\core\service\base\InterfaceService;
use app\libs\connection\Connection;



final class TipoService extends Service implements InterfaceService{
    
    public function save(array $object): void{
        $conn = Connection::get();
    }

    public function load($id): InterfaceDTO{
        return new InterfaceDTO;
    }

    public function update(array $object): void{

    }

    public function delete($id): void{

    }

    public function list(): array{
        $conn = Connection::get();
        $dao = new TipoDAO($conn);
        return $dao->list();
    }
    
}