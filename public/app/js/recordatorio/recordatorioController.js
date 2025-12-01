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

            [...select.selectedOptions].forEach(o => {
            const id = Number(o.value);
            if (Number.isFinite(id)) {
            recordatorioController.dataRecordatorio.contactos.push({ contacto: id });
            }
            });
            recordatorioService.saveRecordatorio(recordatorioController.dataRecordatorio)
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
    }
}