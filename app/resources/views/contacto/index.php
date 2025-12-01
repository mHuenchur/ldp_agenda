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
        if ($contacto["tipo_id"] == 1) {
          $row .= '<td>'. $contacto["apellido"] . " " . $contacto["nombre"] .'</td>';
        } else {
          $row .= '<td>'. $contacto["razon_social"] .'</td>';
        }
        $row .= '<td>'. $contacto["direccion"] .'</td>';
        $row .= '<td>'. $contacto["email"] .'</td>';
        $row .= '<td>'. '<a id="" class="btn btn-warning mx-1" href="contacto/edit/'. $contacto["id"]. '">Modificar</a><a id="" class="btn btn-danger mx-1" href="">Eliminar</a>' .'</td>';
        $row .= '</tr>';
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