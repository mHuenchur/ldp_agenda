<div class="container py-3">
    <h6 class="text-uppercase text-body-secondary mb-2">Contactos</h6>
    <div class="vstack gap-3">
    <!-- Contenedor 1: Operaciones -->
    <section class="card shadow-sm">
      <div class="card-body d-flex flex-wrap justify-content-between align-items-center gap-2">
          <form id="formFiltros" class="d-flex gap-2 align-items-end">
            <div>
              <label for="fCategoria" class="form-label">Categoría</label>
              <select id="fCategoria" name="categoria" class="form-select">
                <option value="">(Todas)</option>
                <?php
                  if (!empty($listadoCategorias)) {
                    $html = "";
                    foreach ($listadoCategorias as $categoria) {
                      $html .= '<option value='.$categoria["id"].'>'. $categoria["nombre"] .'</option>';
                    }
                    echo $html;
                  }
                  ?>
              </select>
            </div>

            <div>
              <label for="fTipo" class="form-label">Tipo</label>
              <select id="fTipo" name="tipo" class="form-select">
                <option value="">(Todos)</option>
                <?php
                  if (!empty($listadoTipos)) {
                    $html = "";
                    foreach ($listadoTipos as $tipo) {
                      $html .= '<option value='.$tipo["id"].'>'. $tipo["nombre"] .'</option>';
                    }
                    echo $html;
                  }
                  ?>
              </select>
            </div>

            <button id="btnAplicar" type="button" class="btn btn-primary" onclick=contactoController.filtrarLista()>Aplicar filtros</button>

            <a id="btnPdf" class="btn btn-outline-secondary" href="contacto/pdf" target="_blank" rel="noopener">
              Exportar PDF
            </a>
            <a id="" class="btn btn-outline-primary" href="contacto/create">
              Nuevo contacto
            </a>
          </form>
      </div>
    </section>


    <div class="table-responsive">
      <table id="myTable" class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nombre Apellido/Razon social</th>
      <th scope="col">Dirección</th>
      <th scope="col">Correo</th>
      <th scope="col">Opciones</th>
    </tr>
  </thead>
  <tbody>
    <?php
    if (!empty($listadoContactos)) {
      $html = "";
      $count = 1;
      foreach ($listadoContactos as $contacto) {
        $row = '<tr>';
        $row .= '<th scope="row">'. $count .'</th>';
        $nombre = "";
        if ($contacto["tipo_id"] == 1) {
          $nombre = $contacto["apellido"] . " " . $contacto["nombre"];
          $row .= '<td>'. $nombre .'</td>';
        } else {
          $nombre = $contacto["razon_social"];
          $row .= '<td>'. $nombre .'</td>';
        }
        $row .= '<td>'. $contacto["direccion"] .'</td>';
        $row .= '<td>'. $contacto["email"] .'</td>';
        $row .= '<td>'. '<a id="" class="btn btn-warning mx-1" href="contacto/edit/'. $contacto["id"]. '">Ver detalles</a><a id="" class="btn btn-danger mx-1" data-bs-toggle="modal" data-bs-target="#'. $contacto["id"]. '">Eliminar</a>' .'</td>';
        $row .= '</tr>';
        $row .= '<div class="modal fade" id="'. $contacto["id"] .'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered ">
                      <div class="modal-content text-danger-emphasis bg-danger-subtle border border-danger-subtle">
                        <div class="modal-header border-danger-subtle">
                          <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar contacto</h1>
                        </div>
                        <div class="modal-body border-danger-subtle">
                          <p>Esta seguro que desea eliminar el contacto '. $nombre.'?</p>
                        </div>
                        <div class="modal-footer border-danger-subtle">
                          <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cancelar</button>
                          <button type="button" class="btn btn-danger" onclick=contactoController.deleteContacto('.$contacto["id"].')>Eliminar</button>
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