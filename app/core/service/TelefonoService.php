<?php

namespace app\core\service;

use app\core\model\base\InterfaceDTO;
use app\core\model\dao\TelefonoDAO;
use app\core\model\dto\TelefonoDTO;
use app\core\service\base\Service;
use app\core\service\base\InterfaceService;
use app\libs\connection\Connection;



final class TelefonoService extends Service implements InterfaceService{
    
    public function save(array $object){
        $conn = Connection::get();
        $dao = new TelefonoDAO($conn);
        $telefono = new TelefonoDTO($object);
        if ($telefono->getEtiqueta() == "") {
            throw new \Exception("ALGUNA ETIQUETA VACIA");
        }
        if ($telefono->getNumero() == "") {
            throw new \Exception("ALGUN NUMERO VACIO");
        }
        if ($telefono->getContactoId() == "") {
            throw new \Exception("CONTACTO-TELEFONO");
        }
        return $dao->save($telefono);
    }

    public function load($id): InterfaceDTO{
        return new InterfaceDTO;
    }

    public function update(array $object): void{

    }

    public function delete($id): void{
        $conn = Connection::get();
        $dao = new TelefonoDAO($conn);
        $dao->delete($id);
    }

    public function list(): array{
        $conn = Connection::get();
        return [];
    }

    public function listByContacto($id){
        $conn = Connection::get();
        $dao = new TelefonoDAO($conn);
        return $dao->listByContacto($id);
    }
    
}