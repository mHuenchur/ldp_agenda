
<div class="container py-4">

    <h1 class="h4 mb-3">Editar categoría</h1>

    <form method="" class="border rounded p-3 bg-light">

        <input type="hidden" id="categoriaId" value="<?php echo $categoria["id"] ?>">

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre de la categoría</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required maxlength="45"
                value="<?php echo $categoria["nombre"] ?>"
                placeholder="Ej.: Trabajo, Familia, Amigos">
        </div>

        <div class="d-flex justify-content-end gap-2">
            <button type="button" class="btn btn-primary" onclick=categoriaController.updateCategoria()>Guardar cambios</button>
        </div>
    </form>
</div>

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