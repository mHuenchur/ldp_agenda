let categoriaController = {
    dataCategoria: {
        id: "",
        nombre: "",
        user: ""
    },
    saveCategoria: () => {
        if(categoriaController.checkInputs()){
            categoriaController.dataCategoria.nombre = document.getElementById("inputNombreCategoria").value;
            categoriaService.saveCategoria(categoriaController.dataCategoria)
            .then(response => {
                if(response.error === ""){
                    console.log("YES");
                }else{
                    console.log("NO");
                }
            })
        }
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

btnNew.onclick = () => {
    categoriaController.saveCategoria();
}
