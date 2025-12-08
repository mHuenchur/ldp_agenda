<?php

namespace app\core\service;

use app\core\model\base\InterfaceDTO;
use app\core\model\dao\RecordatorioDAO;
use app\core\model\dto\RecordatorioDTO;
use app\core\service\base\Service;
use app\core\service\base\InterfaceService;
use app\libs\connection\Connection;
use Exception;

final class RecordatorioService extends Service implements InterfaceService{
    
    public function save(array $object){
        $conn = Connection::get();
        $dao = new RecordatorioDAO($conn);
        $recordatorio = new RecordatorioDTO($object);
        if ($recordatorio->getNombre() == "") {
            throw new \Exception("NOMBRE");
        }
        if ($recordatorio->getFechaHora() == "") {
            throw new \Exception("FECHA-HORA");
        }
        if ($recordatorio->getLugar() == "") {
            throw new \Exception("LUGAR");
        }
        return $dao->save($recordatorio);
    }

    public function load($id): InterfaceDTO{
        $conn = Connection::get();
        $dao = new RecordatorioDAO($conn);
        return $dao->load($id);
    }

    public function update(array $object): void{
        $conn = Connection::get();
        $dao = new RecordatorioDAO($conn);
        $recordatorio = new RecordatorioDTO($object);
        if ($recordatorio->getNombre() == "") {
            throw new \Exception("NOMBRE");
        }
        if ($recordatorio->getFechaHora() == "") {
            throw new \Exception("FECHA-HORA");
        }
        if ($recordatorio->getLugar() == "") {
            throw new \Exception("LUGAR");
        }
        if ($recordatorio->getId() == "") {
            throw new \Exception("ID");
        }
        $dao->update($recordatorio);
    }

    public function deleteRecordatorio($rid, $uid){
        $conn = Connection::get();
        $dao = new RecordatorioDAO($conn);

        $recordatorio = $dao->findById($rid);
        $valor = $recordatorio->toArray();
        if ($recordatorio == null) {
            throw new \Exception("RECORDATORIO NO ENCONTRADO");
        }

        $recordatorioId = (int)$recordatorio->getUsuarioId();
        $usuarioId = (int)$uid;
        if ($recordatorioId !== $usuarioId) {
            throw new \Exception("ACCION DENEGADA");
        }

        $dao->eliminarRelacion($rid);
        $dao->delete($rid);
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

    public function eliminarRelacion($id){
        $conn = Connection::get();
        $dao = new RecordatorioDAO($conn);
        $dao->eliminarRelacion($id);
    }

    public function listarRelacion($id){
        $conn = Connection::get();
        $dao = new RecordatorioDAO($conn);
        return $dao->listarRelacion($id);
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