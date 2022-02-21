<html>

<head>
    <title>Logrocho - Bares</title>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../estilos/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../estilos/css/estilos-administracion.css" />
    <link rel="stylesheet" href="../estilos/font-awesome-4.7.0/font-awesome-4.7.0/css/font-awesome.min.css" />

</head>

<body>
<?php
        include "menu-publico.php";
        ?>
    <div class="page-content p-5" id="content">

        <!-- Toggle button -->
        <button id="sidebarCollapse" type="button" class="btn btn-light bg-white rounded-pill shadow-sm px-4 mb-4"><i class="fa fa-bars mr-2"></i></button>
        <h1>Contacto</h1>
        
        <div class="card">
            <div class="container-fliud">
                <div class="wrapper row">
                    <form>
                        <div class="row">
                            <div class="form-group col">
                                <label for="nombre">Nombre completo</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
                                    <input type="text" class="form-control" placeholder="Nombre y apellidos" name="nombre" aria-label="Nombre y apellidos" aria-describedby="basic-addon1">
                                </div>
                            </div>
                            <div class="form-group col">
                                <label for="inputEmail">Email</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-envelope"></i></span>
                                    <input type="text" class="form-control" placeholder="Dirección de correo electrónico" name="email" aria-label="Dirección de correo electrónico" aria-describedby="basic-addon1">
                                </div>
                            </div>
                        </div><br>
                        <div class="form-group">
                            <label for="asunto">Asunto</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-commenting"></i></span>
                                <input type="text" class="form-control" id="asunto" placeholder="Resumen corto del motivo del contacto">
                            </div>

                        </div><br>
                        <div class="form-group">
                            <label for="mensaje">Mensaje</label>
                            <textarea class="form-control" id="mensaje" rows="3" placeholder="Escriba detalladamente ..."></textarea>
                        </div>

                        <br>
                        <button type="submit" class="btn btn-dark">Envíar</button>
                    </form>




                </div>
            </div>
        </div>
    </div>
    <?php
    include "footer.php";
    ?>
    <script src="../js/jquery-3.6.0.min.js"></script>
    <script src="../estilos/bootstrap/js/bootstrap.min.js"></script>
    <script src="../js/script.js"></script>
</body>