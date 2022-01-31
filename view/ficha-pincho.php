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

    <h1>Panel de administración - Ficha pincho</h1>
    <div class="card">
      <div class="container-fliud">
        <div class="wrapper row">
          <div class="preview col-md-6">

            <div class="preview-pic tab-content">
              <div class="tab-pane active" id="pic-1"><img src="../../<?php echo $fotos[0]; ?>" /></div>
            </div>
            <ul class="preview-thumbnail nav nav-tabs">
              <?php

              for ($i = 0; $i < count($fotos); $i++) {
                echo "<li onclick='modalFotoPincho(this)' id='$ids[$i]'><a data-target='#pic-" . ($i + 1) . "' data-toggle='tab'><img class='imgPequena' src='../../$fotos[$i]' /></a></li>";
              }

              ?>

            </ul>
          </div>
          <div class="details col-md-6">
            <h3 class="product-title"><?php echo $pincho->getNombre(); ?></h3>
            <form method="POST" enctype="multipart/form-data" action="<?php echo $rutaModificar ?>">
              <input type="hidden" name="cod_pincho" value="<?php echo $pincho->getCod_pincho(); ?>" />
              <div>
                <span class="review-no">Nombre</span>
                <i class="fa fa-pencil mr-3 fa-fw"></i>
                <input class="form-control" type="text" name="nombre" placeholder="Nombre pincho" value="<?php echo $pincho->getNombre(); ?>">
              </div><br>
              <div>
                <span class="review-no">Descripcion</span>
                <i class="fa fa-pencil mr-3 fa-fw"></i>
                <input class="form-control" type="text" name="descripcion" placeholder="Descripcion pincho" value="<?php echo $pincho->getDescripcion(); ?>">
              </div><br>
              <div>
                <span class="review-no">Precio</span>
                <i class="fa fa-pencil mr-3 fa-fw"></i>
                <input class="form-control" type="text" name="precio" placeholder="Precio pincho" value="<?php echo $pincho->getPrecio(); ?>">
              </div><br>
              <div>
                <span class="review-no">Bar</span>
                <i class="fa fa-pencil mr-3 fa-fw"></i>
                <!--<input class="form-control" type="text" name="bar" placeholder="Bar del pincho" value="<?php echo $pincho->getBar(); ?>">-->
                <select name="bar">
                  <?php
                    for ($i=0; $i < count($bares); $i++) { 
                      if($bares[$i]->getCod_bar() == $pincho->getBar()){
                        echo "<option value='".$bares[$i]->getCod_bar()."' selected>".$bares[$i]->getCod_bar()." - ".$bares[$i]->getNombre()."</option>";
                      }else{
                        echo "<option value='".$bares[$i]->getCod_bar()."'>".$bares[$i]->getCod_bar()." - ".$bares[$i]->getNombre()."</option>";
                      }
                      
                    }
                  ?>
                </select>
              </div><br>
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
            <!--<p class="product-description">Suspendisse quos? Tempus cras iure temporibus? Eu laudantium cubilia sem sem! Repudiandae et! Massa senectus enim minim sociosqu delectus posuere.</p>
                    -->


          </div>
        </div>
      </div>

    </div>
  </div>
  <?php
  include "footer.php";
  ?>
  <script src="../../js/jquery-3.6.0.min.js"></script>
  <script src="../../js/script.js"></script>
</body>

</html>