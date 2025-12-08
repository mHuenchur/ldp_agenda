let recordatorioController = {
    dataRecordatorio: {
        id: "",
        nombre: "",
        fecha_hora: "",
        lugar: "",
        usuario_id: "",
        recordatorio_id: "",
        contactos: [
        ]
    },
    saveRecordatorio: () => {
        if (recordatorioController.validacion()) {
            const select = document.getElementById('contactoId');
            recordatorioController.dataRecordatorio.nombre = document.getElementById("inputDescripcion").value;
            recordatorioController.dataRecordatorio.fecha_hora = document.getElementById("inputFechaHora").value;
            recordatorioController.dataRecordatorio.lugar = document.getElementById("inputLugar").value;
            recordatorioController.dataRecordatorio.contactos = [];
            
            [...select.selectedOptions].forEach(o => {
            const id = Number(o.value);
            if (Number.isFinite(id)) {
            recordatorioController.dataRecordatorio.contactos.push({ contacto: id });
            }
            });
            recordatorioService.saveRecordatorio(recordatorioController.dataRecordatorio)
            .then(response => {
                if(response.error === ""){
                    recordatorioController.showMessage(response.mensaje);
                    setTimeout(() => {
                        window.location.href= "recordatorio/index";
                    }, 2000);
                }else{
                    recordatorioController.showMessage(response.error);
                }
            })
        }
    },
    updateRecordatorio: () => {
        if (recordatorioController.validacion()) {
            const select = document.getElementById('contactos');
            recordatorioController.dataRecordatorio.id = document.getElementById("id").value;
            recordatorioController.dataRecordatorio.nombre = document.getElementById("descripcion").value;
            recordatorioController.dataRecordatorio.fecha_hora = document.getElementById("fecha_hora").value;
            recordatorioController.dataRecordatorio.lugar = document.getElementById("lugar").value;
            recordatorioController.dataRecordatorio.contactos = [];

            [...select.selectedOptions].forEach(o => {
            const id = Number(o.value);
            if (Number.isFinite(id)) {
            recordatorioController.dataRecordatorio.contactos.push({ contacto: id });
            }
            });
            recordatorioService.updateRecordatorio(recordatorioController.dataRecordatorio)
            .then(response => {
                if(response.error === ""){
                    recordatorioController.showMessage(response.mensaje);
                    setTimeout(() => {
                        window.location.href= "recordatorio/index";
                    }, 2000);
                }else{
                    recordatorioController.showMessage(response.error);
                }
            })
        }
    },
    deleteRecordatorio: ($id) => {
        recordatorioService.deleteRecordatorio($id)
        .then(response => {
            if(response.error === ""){
                recordatorioController.showMessage(response.mensaje);
                setTimeout(() => {
                    location.reload();
                }, 2000);
            }else{
                recordatorioController.showMessage(response.error);
            }
        })
    },
    validacion: () => {
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