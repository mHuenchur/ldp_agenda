<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-10 col-md-6 col-lg-4">
        <div class="card shadow-sm">
            <div class="card-header">
            Recuperación de clave
            </div>
            <div class="card-body">
            <form id="">
                <div class="mb-3">
                <label for="datoCorreo" class="form-label">Correo</label>
                <input
                    type="email"
                    class="form-control"
                    id="datoCorreo"
                    placeholder="name@example.com">
                <div class="form-text">
                    Ingresa tu dirección de correo del sitio para cambiar tu contraseña.
                </div>
                </div>

                <div class="d-flex justify-content-between gap-2">
                <a href="autenticacion/index" class="btn btn-outline-secondary w-50">Volver</a>
                <button type="button" onclick="autenticacionController.passwordReset()" class="btn btn-primary w-50">Confirmar</button>
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