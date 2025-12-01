<?php

namespace app\core\service;

use app\core\model\base\InterfaceDTO;
use app\core\model\dao\RecordatorioDAO;
use app\core\model\dto\RecordatorioDTO;
use app\core\service\base\Service;
use app\core\service\base\InterfaceService;
use app\libs\connection\Connection;


final class RecordatorioService extends Service implements InterfaceService{
    
    public function save(array $object){
        $conn = Connection::get();
        $dao = new RecordatorioDAO($conn);
        return $dao->save(new RecordatorioDTO($object));
    }

    public function load($id): InterfaceDTO{
        return new InterfaceDTO();
    }

    public function update(array $object): void{

    }

    public function delete($id): void{

    }

    public function list(): array{
        $conn = Connection::get();
        $dao = new RecordatorioDAO($conn);
        return $dao->list();
    }

    public function guardarRelacion(array $object){
        $conn = Connection::get();
        $dao = new RecordatorioDAO($conn);
        return $dao->guardarRelacion($object);
    }

    public function listarVigentes(){
        $conn = Connection::get();
        $dao = new RecordatorioDAO($conn);
        return $dao->listarVigentes();
    }

    public function listarVencidos(){
        $conn = Connection::get();
        $dao = new RecordatorioDAO($conn);
        return $dao->listarVencidos();
    }
    
}