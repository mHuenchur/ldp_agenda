<!DOCTYPE html>
<html lang="es">
<head>
    <?php
    require_once APP_TEMPLATE . "includes/head.php";
    
    foreach($this->scripts as $script){
        echo ('<script defer type="text/javascript" src=" '. $script .' "></script>');
    }

    ?>
</head>
<body>
    <header>
    <?php
    
    if(isset($_SESSION["token"]) && $_SESSION["token"] === APP_TOKEN){
        if ($_SESSION["perfil"] === "usuario") {
            require_once APP_TEMPLATE . "includes/usuarioHeader.php";
        } else {
            if ($_SESSION["perfil"] === "administrador") {
                require_once APP_TEMPLATE . "includes/administradorHeader.php";
            }
        }
    }/*else {
        if ($this->view != "autenticacion/logout.php") {
            require_once APP_TEMPLATE . "includes/autenticacionHeader.php";
        }
    }*/

    ?>
    </header>
    <main>
    <?php
    require_once APP_VIEWS . $this->view;
    ?>
    </main>
    <footer>
    </footer>
</body>
</html>