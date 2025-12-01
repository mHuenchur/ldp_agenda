<?php

namespace app\core\model\dto;

use app\core\model\base\InterfaceDTO;

final class TelefonoDTO  implements InterfaceDTO
{
    private $id, $numero, $etiqueta, $contacto_id;


public function __construct($data = [])
{
    $this->setId($data["id"] ?? "0");
    $this->setNumero($data["numero"] ?? "");
    $this->setEtiqueta($data["etiqueta"] ?? "");
    $this->setContactoId($data["contacto_id"] ?? "");
}

public function getId(): int{
    return $this->id;
}
public function getEtiqueta(): string{
    return $this->etiqueta;
}
public function getNumero(): string{
    return $this->numero;
}
public function getContactoId(): string{
    return $this->contacto_id;
}


public function setId($id): void{
    $this->id =
    (is_numeric($id) && $id > "0") 
    ? $id 
    : "0";
}
public function setEtiqueta($etiqueta): void{
    $this->etiqueta =
    (is_string($etiqueta) && (strlen(trim($etiqueta)) <= 45))
    ? $etiqueta
    : "";
}
public function setNumero($numero): void{
    $this->numero =
    (is_string($numero) && (strlen(trim($numero)) <= 45))
    ? $numero
    : "";
}
public function setContactoId($contactoId): void{
    $this->contacto_id =
    (is_numeric($contactoId) && $contactoId > "0") 
    ? $contactoId 
    : "0";
}


// ** METODOS **
public function toArray(): array{
    return [
        "id" => $this->getId(),
        "numero" => $this->getNumero(),
        "etiqueta" => $this->getEtiqueta(),
        "contacto_id" => $this->getContactoId(),
    ];
}
}