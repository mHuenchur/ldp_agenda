<?php

namespace app\core\model\dao;

use app\core\model\base\DAO;
use app\core\model\base\InterfaceDAO;
use app\core\model\base\InterfaceDTO;
use app\core\model\dto\UsuarioDTO;

final class UsuarioDAO extends DAO implements InterfaceDAO
{
    public function __construct($conn)
    {
        parent::__construct($conn, "usuario");
    }

    public function save(InterfaceDTO $object)
    {
        $sql = "INSERT INTO {$this->table} VALUES (DEFAULT, :nombre, :apellido, :nombre_usuario, :email, :clave, :tiempo_notificacion)";
        $stmt = $this->conn->prepare($sql);
        $data = $object->toArray();
        unset($data["id"]);
        unset($data["perfil_id"]);


        $clave = password_hash($object->getClave(), PASSWORD_DEFAULT);
        $data["clave"] = $clave;


        $stmt->execute($data);
        return $this->conn->lastInsertId();
    }

    public function load($id): InterfaceDTO
    {
        $sql = "SELECT `id`, `nombre`, `apellido`, `nombre_usuario` AS 'nombreUsuario', `email` AS 'correo', `tiempo_notificacion` AS 'tiempo' FROM `usuario` WHERE usuario.id = :uid";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'uid' => $_SESSION["id"],
        ]);
        return new UsuarioDTO($stmt->fetch(\PDO::FETCH_ASSOC));
    }

    public function update(InterfaceDTO $object): void
    {
        $sql = "UPDATE `usuario` SET `nombre`= :nombre,`apellido`= :apellido,`nombre_usuario`= :nombre_usuario,`email`= :email,`tiempo_notificacion`= :tiempo_notificacion 
        WHERE usuario.id = ". $_SESSION["id"];
        $stmt = $this->conn->prepare($sql);
        $data = $object->toArray();
        unset($data["id"]);
        unset($data["clave"]);
        unset($data["perfil_id"]);
        $stmt->execute($data);
    }
    public function updateClave($object)
    {
        $sql = "SELECT clave FROM `usuario` 
        WHERE usuario.id = ".$_SESSION["id"];
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $cuenta = $stmt->fetch(\PDO::FETCH_OBJ);
        
        if(!password_verify($object["clave"], $cuenta->clave)){
            throw new \Exception("clave es inválido");
        }else {
            $clave = password_hash($object["nueva"], PASSWORD_DEFAULT);

            $sql = "UPDATE `usuario` SET `clave`= :clave
            WHERE usuario.id = ". $_SESSION["id"];
            
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                "clave" => $clave
            ]);
        }
    }

    public function delete($id): void
    {
        
    }

    public function list(): array
    {
        return array();
    }

    public function emailCheck($email): ?string
    {
        $sql = "SELECT usuario.id FROM {$this->table} WHERE usuario.email = '{$email}'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $resultado = $stmt->fetchColumn();
        if($resultado === false){
            $resultado = NULL;
        }
        return $resultado;
    }

    public function updatePassword($id, $clave){

        $nuevaClave = password_hash($clave, PASSWORD_DEFAULT);
        
        $sql = "UPDATE usuario SET clave = '{$nuevaClave}' WHERE usuario.id = '{$id}'";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute();
    }

    public function existeUsuarioEmail($nombreUsuario, $correo){
        $sql = "SELECT 1 
                FROM usuario 
                WHERE nombre_usuario = :user OR email = :correo
                LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            "user" => $nombreUsuario,
            "correo" => $correo,
        ]);
        return (bool)$stmt->fetchColumn();
    }

    public function existeUsuarioEmailOtroUsuario($id, $nombreUsuario, $correo){
        $sql = "SELECT 1 
                FROM usuario 
                WHERE id <> :id
                  AND (nombre_usuario = :user OR email = :correo)
                LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            "id" => $id,
            "user" => $nombreUsuario,
            "correo" => $correo,
        ]);
        return (bool)$stmt->fetchColumn();
    }

}


?>