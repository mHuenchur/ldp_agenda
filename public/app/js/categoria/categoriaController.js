let categoriaController = {
    dataCategoria: {
        id: "",
        nombre: "",
        usuario_id: ""
    },
    guardando: false,
    saveCategoria: () => {

        if (categoriaController.guardando) {
            return;
        }

        let nombre = document.getElementById("inputNombreCategoria").value.trim();
        if (nombre === "") {
            categoriaController.showMessage("El nombre de la categoria no puede estar vacio.");
            return;
        }

        categoriaController.dataCategoria.nombre = nombre;

        categoriaController.guardando = true;

        btnNew.disabled = true;
        btnNew.textContent = "Guardando...";

        categoriaService.saveCategoria(categoriaController.dataCategoria)
        .then(response => {
            if(response.error === ""){
                const myModalEl = document.getElementById('categoriaModal');
                const modalInstance = bootstrap.Modal.getOrCreateInstance(myModalEl);
                modalInstance.hide();
                categoriaController.showMessage(response.mensaje)
                setTimeout(() => {
                    location.reload();
                }, 2000);
            }else{
                categoriaController.showMessage(response.error)
            }
        }).finally(() => {
            categoriaController.guardando = false;

            btnNew.disabled = false;
            btnNew.textContent = "Guardar";
        });
    },
    updateCategoria: () => {
        categoriaController.dataCategoria.id = document.getElementById("categoriaId").value;
        categoriaController.dataCategoria.nombre = document.getElementById("nombre").value;
        categoriaService.updateCategoria(categoriaController.dataCategoria)
        .then(response => {
            if(response.error === ""){
                categoriaController.showMessage(response.mensaje)
                setTimeout(() => {
                    location.reload();
                }, 2000);
            }else{
                categoriaController.showMessage(response.error)
            }
        })
    },
    deleteCategoria: ($id) => {
        categoriaService.deleteCategoria($id)
        .then(response => {
            if(response.error === ""){
                categoriaController.showMessage(response.mensaje);
                setTimeout(() => {
                    location.reload();
                }, 2000);
            }else{
                categoriaController.showMessage(response.error);
            }
        })
    },
    checkInputs: () => {
        let inputNombre = document.getElementById("inputNombreCategoria");
        const val = (inputNombre.value || '').trim();
        if (!val)        { categoriaController.showMessage('Campo obligatorio.'); return false; }
        if (val.length < 3) { categoriaController.showMessage('Mínimo 3 caracteres.'); return false; }
        if (val.length > 45){ categoriaController.showMessage('Máximo 45 caracteres.'); return false; }
        return true;
    },
    showMessage: (respuesta) => {
        const toastLiveExample = document.getElementById('liveToast')
        const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)
        const message = document.getElementById("messageContainer");
        message.innerHTML = respuesta;
        toastBootstrap.show();
    }
}

let btnNew = document.getElementById("btnNuevaCategoria");

if (!(btnNew === null)) {
    btnNew.onclick = () => {
        categoriaController.saveCategoria();
    }
}


