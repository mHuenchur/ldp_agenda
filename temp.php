<!-- TOAST JS -->
<!-- const toastLiveExample = document.getElementById('liveToast')
const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)
const message = document.getElementById("messageContainer");
message.innerHTML = response.error;
toastBootstrap.show() -->


<!-- TOAST ALERT -->
<div class="toast-container p-3 position-fixed top-0 start-50 translate-middle-x">
  <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
      <strong class="me-auto">ATENCION</strong>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div id="messageContainer" class="toast-body">
    </div>
  </div>
</div>

let categoriaController = {
    dataCategoria: {
        id: "",
        nombre: "",
        usuario_id: ""
    },
    saveCategoria: () => {
        if(true){
            categoriaController.dataCategoria.nombre = document.getElementById("inputNombreCategoria").value;
            categoriaService.saveCategoria(categoriaController.dataCategoria)
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