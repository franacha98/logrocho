<html>

<head>
  <title>Logrocho - Administración</title>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../../estilos/bootstrap/css/bootstrap.min.css" />
  <link rel="stylesheet" href="../../estilos/css/estilos-administracion.css" />
  <link rel="stylesheet" href="../../estilos/font-awesome-4.7.0/font-awesome-4.7.0/css/font-awesome.min.css" />
</head>

<body>

  <?php
  include "menu-admin2.php";
  ?>

  <div class="page-content p-5" id="content">
    <!-- Toggle button -->
    <button id="sidebarCollapse" type="button" class="btn btn-light bg-white rounded-pill shadow-sm px-4 mb-4"><i class="fa fa-bars mr-2"></i></button>

    <h1>Panel de administración - Ficha bar</h1>
    <div class="card">
      <div class="container-fliud">
        <div class="wrapper row">
          <div class="preview col-md-6">

            <div class="preview-pic tab-content">
              <div class="tab-pane active" id="pic-1"><img src="../../<?php echo $fotos[0]; ?>" /></div>
            </div>
            <ul class="preview-thumbnail nav nav-tabs">
              <?php
                
                for($i = 0; $i < count($fotos); $i++){
                  echo "<li onclick='modalFotoBar(this)' id='$ids[$i]'><a data-target='#pic-".($i+1)."' data-toggle='tab'><img class='imgPequena' src='../../$fotos[$i]' /></a></li>";
                }
                
              ?>
            </ul>
          </div>
          <div class="details col-md-6">
            <h3 class="product-title"><?php echo $bar->getNombre(); ?></h3>
            <form method="POST" enctype="multipart/form-data" action="<?php echo $rutaModificar ?>">
              <div>
                <span class="review-no">Nombre</span>
                <i class="fa fa-pencil mr-3 fa-fw"></i>
                <input class="form-control" type="text" name="nombre" placeholder="Nombre bar" value="<?php echo $bar->getNombre(); ?>">
              </div><br>
              <div>
                <span class="review-no">Localización</span>
                <i class="fa fa-pencil mr-3 fa-fw"></i>
                <div class="form-row align-items-center">
                  <div class="col-auto">
                    <div class="input-group mb-2">
                      <div class="input-group-prepend">
                        <div class="input-group-text">LAT</div>
                      </div>
                      <input type="text" class="form-control" name="latitud" id="inlineFormInputGroup" placeholder="Latitud" value="<?php echo $bar->getLatitud(); ?>">
                    </div>
                  </div>
                  <div class="col-auto">

                    <div class="input-group mb-2">
                      <div class="input-group-prepend">
                        <div class="input-group-text">LON</div>
                      </div>
                      <input type="text" class="form-control" name="longitud" id="inlineFormInputGroup" placeholder="Longitud" value="<?php echo $bar->getLongitud(); ?>">
                      <input type="hidden" name="cod_bar" value="<?php echo $bar->getCod_Bar(); ?>" />
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="file">Seleccione imágenes: </label>
                  <input type="file" class="form-control-file" id="file" name="file[]" multiple>
                </div>
                <br>
                <div class="action">
                  <button class="btn btn-dark" type="submit" type="button">Guardar</button>
                  <a class="btn btn-danger" type="button" href="<?php echo $rutaEliminar; ?>">Eliminar</a>
                </div>

            </form><br>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  <?php
  include "footer.php";
  ?>
  <script src="../../js/jquery-3.6.0.min.js"></script>
  <script src="../../estilos/bootstrap/js/bootstrap.min.js"></script>
  <script src="../../js/script.js"></script>

</body>

</html>