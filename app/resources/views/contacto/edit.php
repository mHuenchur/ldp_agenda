<form id="formContacto" class="container py-3" novalidate>
  <h2 class="h5 mb-3">Modificar contacto</h2>

  <!-- Tipo -->
  <div class="row g-3">
    <div class="col-md-4">
      <label for="tipo" class="form-label">Tipo</label>
      <select id="tipo" name="tipo" class="form-select" required>
        <?php
            if (!empty($listadoTipos)) {
              $html = "";
              foreach ($listadoTipos as $tipo) {
                if ($contacto["tipo_id"] == $tipo["id"]) {
                  $html .= '<option selected value='.$tipo["id"].'>'. $tipo["nombre"] .'</option>';
                } else {
                  $html .= '<option value='.$tipo["id"].'>'. $tipo["nombre"] .'</option>';
                }
              }
              echo $html;
            }
        ?>
      </select>
    </div>
  </div>

  <!-- Datos PERSONA -->
  <div id="camposPersona" class="row g-3 mt-0">
    <div class="col-md-6">
      <label for="apellido" class="form-label">Apellido</label>
      <input id="apellido" name="apellido" type="text" class="form-control" value="<?php echo $contacto["apellido"] ?>" minlength="2" maxlength="45" required>
    </div>
    <div class="col-md-6">
      <label for="nombre" class="form-label">Nombre</label>
      <input id="nombre" name="nombre" type="text" class="form-control" value="<?php echo $contacto["nombre"] ?>" minlength="2" maxlength="45" required>
    </div>
    <div class="col-md-4">
      <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento</label>
      <?php
      
       ?>
      <input id="fecha_nacimiento" name="fecha_nacimiento" type="date" value="<?php
      $fecha = "";
      if ($contacto["tipo_id"] == "1") {
        $fecha = $contacto["fecha_nacimiento"];
      }
      echo $fecha;
      ?>" class="form-control">
    </div>
  </div>

  <!-- Datos ORGANIZACIÓN -->
  <div id="camposOrg" class="row g-3 mt-0 d-none">
    <div class="col-md-8">
      <label for="razon_social" class="form-label">Razón social</label>
      <input id="razon_social" name="razon_social" type="text" class="form-control" value="<?php echo $contacto["razon_social"] ?>" minlength="2" maxlength="120">
    </div>
  </div>

  <!-- Comunes -->
  <div class="row g-3 mt-0">
    <input type="hidden" name="key" id="key" value="<?php echo $contacto["id"] ?>">
    <div class="col-md-8">
      <label for="direccion" class="form-label">Dirección</label>
      <input id="direccion" name="direccion" type="text" value="<?php echo $contacto["direccion"] ?>" class="form-control" maxlength="120">
    </div>
    <div class="col-md-4">
      <label for="email" class="form-label">Correo</label>
      <input id="email" name="email" type="email" value="<?php echo $contacto["email"] ?>" class="form-control" maxlength="120">
    </div>
    <div class="col-md-6">
      <label for="sitio_web" class="form-label">Sitio web</label>
      <input id="sitio_web" name="sitio_web" type="url" value="<?php echo $contacto["sitio_web"] ?>" class="form-control" placeholder="https://..." maxlength="200">
    </div>
    <div class="col-md-6">
      <label for="categoria" class="form-label">Categoría</label>
      <select id="categoria" name="categoria" class="form-select">
        <option value="">(Sin categoría)</option>
        <?php
            if (!empty($listadoCategorias)) {
              $html = "";
              foreach ($listadoCategorias as $categoria) {
                if ($contacto["categoria_id"] == $categoria["id"]) {
                  $html .= '<option selected value='.$categoria["id"].'>'. $categoria["nombre"] .'</option>';
                } else {
                  $html .= '<option value='.$categoria["id"].'>'. $categoria["nombre"] .'</option>';
                }
                
              }
              echo $html;
            }
        ?>
      </select>
    </div>
    <div class="col-12">
      <label for="observaciones" class="form-label">Observaciones</label>
      <textarea id="observaciones" name="observaciones" class="form-control" rows="3" maxlength="500"><?php echo $contacto["observaciones"] ?></textarea>
    </div>
  </div>

  <!-- Teléfonos -->
  <div class="card shadow-sm mt-3">
    <div class="card-header d-flex justify-content-between align-items-center">
      <strong>Teléfonos</strong>
      <button type="button" id="btnAdd" class="btn btn-sm btn-outline-primary">+ Agregar</button>
    </div>
    <div class="card-body">
      <div id="telList" class="vstack gap-2">
        <?php
          $div = "";
          if (!empty($listadoTelefonos)) {
            foreach ($listadoTelefonos as $telefono) {
              $div .= '<div class="fila row g-2">
                          <div class="col-md-4">
                            <input name="etiqueta" class="form-control" value="'. $telefono["etiqueta"] .'" placeholder="móvil / trabajo / emergencia" maxlength="30">
                          </div>
                          <div class="col-md-6">
                            <input name="numero" class="form-control" value="'. $telefono["numero"] .'" placeholder="+54..." maxlength="25">
                          </div>
                          <div class="col-md-2 d-grid">
                            <button type="button" class="btn btn-outline-danger btn-del">Eliminar</button>
                          </div>
                        </div>';
            }
          }else {
            $div .= '<div class="fila row g-2">
                        <div class="col-md-4">
                          <input name="etiqueta" class="form-control" placeholder="móvil / trabajo / emergencia" maxlength="30">
                        </div>
                        <div class="col-md-6">
                          <input name="numero" class="form-control" placeholder="+54..." maxlength="25">
                        </div>
                        <div class="col-md-2 d-grid">
                          <button type="button" class="btn btn-outline-danger btn-del">Eliminar</button>
                        </div>
                      </div>';
          }
          echo $div;
        ?>
      </div>
      <div class="form-text">Podés dejar sin teléfonos o agregar varios. Si agregás una fila, completá etiqueta y número.</div>
    </div>
  </div>

  <div class="d-flex justify-content-end mt-3">
    <a id="btnPdf" class="btn btn-outline-secondary mx-3" href="contacto/contactoPDF/<?php echo $contacto["id"] ?>" target="_blank" rel="noopener">
      Exportar a PDF
    </a>
    <button type="button" onclick=contactoController.updateContacto() class="btn btn-primary">Guardar</button>
  </div>
</form>