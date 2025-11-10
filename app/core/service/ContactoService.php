<?php

namespace app\core\service;

use app\core\model\base\InterfaceDTO;
use app\core\model\dao\ContactoDAO;
use app\core\model\dto\ContactoDTO;
use app\core\service\base\Service;
use app\core\service\base\InterfaceService;
use app\libs\connection\Connection;



final class ContactoService extends Service implements InterfaceService{
    
    public function save(array $object): void{
        $conn = Connection::get();
        $dao = new ContactoDAO($conn);
        $dao->save(new ContactoDTO($object));
        //FALTA DAO TELEFONO CON EL ID ETIQUETA Y EL ID DEL CONTACTO QUE AGREGAMOS
    }

    public function load($id): InterfaceDTO{
        return new InterfaceDTO;
    }

    public function update(array $object): void{

    }

    public function delete($id): void{

    }

    public function list(): array{
        return [];
    }
    
}