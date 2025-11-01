
<div class="card w-25 mb-3 mx-auto mt-5">
    <div class="card-header">
        Cambio de clave
    </div>
    <div class="card-body">
        <div class="">
            <input type="hidden" name="key" id="key" value="<?php echo $token ?>">
            <label for="claveNueva" class="form-label">Clave</label>
            <input type="password" class="form-control" id="claveNueva" aria-describedby="claveHelpBlock" required>
            <div id="claveHelpBlock" class="form-text mt-2">
                Ingresa tu nueva clave.
            </div>
        </div>
    </div>
    <div class="card-footer text-body-secondary">
        <div>
            <button type="button" class="btn btn-primary" onclick="autenticacionController.resetPassword()">Confirmar</button>
        </div>
    </div>
</div>