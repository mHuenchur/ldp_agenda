<?php

namespace app\core\service;

use app\core\model\base\InterfaceDTO;
use app\core\model\dao\ContactoDAO;
use app\core\model\dao\TelefonoDAO;
use app\core\model\dto\ContactoDTO;
use app\core\model\dto\TelefonoDTO;
use app\core\service\base\Service;
use app\core\service\base\InterfaceService;
use app\libs\connection\Connection;



final class ContactoService extends Service implements InterfaceService{
    
    public function save(array $object){
        $conn = Connection::get();
        $daoContacto = new ContactoDAO($conn);
        $daoTelefono = new TelefonoDAO($conn);

        $telefonos = $object["telefonos"];
        $telefonosVerificados = [];

        $contacto = new ContactoDTO($object);
        //validaciones
        if ($contacto->getIdTipo() == "") {
            throw new \Exception("Campo tipo vacio.");
        }
        if ($contacto->getIdTipo() == "1" && $contacto->getNombre() == '') {
            throw new \Exception("Campo nombre vacio.");
        }
        if ($contacto->getIdTipo() == "1" && $contacto->getApellido() == '') {
            throw new \Exception("Campo apellido vacio.");
        }
        if ($contacto->getIdTipo() == "1" && $contacto->getFechaNacimiento() == '') {
            throw new \Exception("Campo fecha nacimiento vacio.");
        }
        if ($contacto->getIdTipo() == "2" && $contacto->getRazonSocial() == '') {
            throw new \Exception("Campo razon social vacio.");
        }
        if ($contacto->getDireccion() == '') {
            throw new \Exception("Campo dirección vacio.");
        }
        if ($contacto->getEmail() == '' || (!filter_var($contacto->getEmail(), FILTER_VALIDATE_EMAIL))) {
            throw new \Exception("Campo correo vacio o formato incorrecto.");
        }
        if ($contacto->getSitioWeb() == '') {
            throw new \Exception("Campo sitio web vacio.");
        }
        if ($contacto->getObservaciones() == '') {
            throw new \Exception("Campo observaciones vacio.");
        }
        if ($contacto->getIdCategoria() == '') {
            throw new \Exception("Campo categoria vacio.");
        }

        foreach ($telefonos as $telefono) {
            $itemTelefono = new TelefonoDTO($telefono);
            if ($itemTelefono->getEtiqueta() == '') {
                throw new \Exception("Existen etiquetas vacias.");
            }
            if ($itemTelefono->getNumero() == '') {
                throw new \Exception("Existen numeros vacios.");
            }
            array_push($telefonosVerificados, $itemTelefono);
        }


        $valorContacto =  $daoContacto->save($contacto);
        foreach ($telefonosVerificados as $telefonoVerificado) {
            $telefonoVerificado->setContactoId($valorContacto);
            $daoTelefono->save($telefonoVerificado);
        }
    }

    public function load($id): InterfaceDTO{
        $conn = Connection::get();
        $dao = new ContactoDAO($conn);
        return $dao->load($id);
    }

    public function update(array $object): void{
        $conn = Connection::get();
        $dao = new ContactoDAO($conn);
        $contacto = new ContactoDTO($object);


        //validaciones
        if ($contacto->getIdTipo() == "") {
            throw new \Exception("Campo tipo vacio.");
        }
        if ($contacto->getIdTipo() == "1" && $contacto->getNombre() == '') {
            throw new \Exception("Campo nombre vacio.");
        }
        if ($contacto->getIdTipo() == "1" && $contacto->getApellido() == '') {
            throw new \Exception("Campo apellido vacio.");
        }
        if ($contacto->getIdTipo() == "1" && $contacto->getFechaNacimiento() == '') {
            throw new \Exception("Campo fecha nacimiento vacio.");
        }
        if ($contacto->getIdTipo() == "2" && $contacto->getRazonSocial() == '') {
            throw new \Exception("Campo razon social vacio.");
        }
        if ($contacto->getDireccion() == '') {
            throw new \Exception("Campo dirección vacio.");
        }
        if ($contacto->getEmail() == '' || (!filter_var($contacto->getEmail(), FILTER_VALIDATE_EMAIL))) {
            throw new \Exception("Campo correo vacio o formato incorrecto.");
        }
        if ($contacto->getSitioWeb() == '') {
            throw new \Exception("Campo sitio web vacio.");
        }
        if ($contacto->getObservaciones() == '') {
            throw new \Exception("Campo observaciones vacio.");
        }
        if ($contacto->getIdCategoria() == '') {
            throw new \Exception("Campo categoria vacio.");
        }

        $dao->update($contacto);
    }

    public function delete($id): void{

        $conn = Connection::get();
        $dao = new ContactoDAO($conn);
        if ($dao->tieneRecordatorios($id)) {
            throw new \Exception("ACCION DENEGADA");
        }
        $dao->delete($id);
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