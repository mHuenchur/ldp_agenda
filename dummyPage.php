<div class="container auth-wrapper d-flex flex-column justify-content-center">
    <div class="text-center mb-4">
        <h1 class="titulo-app fw-semibold">AGENDA DE CONTACTOS</h1>
        <p class="text-muted small mb-0">
            Iniciá sesión o creá tu cuenta para administrar tus contactos.
        </p>
    </div>

    <div class="row justify-content-center g-4">
        <div class="col-12 col-md-5">
            <div class="card shadow-sm auth-card">
                <div class="card-header text-center">
                    <span class="fw-semibold">Iniciar sesión</span>
                </div>
                <div class="card-body">
                    <form action="" method="">
                        <div class="mb-3">
                            <label for="datoUsuarioLogin" class="form-label">Usuario o email</label>
                            <input
                                type="text"
                                class="form-control"
                                id="datoUsuarioLogin"
                                name="datoUsuarioLogin"
                                required
                            >
                        </div>
                        <div class="mb-3">
                            <label for="datoClaveLogin" class="form-label">Contraseña</label>
                            <input
                                type="password"
                                class="form-control"
                                id="datoClaveLogin"
                                name="datoClaveLogin"
                                required
                            >
                        </div>
                        <div class="mb-3 text-center">
                            <a href="autenticacion/passwordLost" class="small">Olvidé mi contraseña</a>
                        </div>
                        <button id="btnLogin" type="button" class="btn btn-primary w-100">
                            Iniciar sesión
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-5">
            <div class="card shadow-sm auth-card">
                <div class="card-header text-center">
                    <span class="fw-semibold">Registrarse</span>
                </div>
                <div class="card-body">
                    <form id="formularioAltaUsuario" action="" method="">
                        <div class="mb-3">
                            <label for="datoNombres" class="form-label">Nombres</label>
                            <input
                                type="text"
                                class="form-control"
                                id="datoNombres"
                                name="datoNombres"
                                required
                            >
                        </div>
                        <div class="mb-3">
                            <label for="datoApellido" class="form-label">Apellido</label>
                            <input
                                type="text"
                                class="form-control"
                                id="datoApellido"
                                name="datoApellido"
                                required
                            >
                        </div>
                        <div class="mb-3">
                            <label for="datoEmail" class="form-label">Email</label>
                            <input
                                type="email"
                                class="form-control"
                                id="datoEmail"
                                name="datoEmail"
                                required
                            >
                        </div>
                        <div class="mb-3">
                            <label for="datoUsuario" class="form-label">Nombre de usuario</label>
                            <input
                                type="text"
                                class="form-control"
                                id="datoUsuario"
                                name="datoUsuario"
                                required
                            >
                        </div>
                        <div class="mb-3">
                            <label for="datoClave" class="form-label">Contraseña</label>
                            <input
                                type="password"
                                class="form-control"
                                id="datoClave"
                                name="datoClave"
                                required
                            >
                        </div>
                        <button id="btnRegister" type="button" class="btn btn-success w-100">
                            Registrarme
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>