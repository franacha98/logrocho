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
        <h1>Panel de administración - Añadir un nuevo bar</h1>
        <div class="card">
            <div class="container-fliud">
                <div class="wrapper row">
                    <div class="preview col-md-6">
                    <form method="POST" enctype="multipart/form-data" action="<?php echo $rutaAnadirBar;?>">
                        <!--<form method="POST" enctype="multipart/form-data" onsubmit="anadirBar(event)">-->
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input required type="text" onblur="comprobarNombreBar()" class="form-control" id="nombre" name="nombre" aria-describedby="nombre" placeholder="Introduce el nombre del bar">
                                <span id="errorNombre" style="display:none; color: red;">Error</span>
                            </div>
                            <div class="form-group">
                                <label for="latitud">Latitud</label>
                                <input onblur="comprobarLat()" required type="text" class="form-control" id="latitud" name="latitud" placeholder="0">
                                <span id="errorLat" style="display:none; color: red;">Error</span>
                            </div>
                            <div class="form-group">
                                <label for="longitud">Longitud</label>
                                <input onblur="comprobarLong()" required type="text" class="form-control" id="longitud" name="longitud" placeholder="0">
                                <span id="errorLong" style="display:none; color: red;">Error</span>
                            </div><br>
                            <div class="form-group">
                                <label for="file">Seleccione imágenes: </label>
                                <input type="file" class="form-control-file" id="file" name="file[]" multiple>
                            </div>
                            <br>
                            <input type="hidden" id="rutaAnadirBar" value="<?php echo $rutaAnadirBar;?>">
                            <button id="btAnadirBar" type="submit" class="btn btn-dark" type="button" disabled>Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script src="../js/jquery-3.6.0.min.js"></script>
        <script src="../js/script.js"></script>
        <script>
            let flagNombre = false;
            let flagLatitud = false;
            let flagLongitud = false;

            function comprobarNombreBar() {
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

            function comprobarLong() {
                let regexp = /^-?\d*\.?\d*$/;
                let long = $("#longitud").val();
                if (long == "" || !regexp.test(long)) {
                    flagLongitud = false;
                    deshabilitarBoton();
                    $("#errorLong").css("display", "block");
                    $("#longitud").css("border-color", "red");
                } else {
                    flagLongitud = true;
                    habilitarBoton();
                    $("#errorLong").css("display", "none");
                    $("#longitud").css("border-color", "green");
                }

            }

            function comprobarLat() {
                let regexp = /^-?\d*\.?\d*$/;
                let lat = $("#latitud").val();
                if (lat == "" || !regexp.test(lat)) {
                    flagLatitud = false;
                    deshabilitarBoton();
                    $("#errorLat").css("display", "block");
                    $("#latitud").css("border-color", "red");
                } else {
                    flagLatitud = true;
                    habilitarBoton();
                    $("#errorLat").css("display", "none");
                    $("#latitud").css("border-color", "green");
                }

            }

            function habilitarBoton() {
                if (flagNombre && flagLatitud && flagLongitud) {
                    $("#btAnadirBar").prop('disabled', false);
                }

            }

            function deshabilitarBoton() {
                $("#btAnadirBar").prop('disabled', true);
            }

            function anadirBar(event) {                              
                let nombre = $("#nombre").val();
                let latitud = $("#latitud").val();
                let longitud = $("#longitud").val();
                let ruta = $("#rutaAnadirBar").val();
                let file = $("#file")[0].files;
                var dataPost = {
                    "nombre": nombre,
                    "latitud": latitud,
                    "longitud": longitud
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