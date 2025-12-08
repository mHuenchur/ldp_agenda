<?php

namespace app\core\service;

use app\core\model\base\InterfaceDTO;
use app\core\model\dao\CategoriaDAO;
use app\core\model\dto\CategoriaDTO;
use app\core\service\base\Service;
use app\core\service\base\InterfaceService;
use app\libs\connection\Connection;



final class CategoriaService extends Service implements InterfaceService{
    
    public function save(array $object): void{
        $conn = Connection::get();
        $dao = new CategoriaDAO($conn);
        $categoria = new CategoriaDTO($object);
        $categoria->setUsuarioId($_SESSION["id"]);
        if ($categoria->getNombre() == "") {
            throw new \Exception("Campo nombre vacio");
        }
        if ($categoria->getUsuarioId() == "0") {
            throw new \Exception("usuario id cero");
        }
        $dao->save($categoria);
    }

    public function load($id): InterfaceDTO{
        $conn = Connection::get();
        $dao = new CategoriaDAO($conn);
        return $dao->load($id);
    }

    public function update(array $object): void{
        $conn = Connection::get();
        $dao = new CategoriaDAO($conn);
        $dao->update(new CategoriaDTO($object));
    }

    public function delete($id): void{
        $conn = Connection::get();
        $dao = new CategoriaDAO($conn);
        if ($dao->tieneContactos($id)) {
            throw new \Exception("ACCION DENEGADA");
        }
        $dao->delete($id);
    }

    public function list(): array{
        $conn = Connection::get();
        $dao = new CategoriaDAO($conn);
        return $dao->list();
    }
    
}