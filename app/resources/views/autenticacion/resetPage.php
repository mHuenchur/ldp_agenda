<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-10 col-md-6 col-lg-4">
        <div class="card shadow-sm">
            <div class="card-header">
            Cambio de clave
            </div>
            <div class="card-body">
            <form id="">
                <div class="mb-3">
                    <input type="hidden" name="key" id="key" value="<?php echo $token ?>">
                    <label for="claveNueva" class="form-label">Clave</label>
                    <input type="password" class="form-control" id="claveNueva" aria-describedby="claveHelpBlock" required>
                    <div id="claveHelpBlock" class="form-text mt-2">
                        Ingresa tu nueva clave.
                    </div>
                </div>
                <div class="d-flex justify-content-between gap-2">
                <button type="button" class="btn btn-primary" onclick="autenticacionController.resetPassword()">Confirmar</button>
                </div>
            </form>
            </div>

        </div>
        </div>
    </div>
</div>

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