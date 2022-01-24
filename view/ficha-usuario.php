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

    <h1>Panel de administración - Ficha usuario</h1>
    <div class="card">
        <div class="container-fliud">
            <div class="wrapper row">
                <div class="preview col-md-6">
                    
                    <div class="preview-pic tab-content">
                      <div class="tab-pane active" id="pic-1"><img src="media/bar2.jpg" /></div>
                      
                    </div>
                    <ul class="preview-thumbnail nav nav-tabs">
                        <li class="active"><a data-target="#pic-5" data-toggle="tab"><img class="imgPequena" src="media/bar2.jpg" /></a></li>
                        <li><a data-target="#pic-1" data-toggle="tab"><img class="imgPequena" src="media/los-rotos.jpg" /></a></li>
                        <li><a data-target="#pic-2" data-toggle="tab"><img class="imgPequena" src="media/losrotos-gulas.jpg" /></a></li>
                        <li><a data-target="#pic-3" data-toggle="tab"><img class="imgPequena" src="media/bodeguilla-los-rotos.jpg" /></a></li>
                        <li><a data-target="#pic-4" data-toggle="tab"><img class="imgPequena" src="media/bodeguilla-los-rotos (1).jpg" /></a></li>                      
                    </ul>         
                </div>
                <div class="details col-md-6">
                    <h3 class="product-title"><?php echo $usu->getNombre(); ?></h3>
                    <form method="POST" action="<?php echo $rutaModificar ?>">
                    <input type="hidden" name="correo" value="<?php echo $usu->getCorreo(); ?>" />
                    <div>                         
                        <span class="review-no">Nombre</span>  
                        <i class="fa fa-pencil mr-3 fa-fw"></i> 
                        <input class="form-control" type="text" name="nombre" placeholder="Nombre bar" value="<?php echo $usu->getNombre(); ?>">
                    </div><br>
                    <div>                         
                        <span class="review-no">Correo</span>  
                        <i class="fa fa-pencil mr-3 fa-fw"></i> 
                        <input class="form-control" type="text" name="usuario" placeholder="Correo usuario" value="<?php echo $usu->getCorreo(); ?>">
                    </div><br>
                    <div>                         
                        <span class="review-no">Contraseña</span>  
                        <i class="fa fa-pencil mr-3 fa-fw"></i> 
                        <input class="form-control" type="password" name="contrasena" placeholder="Contraseña usuario" value="<?php echo $usu->getContrasena(); ?>">
                    </div><br>
                    <div>                         
                        <span class="review-no">Es administrador</span>  
                        <i class="fa fa-pencil mr-3 fa-fw"></i> 
                        <input class="form-control" type="text" name="admin" placeholder="0" value="<?php echo ($usu->getAdmin() == 1) ? 'SI' : 'NO' ?>">
                    </div><br>
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
  </div>
    <?php
    include "footer.php";
    ?>
    <script src="../../js/jquery-3.6.0.min.js"></script>
    <script src="../../js/script.js"></script>
</body>

</html>