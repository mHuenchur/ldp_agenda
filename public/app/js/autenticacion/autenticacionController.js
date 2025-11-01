let autenticacionController = {
    dataUsuario: {
        id: "0",
        nombre: "",
        apellido: "",
        nombreUsuario: "",
        correo: "",
        clave: "",
        valor: ""
    },
    saveUsuario: () => {
        let form = document.forms["formularioAltaUsuario"];

        if (form.checkValidity()){
            //COMPLETAR VERIFICACIONES
            if (false) {
                autenticacionController.showMessage("Existen campos vacios!");
            }else{
                autenticacionController.dataUsuario.nombre = form.datoNombres.value;
                autenticacionController.dataUsuario.apellido = form.datoApellido.value;
                autenticacionController.dataUsuario.nombreUsuario = form.datoUsuario.value;
                autenticacionController.dataUsuario.correo = form.datoEmail.value;
                autenticacionController.dataUsuario.clave = form.datoClave.value;

                autenticacionService.saveUsuario(autenticacionController.dataUsuario)
                .then(response => {
                    console.log("Respuesta del servidor", response)
                    if(response.error == ""){
                        window.location.href = response.controlador + "/index";
                        //autenticacionController.showMessage(response.mensaje);
                        form.reset();
                    }
                    else{
                        //autenticacionController.showMessage(response.error);
                    }
                })
            }
        }

    },
    login: () =>{
        let formUsuario = document.getElementById("datoUsuarioLogin");
        let formClave = document.getElementById("datoClaveLogin");
        autenticacionController.dataUsuario.nombreUsuario = formUsuario.value;
        autenticacionController.dataUsuario.clave = formClave.value;

        autenticacionService.login(autenticacionController.dataUsuario)
        .then(response => {
            if(response.error === "" && response.mensaje === "OK"){
                //console.log("Respuesta del servidor", response)
                window.location.href = response.controlador + "/index";
            }else{
                console.log(response.error);
                /*
                const toastLiveExample = document.getElementById('liveToast')
                const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)
                const message = document.getElementById("messageContainer");
                message.innerHTML = response.error;
                toastBootstrap.show()*/
            }
        })
    },
    passwordReset: () => {
        autenticacionController.dataUsuario.correo = document.getElementById("datoCorreo").value;
        if (autenticacionController.dataUsuario.correo !== "") {
            autenticacionService.passwordReset(autenticacionController.dataUsuario)
            .then(response => {
                if(response.error === ""){
                    //autenticacionController.showMessage(response.mensaje);
                    document.getElementById("datoCorreo").value = '';
                }else{
                    //autenticacionController.showMessage(response.error);
                }
            })
        } else {
            //autenticacionController.showMessage("Campos vacios!");
        }
    },
    resetPassword: () => {
        //tomamos el valor en el input de clave
        autenticacionController.dataUsuario.clave = document.getElementById("claveNueva").value;
        autenticacionController.dataUsuario.valor = document.getElementById("key").value;
        //lo enviamos al service
        autenticacionService.resetPassword(autenticacionController.dataUsuario)
        .then(response => {
                if(response.error === ""){
                    console.log("se cambio la contraseña en bd");
                    //autenticacionController.showMessage(response.mensaje);
                    //document.getElementById("datoCorreo").value = '';
                }else{
                    console.log("no se pudo cambiar");
                    //autenticacionController.showMessage(response.error);
                }
            })
    },

    showMessage: (respuesta) => {
        const toastLiveExample = document.getElementById('liveToast')
        const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)
        const message = document.getElementById("messageContainer");
        message.innerHTML = respuesta;
        toastBootstrap.show()
    }
}


document.addEventListener("DOMContentLoaded", () => {
    let btnLogin = document.getElementById("btnLogin");
    let btnRegister = document.getElementById("btnRegister");
    if(btnLogin != null){
        btnLogin.onclick = () => {
            autenticacionController.login();
        }
    }
    if(btnRegister != null){
        btnRegister.onclick = () => {
            autenticacionController.saveUsuario();
        }
    }
})
