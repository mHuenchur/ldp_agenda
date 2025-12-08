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
                    usuarioController.showMessage(response.mensaje);
                    setTimeout(() => {
                    location.reload();
                    }, 2000);
                }else{
                    usuarioController.showMessage(response.error);
                }
            })
        }
    },
    validacion: () => {
        return true;
    },
    updateClave: () => {
        $claveActual = document.getElementById("passActual").value.trim();
        $claveNueva = document.getElementById("passNueva").value.trim();
        $claveConfirmar = document.getElementById("passConfirmar").value.trim();
        if ($claveActual != "" && $claveNueva != "" && $claveConfirmar != "" && ($claveNueva == $claveConfirmar)) {
            usuarioController.dataClave.clave = $claveActual;
            usuarioController.dataClave.nueva = $claveNueva;

            usuarioService.updateClave(usuarioController.dataClave)
            .then(response => {
                if(response.error === ""){
                    usuarioController.showMessage(response.mensaje);
                    setTimeout(() => {
                    location.reload();
                    }, 2000);
                }else{
                    usuarioController.showMessage(response.error);
                }
            })
        } else {
            usuarioController.showMessage("Campos vacios o incorrectos.");
        }
    },
    showMessage: (respuesta) => {
        const toastLiveExample = document.getElementById('liveToast')
        const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)
        const message = document.getElementById("messageContainer");
        message.innerHTML = respuesta;
        toastBootstrap.show();
    }
}