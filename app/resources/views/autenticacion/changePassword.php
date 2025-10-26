<div class="card w-25 mb-3 mx-auto mt-5">
    <div class="card-header">
        Recuperación de clave
    </div>
    <div class="card-body">
        <div class="">
            <label for="datoCorreo" class="form-label">Correo</label>
            <input type="email" class="form-control" id="datoCorreo" placeholder="name@example.com" aria-describedby="emailHelpBlock" required>
            <div id="emailHelpBlock" class="form-text mt-2">
                Ingresa tu dirección de correo del sitio para cambiar tu contraseña.
            </div>
        </div>
    </div>
    <div class="card-footer text-body-secondary">
        <div>
            <button type="submit" class="btn btn-primary" onclick="autenticacionController.passwordReset()">Confirmar</button>
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