<div class="container-fluid text-center py-4">
    <h1>AGENDA DE CONTACTOS</h1>

    <div class="row">
  <div class="col-sm-6 mb-3 mb-sm-0">
    <div class="card">
        <div class="card-header">
            Iniciar sesion
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label for="datoUsuarioLogin" class="form-label">Usuario</label>
                <input type="text" class="form-control" id="datoUsuarioLogin">
            </div>
            <div class="mb-3">
                <label for="datoClaveLogin" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="datoClaveLogin">
            </div>
            <div class="mb-3">
                <a href="autenticacion/passwordLost">Olvidé mi contraseña</a>
            </div>
            <div class="mb-3">
                <button id="btnLogin" type="button" class="btn btn-primary">Iniciar sesión</button>
            </div>
        </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="card">
        <form id="formularioAltaUsuario" class="my-4" action="" method="post">
            <div class="card-header">
                Registrarse
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="datoNombres" class="form-label">Nombres</label>
                    <input type="text" class="form-control" id="datoNombres">
                </div>
                <div class="mb-3">
                    <label for="datoApellido" class="form-label">Apellido</label>
                    <input type="text" class="form-control" id="datoApellido">
                </div>
                <div class="mb-3">
                    <label for="datoEmail" class="form-label">Email</label>
                    <input type="text" class="form-control" id="datoEmail">
                </div>
                <div class="mb-3">
                    <label for="datoUsuario" class="form-label">Nombre de suario</label>
                    <input type="text" class="form-control" id="datoUsuario">
                </div>
                <div class="mb-3">
                    <label for="datoClave" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="datoClave">
                </div>
                <div class="mb-3">
                    <button id="btnRegister" type="button" class="btn btn-primary">Registrarme</button>
                </div>
            </div>
        </form>
    </div>
  </div>
</div>
    

    
</div>