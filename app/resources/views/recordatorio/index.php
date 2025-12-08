<div class="container py-3">
    <h6 class="text-uppercase text-body-secondary mb-2">Recordatorios</h6>
    <div class="vstack gap-3">
    <!-- Contenedor 1: Operaciones -->
    <section class="card shadow-sm">
      <div class="card-body d-flex flex-wrap justify-content-between align-items-center gap-2">
        <h5 class="mb-0">Operaciones</h5>
        <div class="d-flex gap-2">
          <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#recordatorioModal">Nuevo recordatorio</button>
          <a id="btnPdf" class="btn btn-outline-secondary" href="recordatorio/pdf" target="_blank" rel="noopener">
            Exportar PDF
          </a>
        </div>
      </div>
    </section>

    <div class="table-responsive">
      <!-- Listado vigentes-->
       <h2 class="h5 text-center mt-3 text-muted">Recordatorios vigentes</h2>
      <table id="TableRecordatorioVigente" class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Descripción</th>
            <th scope="col">Fecha y Hora</th>
            <th scope="col">Lugar</th>
            <th scope="col">Opciones</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if (!empty($listadoVigentes)) {
            $html = "";
            $count = 1;
            foreach ($listadoVigentes as $recordatorio) {
              $row = '<tr>';
              $row .= '<th scope="row">'. $count .'</th>';
              $row .= '<td>'. $recordatorio["nombre"] .'</td>';
              $row .= '<td>'. date('d/m/Y H:i', strtotime($recordatorio["fecha_hora"])) .'</td>';
              $row .= '<td>'. $recordatorio["lugar"] .'</td>';
              $row .= '<td>'. '<a id="" class="btn btn-warning mx-1" href="recordatorio/edit/'. $recordatorio["id"] .'">Ver detalles</a>
              <a id="" class="btn btn-danger mx-1" data-bs-toggle="modal" data-bs-target="#'. $recordatorio["id"]. '">Eliminar</a>' .'</td>';
              $row .= '</tr>';
              $row .= '<div class="modal fade" id="'. $recordatorio["id"] .'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered ">
                        <div class="modal-content text-danger-emphasis bg-danger-subtle border border-danger-subtle">
                          <div class="modal-header border-danger-subtle">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar recordatorio</h1>
                          </div>
                          <div class="modal-body border-danger-subtle">
                            <p>Esta seguro que desea eliminar el recordatorio: '. $recordatorio["nombre"].'?</p>
                          </div>
                          <div class="modal-footer border-danger-subtle">
                            <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-danger" onclick=recordatorioController.deleteRecordatorio('.$recordatorio["id"].')>Eliminar</button>
                          </div>
                        </div>
                      </div>
                    </div>';
              $html .= $row;
              $count++;
            }
            echo $html;
          }
          ?>
        </tbody>
      </table>
    </div>

    <div class="table-responsive">
      <!-- Listado vencidos-->
       <h2 class="h5 text-center text-muted">Recordatorios vencidos</h2>
      <table id="TableRecordatorioVencido" class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Descripción</th>
            <th scope="col">Fecha y Hora</th>
            <th scope="col">Lugar</th>
            <th scope="col">Opciones</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if (!empty($listadoVencidos)) {
            $html = "";
            $count = 1;
            foreach ($listadoVencidos as $recordatorio) {
              $row = '<tr>';
              $row .= '<th scope="row">'. $count .'</th>';
              $row .= '<td>'. $recordatorio["nombre"] .'</td>';
              $row .= '<td>'. date('d/m/Y H:i', strtotime($recordatorio["fecha_hora"])) .'</td>';
              $row .= '<td>'. $recordatorio["lugar"] .'</td>';
              $row .= '<td>'. '<a id="" class="btn btn-warning mx-1" href="recordatorio/edit/'. $recordatorio["id"] .'">Ver detalles</a>
              <a id="" class="btn btn-danger mx-1" data-bs-toggle="modal" data-bs-target="#'. $recordatorio["id"]. '">Eliminar</a>' .'</td>';
              $row .= '</tr>';
              $row .= '<div class="modal fade" id="'. $recordatorio["id"] .'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered ">
                        <div class="modal-content text-danger-emphasis bg-danger-subtle border border-danger-subtle">
                          <div class="modal-header border-danger-subtle">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar recordatorio</h1>
                          </div>
                          <div class="modal-body border-danger-subtle">
                            <p>Esta seguro que desea eliminar el recordatorio: '. $recordatorio["nombre"].'?</p>
                          </div>
                          <div class="modal-footer border-danger-subtle">
                            <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-danger" onclick=recordatorioController.deleteRecordatorio('.$recordatorio["id"].')>Eliminar</button>
                          </div>
                        </div>
                      </div>
                    </div>';
              $html .= $row;
              $count++;
            }
            echo $html;
          }
          ?>
        </tbody>
      </table>
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

<!-- Modal -->
<div class="modal fade" id="recordatorioModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="modalLabel">Nuevo recordatorio</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formNuevoRecordatorio" action="">
            <div class="mb-3">
              <label for="inputDescripcion" class="form-label">Descripcion</label>
              <input type="text" class="form-control" id="inputDescripcion" required minlength="3" maxlength="45">
            </div>
            <div class="mb-3">
              <label for="inputFechaHora" class="form-label">Fecha y Hora</label>
              <input type="datetime-local" class="form-control" id="inputFechaHora" required minlength="3" maxlength="45">

            </div>
            <div class="mb-3">
              <label for="inputLugar" class="form-label">Lugar</label>
              <input type="text" class="form-control" id="inputLugar" required minlength="3" maxlength="45">

            </div>
            <div class="mb-3">
              <label for="contactoId" class="form-label">Contactos involucrados</label>
              <select id="contactoId" name="contactoId" class="form-select" multiple size="7" required>
                <?php
                    if (!empty($listadoContactos)) {
                      $html = "";
                      foreach ($listadoContactos as $contacto) {
                        $html .= '<option value='.$contacto["id"].'>';
                        if ($contacto["tipo_id"] == "1") {
                          $html .= $contacto["nombre"] . ' ' . $contacto["apellido"];
                        } else {
                          $html .= $contacto["razon_social"];
                        }
                        $html .= '</option>';
                      }
                      echo $html;
                    }
                ?>
              </select>
              <div class="form-text">Usá Ctrl + clic para seleccionar multiples contactos.</div>
            </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button id="btnNuevoRecordatorio" type="button" class="btn btn-primary" onclick=recordatorioController.saveRecordatorio()>Guardar</button>
          </div>
        </form>

      </div>
  </div>
</div>