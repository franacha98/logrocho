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
        <h1>Panel de administración - Añadir un nueva resena</h1>
        <div class="card">
            <div class="container-fliud">
                <div class="wrapper row">
                    <div class="preview col-md-6">
                        <form method="POST" action="<?php echo $rutaAnadirResena; ?>">
                            <div class="form-group">
                                <label for="usuario">Usuario</label>
                                <input type="text" class="form-control" id="usuario" name="usuario" aria-describedby="usuario" placeholder="Introduce el usuario que escribe la reseña">
                            </div>
                            <div class="form-group">
                                <label for="pincho">Pincho</label><br>
                                <select name="pincho">
                                    <?php
                                    for ($i = 0; $i < count($pinchos); $i++) {
                                        echo "<option value='" . $pinchos[$i]->getCod_pincho() . "'>" . $pinchos[$i]->getCod_pincho() . " - " . $pinchos[$i]->getNombre() . "</option>";
                                    }
                                    ?>
                                </select>
                                <!--<input type="text" class="form-control" id="pincho" name="pincho" placeholder="Introduce el pincho al que se dirige la reseña">-->
                            </div>
                            <div class="form-group">
                                <label for="comentario">Comentario</label>
                                <input type="text" class="form-control" id="comentario" name="comentario" placeholder="Comentario de la reseña">
                            </div>
                            <div class="form-group">
                                <label for="likes">Likes</label>
                                <input type="number" class="form-control" id="likes" name="likes" placeholder="0">
                            </div><br>
                            <button type="submit" class="btn btn-dark" type="button">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <script src="../js/jquery-3.6.0.min.js"></script>
        <script src="../js/script.js"></script>
</body>

</html>