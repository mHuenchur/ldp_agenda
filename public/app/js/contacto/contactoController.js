let contactoController = {
    dataContacto: {
        id: "101",
        nombre: "Max",
        apellido: "Power",
        razon_social: "debe llegar a db vacio",
        direccion: "Sarmiento 2500",
        email: "PowerM@gmail.com",
        sitio_web: "TheMaxPower",
        fecha_nacimiento: "",
        observaciones: "Awesome guy!",
        tipo: "1",
        categoria: "2",
        usuario: "",
        telefonos: [
            {etiqueta: "móvil", numero: "444555"},
            {etiqueta: "trabajo", numero: "666777"}
        ]
    },
    saveContacto: () => {
        //VALIDAR CAMPOS
        //ENVIAR AL SERVICE
        contactoService.saveContacto(contactoController.dataContacto)
        .then(response => {
                if(response.error === ""){
                    console.log("GUARDADO");
                }else{
                    console.log("NO SE PUDO GUARDAR");
                }
            })
    }
}