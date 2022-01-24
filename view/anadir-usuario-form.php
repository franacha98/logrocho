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
        <h1>Panel de administración - Añadir un nuevo usuario</h1>
        <div class="card">
            <div class="container-fliud">
                <div class="wrapper row">
                    <div class="preview col-md-6">
                        <form method="POST" action="<?php echo $rutaAnadirUsuario; ?>">
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" aria-describedby="nombre" placeholder="Nombre del usuario">
                            </div>
                            <div class="form-group">
                                <label for="usuario">Correo</label>
                                <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Correo del usuario">
                            </div>
                            <div class="form-group">
                                <label for="admin">Es admin</label>
                                <input type="number" class="form-control" id="admin" name="admin" min="0" max="1" placeholder="0">
                            </div>
                            <div class="form-group">
                                <label for="contrasena">Contraseña</label>
                                <input type="password" class="form-control" id="contrasena" name="contrasena" placeholder="Introduce la contraseña">
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