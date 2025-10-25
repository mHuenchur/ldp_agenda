<?php

namespace app\libs\authentication;

use app\libs\connection\Connection;

final class Authentication{

    public static function login($user, $pass): void{
        //validar formato del usuario y contraseña
        $conn = Connection::get();
        $sql = "SELECT CONCAT(usuario.nombre,', ',apellido) AS usuario, id, nombre_usuario, clave, email FROM `usuario` WHERE `nombre_usuario` = :nombreUsuario"; 
        $stmt = $conn->prepare($sql);
        if(!$stmt->execute(["nombreUsuario" => $user])){
            throw new \Exception("No se pudo <i>ejecutar</i> la consulta");
        }
        if($stmt->rowCount() !== 1){
            throw new \Exception("El usuario o clave es inválido");
        }
        $cuenta = $stmt->fetch(\PDO::FETCH_OBJ);
        
        if(!password_verify($pass, $cuenta->clave)){
            throw new \Exception("El usuario o clave es inválido");
        }
        

        //paso las validaciones, la cuenta es valida
        //se crean las variables de sessión
        $_SESSION["token"] = APP_TOKEN;
        $_SESSION["usuario"] = $cuenta->usuario;
        //$_SESSION["perfil"] = $cuenta->perfil;

    }

    public static function logout(): void{
        session_unset();
        if (ini_get("session.use_cookies")){
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, $params["path"],
            $params["domain"], $params["secure"], $params["httponly"]);
            }
        session_destroy();
    }

}