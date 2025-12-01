let contactoController = {
    dataContacto: {
        id: "",
        nombre: "",
        apellido: "",
        razon_social: "",
        direccion: "",
        email: "",
        sitio_web: "",
        fecha_nacimiento: "",
        observaciones: "",
        tipo_id: "",
        categoria_id: "",
        usuario_id: "",
        telefonos: [

        ]
    },
    dataFiltros: {
        categoria: "",
        tipo: ""
    },
    saveContacto: () => {
        //VALIDAR CAMPOS
        if (contactoController.validacion()) {
            const list = document.getElementById('telList');
            contactoController.dataContacto.nombre = document.getElementById("nombre").value;
            contactoController.dataContacto.apellido = document.getElementById("apellido").value;
            contactoController.dataContacto.fecha_nacimiento = document.getElementById("fecha_nacimiento").value;
            contactoController.dataContacto.razon_social = document.getElementById("razon_social").value;
            contactoController.dataContacto.direccion = document.getElementById("direccion").value;
            contactoController.dataContacto.sitio_web = document.getElementById("sitio_web").value;
            contactoController.dataContacto.categoria_id = document.getElementById("categoria").value;
            contactoController.dataContacto.tipo_id = document.getElementById("tipo").value;
            contactoController.dataContacto.email = document.getElementById("email").value;
            contactoController.dataContacto.observaciones = document.getElementById("observaciones").value;

            for (const fila of list.querySelectorAll('.fila')) {
                const etiqueta = fila.querySelector('[name="etiqueta"]').value.trim();
                const numero = fila.querySelector('[name="numero"]').value.trim();
                const contacto_id = "";
                contactoController.dataContacto.telefonos.push({ etiqueta, numero, contacto_id });
            }

            contactoService.saveContacto(contactoController.dataContacto)
            .then(response => {
                if(response.error === ""){
                    console.log(response.mensaje);
                }else{
                    console.log("NO SE PUDO GUARDAR");
                }
            })
        } else {
            
        }
        
    },
    updateContacto: () => {
        if (contactoController.validacion()) {
            const list = document.getElementById('telList');
            contactoController.dataContacto.id = document.getElementById("key").value;
            contactoController.dataContacto.nombre = document.getElementById("nombre").value;
            contactoController.dataContacto.apellido = document.getElementById("apellido").value;
            contactoController.dataContacto.fecha_nacimiento = document.getElementById("fecha_nacimiento").value;
            contactoController.dataContacto.razon_social = document.getElementById("razon_social").value;
            contactoController.dataContacto.direccion = document.getElementById("direccion").value;
            contactoController.dataContacto.sitio_web = document.getElementById("sitio_web").value;
            contactoController.dataContacto.categoria_id = document.getElementById("categoria").value;
            contactoController.dataContacto.tipo_id = document.getElementById("tipo").value;
            contactoController.dataContacto.email = document.getElementById("email").value;
            contactoController.dataContacto.observaciones = document.getElementById("observaciones").value;

            for (const fila of list.querySelectorAll('.fila')) {
                const etiqueta = fila.querySelector('[name="etiqueta"]').value.trim();
                const numero = fila.querySelector('[name="numero"]').value.trim();
                const contacto_id = "";
                contactoController.dataContacto.telefonos.push({ etiqueta, numero, contacto_id });
            }

            contactoService.updateContacto(contactoController.dataContacto)
            .then(response => {
                if(response.error === ""){
                    console.log(response.mensaje);
                }else{
                    console.log("NO SE PUDO GUARDAR");
                }
            })
        } else {
            
        }
    },
    validacion: () => {
        return true;
    },
    filtrarLista: () => {
        contactoController.dataFiltros.categoria = document.getElementById("fCategoria").value;
        contactoController.dataFiltros.tipo = document.getElementById("fTipo").value;
        contactoService.filtrarLista(contactoController.dataFiltros)
        .then(response => {
                if(response.error === ""){
                    if (!(response.result == "")) {
                        dataTable?.destroy();

                        const tabla = document.querySelector('#myTable');
                        const tbody = tabla.tBodies[0];           // o: tabla.querySelector('tbody')
                        tbody.innerHTML = response.result;

                        dataTable = new simpleDatatables.DataTable("#myTable", {
                            labels: {
                            placeholder: "Buscar…",
                            perPage: "contactos por página",              // “entries per page”
                            noRows: "No hay registros",
                            info: "Mostrando {start} a {end} de {rows}", // “Showing 1 to 3 of 3 entries”
                            noResults: "No se encontraron resultados",
                            },
                            searchable: true,
                            fixedHeight: true
                        })
                    } else {
                        dataTable?.destroy();

                        const tabla = document.querySelector('#myTable');
                        const tbody = tabla.tBodies[0];           // o: tabla.querySelector('tbody')
                        tbody.innerHTML = response.result;

                        dataTable = new simpleDatatables.DataTable("#myTable", {
                            labels: {
                            placeholder: "Buscar…",
                            perPage: "contactos por página",              // “entries per page”
                            noRows: "No hay registros",
                            info: "Mostrando {start} a {end} de {rows}", // “Showing 1 to 3 of 3 entries”
                            noResults: "No se encontraron resultados",
                            },
                            searchable: true,
                            fixedHeight: true
                        })
                    }
                }else{
                    console.log("NO");
                }
            })
    }
}