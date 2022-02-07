<html>

<head>
    <title>Logrocho - Administración</title>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../../estilos/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../estilos/css/estilos-administracion.css" />
    <link rel="stylesheet" href="../../estilos/font-awesome-4.7.0/font-awesome-4.7.0/css/font-awesome.min.css" />
    <style>
        .fa-star {
            font-size: 40px;
        }
    </style>
</head>

<body>

    <?php
    include "menu-publico2.php";
    ?>

    <div class="page-content p-5" id="content">
        <!-- Toggle button -->
        <button id="sidebarCollapse" type="button" class="btn btn-light bg-white rounded-pill shadow-sm px-4 mb-4"><i class="fa fa-bars mr-2"></i></button>

        <h1><?php echo $bar->getNombre(); ?></h1>
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
                                echo "<li id='$ids[$i]'><a data-target='#pic-" . ($i + 1) . "' data-toggle='tab'><img class='imgPequena' src='../../$fotos[$i]' /></a></li>";
                            }

                            ?>
                        </ul>
                    </div>
                    <div class="details col-md-6">
                        <h3 class="product-title">Nombre: <?php echo $bar->getNombre(); ?></h3><br>
                        <h3 class="product-title">Puntuación:</h3>
                        <div id="puntos">
                            <?php
                            if ($puntuacion > 4 && $puntuacion < 5) {
                                echo $estrellaCheck . $estrellaCheck . $estrellaCheck . $estrellaCheck . $estrella;
                            } else if ($puntuacion > 3 && $puntuacion < 4) {
                                echo $estrellaCheck . $estrellaCheck . $estrellaCheck . $estrella . $estrella;
                            } else if ($puntuacion > 2 && $puntuacion < 3) {
                                echo $estrellaCheck . $estrellaCheck . $estrella . $estrella . $estrella;
                            } else if ($puntuacion > 1 && $puntuacion < 2) {
                                echo $estrellaCheck . $estrella . $estrella . $estrella . $estrella;
                            } else if ($puntuacion > 0 && $puntuacion < 1) {
                                echo $estrella . $estrella . $estrellaCheck . $estrella . $estrella;
                            } else if ($puntuacion >= 5) {
                                echo $estrellaCheck . $estrellaCheck . $estrellaCheck . $estrella . $estrellaCheck;
                            }
                            ?>
                            <span><?php echo $puntuacion . "/5"; ?></span><br>
                            <span>Número de votos: <?php echo $votos; ?></span>
                        </div><br>
                        <h3 class="product-title">Especialidad:</h3>
                        <h3 class="product-title"><?php echo $pinchoEspecialidad->getNombre() . " "; ?><a href="<?php echo $rutaEspecialidad; ?>"><i class="fa fa-external-link" style="color: black"></i></a></h3>
                        <h4>Descripción de la especialidad:</h4>
                        <span><?php echo $pinchoEspecialidad->getDescripcion(); ?></span><br>
                        <form>
                            <div class="form-group">
                                <label for="resena" style="font-size:22px;">Añade una reseña</label><br><br>
                                <textarea class="form-control" id="resena" rows="4" placeholder="Escribe aquí tu comentario..."></textarea>
                            </div><br>
                            <button type="submit" class="btn btn-dark">Envíar reseña</button>
                        </form>

                    </div>
                </div><br>
                <div id="contenedorPinchos">
                    <button id="btnPinchosBar" class="btn btn-dark" style="width:100%; height:60px;" onclick="mostrarListaPinchos()">Mostrar los pinchos del bar</button><br><br>
                    <table id="tablaPinchosDeBar" class="table table-hover table-bordered" style="display:none;">
                        <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Descripción</th>
                                <th scope="col">Precio</th>
                            </tr>
                        </thead>
                        <tbody id="myTable">
                            <?php
                            for ($i = 0; $i < count($pinchosDelBar); $i++) {
                                echo "<tr><th scope='row'></th><td onclick='irAFichaDesdeOtraFicha(this)'><input type='hidden' value='" . $pinchosDelBar[$i]->getCod_pincho() . "' />" . $pinchosDelBar[$i]->getNombre() . "</td><td onclick='irAFicha(this)'>" . $pinchosDelBar[$i]->getDescripcion() . "</td><td onclick='irAFicha(this)'>" . $pinchosDelBar[$i]->getPrecio() . "€</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                    <button id="btnMapa" class="btn btn-dark" onclick="mostrarMapa()" style="width:100%; height:60px">Mostrar localización en el mapa</button><br><br>

                    <iframe id="mapa" style="display:none" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1750.0422112085178!2d
                        <?php echo $bar->getLongitud(); ?>!3d<?php echo $bar->getLatitud(); ?>!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd5aab47796c184f%3A0x77b6adb3ab59ccd5!2s
                        <?php echo $encodedName?>%22!5e0!3m2!1ses!2ses!4v1644262431626!5m2!1ses!2ses" width="100%" height="600" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    

                    

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
   

    <script>
        let pinchos = true;

        function mostrarListaPinchos() {
            $("#tablaPinchosDeBar").toggle();
            if (pinchos == true) {
                $("#btnPinchosBar").text("Ocultar los pinchos del bar");
                $("#btnPinchosBar").css("background-color", "grey");
                pinchos = false;
            } else {
                $("#btnPinchosBar").text("Mostrar los pinchos del bar");
                $("#btnPinchosBar").css("background-color", "#40A980");
                pinchos = true;
            }
        }

        let mapa = true;

        function mostrarMapa() {
            $("#mapa").toggle();
            if (mapa == true) {
                $("#btnMapa").text("Ocultar mapa");
                $("#btnMapa").css("background-color", "grey");
                mapa = false;
            } else {
                $("#btnMapa").text("Mostrar localización en el mapa");
                $("#btnMapa").css("background-color", "#40A980");
                mapa = true;
            }
        }

        let map;

        function initMap() {
            map = new google.maps.Map(document.getElementById("mapa"), {
                center: {
                    lat: -34.397,
                    lng: 150.644
                },
                zoom: 8,
            });
        }
    </script>
</body>

</html>