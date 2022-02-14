<html>

<head>
    <title>Logrocho - Administración</title>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../estilos/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../estilos/css/estilos-administracion.css" />
    <link rel="stylesheet" href="../estilos/font-awesome-4.7.0/font-awesome-4.7.0/css/font-awesome.min.css" />
</head>

<body>
    <!-- Vertical navbar -->
    <?php
    include "menu-admin.php";
    ?>

    <div class="page-content p-5" id="content">
        <!-- Toggle button -->
        <button id="sidebarCollapse" type="button" class="btn btn-light bg-white rounded-pill shadow-sm px-4 mb-4"><i class="fa fa-bars mr-2"></i></button>
        <h1>Panel de administración - Añadir un nuevo pincho</h1>
        <div class="card">
            <div class="container-fliud">
                <div class="wrapper row">
                    <div class="preview col-md-6">
                        <!--<form method="POST" enctype="multipart/form-data" action="<?php echo $rutaAnadirPincho; ?>">-->
                        <form method="POST" enctype="multipart/form-data" onsubmit="anadirPincho(event)">
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input required onblur="comprobarNombre()" type="text" class="form-control" id="nombre" name="nombre" aria-describedby="nombre" placeholder="Introduce el nombre del pincho">
                                <span id="errorNombre" style="display:none; color: red;">Error</span>
                            </div>
                            <div class="form-group">
                                <label for="descripcion">Descripcion</label>
                                <input required onblur="comprobarDesc()" type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Descripcion del pincho">
                                <span id="errorDesc" style="display:none; color: red;">Error</span>
                            </div>
                            <div class="form-group">
                                <label for="precio">Precio</label>
                                <input required onblur="comprobarPrecio()" type="text" class="form-control" id="precio" name="precio" placeholder="Precio de cada pincho">
                                <span id="errorPrecio" style="display:none; color: red;">Error</span>
                            </div><br>
                            <div class="form-group">
                                <label for="bar">Bar</label>
                                <select name="bar" id="bar">
                                    <?php
                                    for ($i = 0; $i < count($bares); $i++) {
                                        echo "<option value='" . $bares[$i]->getCod_bar() . "'>" . $bares[$i]->getCod_bar() . " - " . $bares[$i]->getNombre() . "</option>";
                                    }
                                    ?>
                                </select>
                            </div><br>
                            <div class="form-group">
                                <label for="file">Seleccione imágenes: </label>
                                <input type="file" class="form-control-file" id="file" name="file[]" multiple>
                                <input type="hidden" id="rutaAnadir" value="<?php echo $rutaAnadirPincho; ?>" >
                            </div>
                            <br>
                            <button id="btAnadirPincho" type="submit" class="btn btn-dark" type="button" disabled>Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script src="../js/jquery-3.6.0.min.js"></script>
        <script src="../js/script.js"></script>
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

            function anadirPincho(event) {                              
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
                    "bar" : bar
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