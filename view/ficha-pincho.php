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
            <!--<form method="POST" enctype="multipart/form-data" action="<?php echo $rutaModificar ?>">-->
            <form method="POST" enctype="multipart/form-data" onsubmit="modificarPincho()">
              <input type="hidden" name="cod_pincho" id="cod_pincho" value="<?php echo $pincho->getCod_pincho(); ?>" />
              <div>
                <span class="review-no">Nombre</span>
                <i class="fa fa-pencil mr-3 fa-fw"></i>
                <input required onblur="comprobarNombre()" class="form-control" type="text" id="nombre" name="nombre" placeholder="Nombre pincho" value="<?php echo $pincho->getNombre(); ?>">
                <span id="errorNombre" style="display:none; color: red;">Error</span>
              </div><br>
              <div>
                <span class="review-no">Descripcion</span>
                <i class="fa fa-pencil mr-3 fa-fw"></i>
                <input required onblur="comprobarDesc()" class="form-control" type="text" id="descripcion" name="descripcion" placeholder="Descripcion pincho" value="<?php echo $pincho->getDescripcion(); ?>">
                <span id="errorDesc" style="display:none; color: red;">Error</span>
              </div><br>
              <div>
                <span class="review-no">Precio</span>
                <i class="fa fa-pencil mr-3 fa-fw"></i>
                <input required onblur="comprobarPrecio()" class="form-control" type="text" id="precio" name="precio" placeholder="Precio pincho" value="<?php echo $pincho->getPrecio(); ?>">
                <span id="errorPrecio" style="display:none; color: red;">Error</span>
              </div><br>
              <div>
                <span class="review-no">Bar</span>
                <i class="fa fa-pencil mr-3 fa-fw"></i>
                <!--<input class="form-control" type="text" name="bar" placeholder="Bar del pincho" value="<?php echo $pincho->getBar(); ?>">-->
                <select name="bar" id="bar">
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
                  <input type="hidden" id="rutaAnadir" value="<?php echo $rutaModificar; ?>" >
                </div>
                <br>
              <div class="action">
                <button id="btAnadir" class="btn btn-dark" type="submit" type="button">Guardar</button>
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
  <script>
            let flagNombre = false;
            let flagDesc = false;
            let flagPrecio = false;

            function comprobarNombre() {
                let nombre = $("#nombre").val();
                let regexp = /^[A-Za-zÁÉÍÓÚáéíóú\s]+$/;
                if (nombre == "" || !regexp.test(nombre)) {
                    flagNombre = false;
                    deshabilitarBoton();
                    $("#errorNombre").css("display", "block");
                    $("#nombre").css("border-color", "red");
                } else {
                    flagNombre = true;
                    habilitarBoton();
                    $("#errorNombre").css("display", "none");
                    $("#nombre").css("border-color", "green");
                }
            }

            function comprobarDesc() {
                let regexp = /^[A-Za-zÁÉÍÓÚáéíóú0-9\s]+$/;
                let desc = $("#descripcion").val();
                if (desc == "" || !regexp.test(desc)) {
                    flagDesc = false;
                    deshabilitarBoton();
                    $("#errorDesc").css("display", "block");
                    $("#descripcion").css("border-color", "red");
                } else {
                    flagDesc = true;
                    habilitarBoton();
                    $("#errorDesc").css("display", "none");
                    $("#descripcion").css("border-color", "green");
                }

            }

            function comprobarPrecio() {
                let regexp = /^\d*\.?\d*$/;
                let precio = $("#precio").val();
                if (precio == "" || !regexp.test(precio)) {
                    flagPrecio = false;
                    deshabilitarBoton();
                    $("#errorPrecio").css("display", "block");
                    $("#precio").css("border-color", "red");
                } else {
                    flagPrecio = true;
                    habilitarBoton();
                    $("#errorPrecio").css("display", "none");
                    $("#precio").css("border-color", "green");
                }

            }

            function habilitarBoton() {
                if (flagNombre && flagPrecio && flagDesc) {
                    $("#btAnadirPincho").prop('disabled', false);
                }

            }

            function deshabilitarBoton() {
                $("#btAnadirPincho").prop('disabled', true);
            }

            function modificarPincho(event) {    
                let pincho = $("#cod_pincho").val();                           
                let nombre = $("#nombre").val();
                let descripcion = $("#descripcion").val();
                let precio = $("#precio").val();
                let bar = $("#bar").val();
                let ruta = $("#rutaAnadir").val();
                let file = $("#file")[0].files;
                
                var dataPost = {
                    "nombre": nombre,
                    "descripcion": descripcion,
                    "precio": precio,
                    "bar" : bar,
                    "cod_pincho" : pincho
                };

                $.ajax({
                    type: "POST",
                    url: ruta,
                    data: dataPost,
                    success: function(response){
                       let h = response;
                    }                   
                });
            }
        </script>
</body>

</html>