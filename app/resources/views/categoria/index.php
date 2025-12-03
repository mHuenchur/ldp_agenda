<div class="container py-3">
    <h6 class="text-uppercase text-body-secondary mb-2">Categorias</h6>
    <div class="vstack gap-3">
    <!-- Contenedor 1: Operaciones -->
    <section class="card shadow-sm">
      <div class="card-body d-flex flex-wrap justify-content-between align-items-center gap-2">
        <h5 class="mb-0">Operaciones</h5>
        <div class="d-flex gap-2">
          <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#categoriaModal">Nueva categoria</button>
          <a id="" class="btn btn-outline-secondary btn-sm" href="categoria/pdf" target="_blank" rel="noopener">Exportar PDF</a>
        </div>
      </div>
    </section>

    <!-- Listado -->
    <table id="TableCategoria" class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nombre</th>
          <th scope="col">Opciones</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if (!empty($listadoCategorias)) {
          $html = "";
          $count = 1;
          foreach ($listadoCategorias as $categoria) {
            $row = '<tr>';
            $row .= '<th scope="row">'. $count .'</th>';
            $row .= '<td>'. $categoria["nombre"] .'</td>';
            $row .= '<td>'. '<a id="" class="btn btn-warning mx-1" href="categoria/edit/'. $categoria["id"].'">Ver detalles</a><a id="" class="btn btn-danger mx-1" data-bs-toggle="modal" data-bs-target="#'. $categoria["id"]. '">Eliminar</a>' .'</td>';
            $row .= '</tr>';
            $row .= '<div class="modal fade" id="'. $categoria["id"] .'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered ">
                      <div class="modal-content text-danger-emphasis bg-danger-subtle border border-danger-subtle">
                        <div class="modal-header border-danger-subtle">
                          <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar categoria</h1>
                        </div>
                        <div class="modal-body border-danger-subtle">
                          <p>Esta seguro que desea eliminar la categoria '. $categoria["nombre"].'?</p>
                        </div>
                        <div class="modal-footer border-danger-subtle">
                          <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cancelar</button>
                          <button type="button" class="btn btn-danger" onclick=categoriaController.deleteCategoria('.$categoria["id"].')>Eliminar</button>
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


<!-- Modal -->
<div class="modal fade" id="categoriaModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="modalLabel">Nueva categoria</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formNuevaCategoria" action="">
            <div class="mb-3">
              <label for="inputNombreCategoria" class="form-label">Nombre</label>
              <input type="text" class="form-control" id="inputNombreCategoria" required minlength="3" maxlength="45">

            </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button id="btnNuevaCategoria" type="button" class="btn btn-primary">Guardar</button>
          </div>
        </form>

      </div>
  </div>
</div>
