<!-- Perfil de Usuario -->
<div class="container py-4">
  <h1 class="h4 mb-4">Perfil de usuario</h1>
  <div class="row g-4">
    <!-- Form: Datos de perfil -->
    <div class="col-12 col-lg-6">
      <div class="card shadow-sm">
        <div class="card-header">
          <strong>Datos de perfil</strong>
        </div>
        <div class="card-body">
          <form action="">

            <div class="row g-3">
              <div class="col-md-6">
                <label for="usuarioNombre" class="form-label">Nombre</label>
                <input id="usuarioNombre" name="usuarioNombre" type="text" class="form-control" required minlength="2" maxlength="45" autocomplete="given-name" value="<?php echo $usuario["nombre"] ?>">
                <div class="invalid-feedback">Ingresá un nombre válido (mín. 2).</div>
              </div>

              <div class="col-md-6">
                <label for="usuarioApellido" class="form-label">Apellido</label>
                <input id="usuarioApellido" name="usuarioApellido" type="text" class="form-control" required minlength="2" maxlength="45" autocomplete="family-name" value="<?php echo $usuario["apellido"] ?>">
                <div class="invalid-feedback">Ingresá un apellido válido (mín. 2).</div>
              </div>

              <div class="col-md-6">
                <label for="usuarioUsername" class="form-label">Nombre de usuario</label>
                <input id="usuarioUsername" name="usuarioUsername" type="text" class="form-control" required minlength="3" maxlength="30" autocomplete="username" value="<?php echo $usuario["nombre_usuario"] ?>">
                <div class="invalid-feedback">Elegí un usuario (mín. 3).</div>
              </div>

              <div class="col-md-6">
                <label for="usuarioEmail" class="form-label">Email</label>
                <input id="usuarioEmail" name="usuarioEmail" type="email" class="form-control" required maxlength="120" autocomplete="email" value="<?php echo $usuario["email"] ?>">
                <div class="invalid-feedback">Ingresá un email válido.</div>
              </div>

              <div class="col-md-6">
                <label for="usuarioTiempo" class="form-label">Tiempo de notificaciones (Dias)</label>
                <input id="usuarioTiempo" name="usuarioTiempo" type="text" class="form-control" required minlength="2" maxlength="45" autocomplete="given-name" value="<?php echo $usuario["tiempo_notificacion"] ?>">
                <div class="form-text">Modifica la anticipacion de los recordatorios.</div>
                <div class="invalid-feedback">Ingresá un valor válido (mín. 2).</div>
              </div>
              
            </div>

            <div class="d-flex justify-content-end mt-4">
              <button type="button" class="btn btn-primary" onclick=usuarioController.updateUsuario()>Guardar cambios</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Form: Cambiar contraseña -->
    <div class="col-12 col-lg-6">
      <div class="card shadow-sm">
        <div class="card-header">
          <strong>Cambiar contraseña</strong>
        </div>
        <div class="card-body">
          <form action="" method="">
            <div class="mb-3">
              <label for="passActual" class="form-label">Contraseña actual</label>
              <input id="passActual" name="passActual" type="password" class="form-control" required autocomplete="current-password">
              <div class="invalid-feedback">Ingresá tu contraseña actual.</div>
            </div>

            <div class="mb-3">
              <label for="passNueva" class="form-label">Nueva contraseña</label>
              <input id="passNueva" name="passNueva" type="password" class="form-control" required minlength="8" autocomplete="new-password">
              <div class="invalid-feedback">Ingresá una contraseña válida.</div>
            </div>

            <div class="mb-3">
              <label for="passConfirmar" class="form-label">Confirmar nueva contraseña</label>
              <input id="passConfirmar" name="passConfirmar" type="password" class="form-control" required minlength="8" autocomplete="new-password">
              <div class="invalid-feedback">La confirmación no coincide.</div>
            </div>

            <div class="d-flex justify-content-end">
              <button type="button" class="btn btn-danger" onclick=usuarioController.updateClave()>Actualizar contraseña</button>
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