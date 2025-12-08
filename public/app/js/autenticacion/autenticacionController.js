let autenticacionController = {
    dataUsuario: {
        id: "0",
        nombre: "",
        apellido: "",
        nombreUsuario: "",
        correo: "",
        clave: "",
        valor: "",
        tiempo: ""
    },
    saveUsuario: () => {
        let form = document.forms["formularioAltaUsuario"];
        let nombre = form.datoNombres.value.trim();
        let apellido = form.datoApellido.value.trim();
        let email = form.datoEmail.value.trim();
        let nombreUsuario = form.datoUsuario.value.trim();
        let clave = form.datoClave.value.trim();
        //CAMPOS NO VACIOS
        if (!nombre) {
            autenticacionController.showMessage("El nombre no puede estar vacio");
            return;
        }
        if (!apellido) {
            autenticacionController.showMessage("El apellido no puede estar vacio");
            return;
        }
        if (!email) {
            autenticacionController.showMessage("El email no puede estar vacio");
            return;
        }
        if (!nombreUsuario) {
            autenticacionController.showMessage("El nombre de usuario no puede estar vacio");
            return;
        }
        if (!clave) {
            autenticacionController.showMessage("La clave no puede estar vacia");
            return;
        }
        //RESPETAR TAMAÑO
        if (nombre.length > 45) {
            autenticacionController.showMessage("El nombre no puede superar 45 caracteres");
            return;
        }
        if (apellido.length > 45) {
            autenticacionController.showMessage("El apellido no puede superar 45 caracteres");
            return;
        }
        if (email.length > 50) {
            autenticacionController.showMessage("El email no puede superar 50 caracteres");
            return;
        }
        if (nombreUsuario.length > 45) {
            autenticacionController.showMessage("El nombre de usuario no puede superar 45 caracteres");
            return;
        }
        if (clave.length > 45) {
            autenticacionController.showMessage("La clave no puede superar 45 caracteres");
            return;
        }
        //RESPETAR FORMATO
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            autenticacionController.showMessage("El email no tiene un formato válido");
            return;
        }

        autenticacionController.dataUsuario.nombre = nombre;
        autenticacionController.dataUsuario.apellido = apellido;
        autenticacionController.dataUsuario.nombreUsuario = nombreUsuario;
        autenticacionController.dataUsuario.correo = email;
        autenticacionController.dataUsuario.clave = clave;

        autenticacionService.saveUsuario(autenticacionController.dataUsuario)
        .then(response => {
            console.log("Respuesta del servidor", response)
            if(response.error == ""){
                window.location.href = response.controlador + "/index";
                form.reset();
            }
            else{
                autenticacionController.showMessage(response.error);
            }
        })
    },
    login: () =>{
        let formUsuario = document.getElementById("datoUsuarioLogin");
        let formClave = document.getElementById("datoClaveLogin");
        let usuario = formUsuario.value.trim();
        let clave = formClave.value.trim();
        if (usuario === '' || clave === '') {
            autenticacionController.showMessage("Campos vacios.");
        } else {
            autenticacionController.dataUsuario.nombreUsuario = usuario;
            autenticacionController.dataUsuario.clave = clave;
            autenticacionService.login(autenticacionController.dataUsuario)
            .then(response => {
                if(response.error === "" && response.mensaje === "OK"){
                    window.location.href = response.controlador + "/index";
                }else{
                    autenticacionController.showMessage(response.error);
                }
            })
        }
    },
    passwordReset: () => {
        autenticacionController.dataUsuario.correo = document.getElementById("datoCorreo").value.trim();
        if (autenticacionController.dataUsuario.correo !== "") {
            autenticacionService.passwordReset(autenticacionController.dataUsuario)
            .then(response => {
                if(response.error === ""){
                    autenticacionController.showMessage(response.mensaje);
                    document.getElementById("datoCorreo").value = '';
                    setTimeout(() => {
                            window.location.href= "autenticacion/index";
                        }, 3000);
                }else{
                    autenticacionController.showMessage(response.error);
                }
            })
        } else {
            autenticacionController.showMessage("Campo correo vacio!");
        }
    },
    resetPassword: () => {
        //tomamos el valor en el input de clave
        autenticacionController.dataUsuario.clave = document.getElementById("claveNueva").value.trim();
        autenticacionController.dataUsuario.valor = document.getElementById("key").value;
        //lo enviamos al service
        if (autenticacionController.dataUsuario.clave !== "") {
            autenticacionService.resetPassword(autenticacionController.dataUsuario)
            .then(response => {
                    if(response.error === ""){
                        autenticacionController.showMessage(response.mensaje);
                        document.getElementById("claveNueva").value = '';
                        setTimeout(() => {
                            window.location.href= "autenticacion/index";
                        }, 3000);
                    }else{
                        autenticacionController.showMessage(response.error);
                    }
                })
        } else {
            autenticacionController.showMessage("Campo clave vacio!");
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
