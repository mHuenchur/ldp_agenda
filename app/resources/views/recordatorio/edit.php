<form method="" class="container py-3">

  <h2 class="h5 mb-3">Editar recordatorio</h2>

  <input id="id" type="hidden" name="id" value="<?php echo $recordatorio["id"] ?>">

  <div class="mb-3">
    <label for="descripcion" class="form-label">Descripción</label>
    <input
      type="text"
      class="form-control"
      id="descripcion"
      name="descripcion"
      required
      maxlength="120"
      value="<?php echo $recordatorio["nombre"] ?>"
      placeholder="Ej.: Reunión de seguimiento"
    >
  </div>

  <div class="mb-3">
    <label for="fecha_hora" class="form-label">Fecha y hora</label>
    <input
      type="datetime-local"
      class="form-control"
      id="fecha_hora"
      name="fecha_hora"
      required
      value="<?php echo $recordatorio["fecha_hora"] ?>"
    >
  </div>

  <div class="mb-3">
    <label for="lugar" class="form-label">Lugar</label>
    <input
      type="text"
      class="form-control"
      id="lugar"
      name="lugar"
      maxlength="120"
      value="<?php echo $recordatorio["lugar"] ?>"
      placeholder="Ej.: Aula 201 / Oficina / Zoom"
    >
  </div>

  <div class="mb-3">
    <label for="contactos" class="form-label">Contactos involucrados</label>
    <select
      id="contactos"
      name="contactos"
      class="form-select"
      multiple
      size="8"
      required
    >
    <?php
    $html = "";
    foreach ($listadoContactos as $contacto) {
        if (in_array($contacto["id"], $listadoRelacion)) {
            if ($contacto["tipo_id"] == "1") {
                $html .= '<option value="'. $contacto["id"] .'" selected>'. $contacto["apellido"]. " ". $contacto["nombre"] .'</option>';
            } else {
                 $html .= '<option value="'. $contacto["id"] .'" selected>'. $contacto["razon_social"] .'</option>';
            }
        } else {
            if ($contacto["tipo_id"] == "1") {
                $html .= '<option value="'. $contacto["id"] .'">'. $contacto["apellido"]. " ". $contacto["nombre"] .'</option>';
            } else {
                 $html .= '<option value="'. $contacto["id"] .'">'. $contacto["razon_social"] .'</option>';
            }
        }
    }
    echo $html;
    ?>
    </select>
    <div class="form-text">
      Ctrl + clic para seleccionar varios contactos.
    </div>
  </div>

  <div class="d-flex justify-content-end gap-2">
    <button onclick=recordatorioController.updateRecordatorio() type="button" class="btn btn-primary">Guardar cambios</button>
  </div>

</form>


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
