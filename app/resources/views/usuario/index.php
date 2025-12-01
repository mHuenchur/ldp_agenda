<div class="container py-3">
  <h6 class="text-uppercase text-body-secondary mb-2">Inicio</h6>
  <div class="row g-4">
    <!-- 75% -->
    <section class="col-12 col-md-9">
      <div class="d-flex flex-column gap-4">
        <!-- Subcontenedor superior (grilla) -->
        <div class="p-3 border rounded-3">
          <h6 class="mb-3">Proximos eventos/recordarios</h6>
          <div class="row row-cols-2 row-cols-lg-3 g-3">
            <?php
              if (!empty($listadoRecordatorios)) {
                $html = "";
                foreach ($listadoRecordatorios as $recordatorio) {
                  $row = '<div class="col">
                            <div class="card h-100">
                              <div class="card-body">
                                <h5 class="card-title mb-2">'. $recordatorio["nombre"] .'</h5>

                                <p class="card-text mb-1">
                                  <strong>Fecha y hora:</strong> '. date('d/m/Y H:i', strtotime($recordatorio["fecha_hora"])) .'
                                </p>

                                <p class="card-text mb-0">
                                  <strong>Lugar:</strong> '. $recordatorio["lugar"] .'
                                </p>
                              </div>
                            </div>
                          </div>';
                  $html .= $row;
                }
              }else {
                $html = '<div class="col-12">
                          <div class="card h-100">
                            <div class="card-body text-center">
                              <h5 class="card-title mb-2">Sin recordatorios</h5>
                              <p class="card-text mb-0">
                                No tenés recordatorios cargados por el momento.
                              </p>
                            </div>
                          </div>
                        </div>';
              }
              echo $html;
            ?>

          </div>
        </div>
      </div>
    </section>

    <aside class="col-12 col-md-3">
      <div class="d-flex flex-column gap-4">

        <div class="p-3 border rounded-3">
          <h6 class="mb-3">Cumpleaños para hoy</h6>
          <div class="d-flex flex-column gap-3">
            <?php
            if (!empty($cumpleañosHoy)) {
              $div = "";
              foreach ($cumpleañosHoy as $cumpleaños) {
                $div .= '<div class="p-3 border rounded bg-light mb-2">
                          <div class="fw-bold">'. $cumpleaños["nombre"] .' '. $cumpleaños["apellido"] .'</div>
                          <div class="text-muted">Cumpleaños: '. $cumpleaños["fecha_nacimiento"] .'</div>
                        </div>';
              }
              echo $div;
            }else {
              echo "<div class='p-3 border rounded bg-light text-center'><div class='fw-bold'>Sin cumpleaños hoy</div></div>";
            }
            ?>
          </div>
        </div>

        <div class="p-3 border rounded-3">
          <h6 class="mb-3">Proximos Cumpleaños</h6>
          <div class="d-flex flex-column gap-3">
            <?php
              if (!empty($cumpleañosSiguientes)) {
                $div = "";
                foreach ($cumpleañosSiguientes as $cumpleaños) {
                  $div .= '<div class="p-3 border rounded bg-light mb-2">
                          <div class="fw-bold">'. $cumpleaños["nombre"] .' '. $cumpleaños["apellido"] .'</div>
                          <div class="text-muted">Cumpleaños: '. $cumpleaños["proximo_cumple"] .'</div>
                        </div>';
                }
                echo $div;
              }else {
                echo "<div class='p-3 border rounded bg-light text-center'><div class='fw-bold'>Sin cumpleaños</div></div>";
              }
            ?>
          </div>
        </div>
      </div>
    </aside>
  </div>
</div>