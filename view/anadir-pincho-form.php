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
                        <form method="POST" enctype="multipart/form-data" action="<?php echo $rutaAnadirPincho; ?>">
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" aria-describedby="nombre" placeholder="Introduce el nombre del bar">
                            </div>
                            <div class="form-group">
                                <label for="descripcion">Descripcion</label>
                                <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Descripcion del pincho">
                            </div>
                            <div class="form-group">
                                <label for="precio">Precio</label>
                                <input type="text" class="form-control" id="precio" name="precio" placeholder="Precio de cada pincho">
                            </div>
                            <div class="form-group">
                                <label for="bar">Bar</label>
                                <input type="number" class="form-control" id="bar" name="bar" placeholder="0">
                            </div><br>
                            <div class="form-group">
                                <label for="file">Seleccione imágenes: </label>
                                <input type="file" class="form-control-file" id="file" name="file[]" multiple>
                            </div>
                            <br>
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