let usuarioController = {
    dataUsuario: {
        id: "",
        nombre: "",
        apellido: "",
        nombreUsuario: "",
        correo: "",
        tiempo: "",
    },
    dataClave: {
        clave: "",
        nueva: "",
    },
    updateUsuario: () => {
        if (usuarioController.validacion()) {
        
            usuarioController.dataUsuario.nombre = document.getElementById("usuarioNombre").value;
            usuarioController.dataUsuario.apellido = document.getElementById("usuarioApellido").value;
            usuarioController.dataUsuario.nombreUsuario = document.getElementById("usuarioUsername").value;
            usuarioController.dataUsuario.correo = document.getElementById("usuarioEmail").value;
            usuarioController.dataUsuario.tiempo = document.getElementById("usuarioTiempo").value;

            
            usuarioService.updateUsuario(usuarioController.dataUsuario)
            .then(response => {
                if(response.error === ""){
                    console.log(response.mensaje);
                }else{
                    console.log("NO SE PUDO GUARDAR");
                }
            })
        }
    },
    validacion: () => {
        return true;
    },
    updateClave: () => {
        $claveActual = document.getElementById("passActual").value;
        $claveNueva = document.getElementById("passNueva").value;
        $claveConfirmar = document.getElementById("passConfirmar").value;
        if ($claveNueva == $claveConfirmar) {
            usuarioController.dataClave.clave = $claveActual;
            usuarioController.dataClave.nueva = $claveNueva;

            usuarioService.updateClave(usuarioController.dataClave)
            .then(response => {
                if(response.error === ""){
                    console.log(response.mensaje);
                }else{
                    console.log("NO SE PUDO ACTUALIZAR");
                }
            })
        } else {
            console.log("valores incorrectos...");
        }
    }
}