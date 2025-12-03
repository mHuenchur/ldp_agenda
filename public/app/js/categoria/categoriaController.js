let categoriaController = {
    dataCategoria: {
        id: "",
        nombre: "",
        usuario_id: ""
    },
    saveCategoria: () => {
        if(categoriaController.checkInputs()){
            categoriaController.dataCategoria.nombre = document.getElementById("inputNombreCategoria").value;
            categoriaService.saveCategoria(categoriaController.dataCategoria)
            .then(response => {
                if(response.error === ""){
                    setTimeout(() => {
                        location.reload();
                    }, 3000);
                }else{
                    console.log("NO");
                }
            })
        }
    },
    updateCategoria: () => {
        categoriaController.dataCategoria.id = document.getElementById("categoriaId").value;
        categoriaController.dataCategoria.nombre = document.getElementById("nombre").value;
        categoriaService.updateCategoria(categoriaController.dataCategoria)
        .then(response => {
            if(response.error === ""){
                console.log(response.mensaje);
                setTimeout(() => {
                    location.reload();
                }, 3000);
            }else{
                console.log("NO");
            }
        })
    },
    deleteCategoria: ($id) => {
        categoriaService.deleteCategoria($id)
        .then(response => {
            if(response.error === ""){
                console.log(response.mensaje);
            }else{
                console.log(response.error);
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
        console.log(respuesta);
    }
}

let btnNew = document.getElementById("btnNuevaCategoria");

if (!(btnNew === null)) {
    btnNew.onclick = () => {
        categoriaController.saveCategoria();
    }
}


