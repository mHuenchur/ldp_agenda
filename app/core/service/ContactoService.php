<?php

namespace app\core\service;

use app\core\model\base\InterfaceDTO;
use app\core\model\dao\ContactoDAO;
use app\core\model\dto\ContactoDTO;
use app\core\service\base\Service;
use app\core\service\base\InterfaceService;
use app\libs\connection\Connection;



final class ContactoService extends Service implements InterfaceService{
    
    public function save(array $object){
        $conn = Connection::get();
        $dao = new ContactoDAO($conn);
        return $dao->save(new ContactoDTO($object));
        //FALTA DAO TELEFONO CON EL ID ETIQUETA Y EL ID DEL CONTACTO QUE AGREGAMOS
    }

    public function load($id): InterfaceDTO{
        $conn = Connection::get();
        $dao = new ContactoDAO($conn);
        return $dao->load($id);
    }

    public function update(array $object): void{

    }

    public function delete($id): void{

    }

    public function list(): array{
        $conn = Connection::get();
        $dao = new ContactoDAO($conn);
        return $dao->list();
    }

    public function filter(array $object): array{
        //
        $conn = Connection::get();
        $dao = new ContactoDAO($conn);
        return $dao->filter($object);
    }

    public function cumpleaños(): array{
        $conn = Connection::get();
        $dao = new ContactoDAO($conn);
        return $dao->cumpleaños();
    }

    public function cumpleañosProximos(): array{
        $conn = Connection::get();
        $dao = new ContactoDAO($conn);
        return $dao->cumpleañosProximos();
    }
    
}