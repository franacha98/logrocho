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
  <?php
  include "menu-admin.php";
  ?>

  <div class="page-content p-5" id="content">
    <!-- Toggle button -->
    <button id="sidebarCollapse" type="button" class="btn btn-light bg-white rounded-pill shadow-sm px-4 mb-4"><i class="fa fa-bars mr-2"></i></button>

    <h1>Panel de administración</h1>
    <div class="row">
      <div class="col-sm-6 mb-3 mb-md-0">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Listado de bares</h5>
            <p class="card-text">Muestra una tabla con la información de todos los bares de la calle Laurel, así como permitir relizar acciones sobre ellos.</p>
            <a href="<?php echo $rutaListaBares;  ?>" class="btn">Ir al listado de bares</a>
          </div>
        </div>
      </div>

      <div class="col-sm-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Listado de pinchos</h5>
            <p class="card-text">Muestra una tabla con la información de todos los pinchos del bares, así como permitir relizar acciones sobre ellos.</p>
            <a href="<?php echo $rutaListaPinchos;  ?>" class="btn">Ir al listado de pinchos</a>
          </div>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Listado de reseñas</h5>
            <p class="card-text">Muestra una tabla con todas las reseñas de los usuarios, tanto a los pinchos como a otras reseñas.</p>
            <a href="<?php echo $rutaListaResenas;  ?>" class="btn">Ir al listado de reseñas</a>
          </div>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Listado de usuarios</h5>
            <p class="card-text">Muestra una tabla con un listado de todos los usuarios y permite realizar varias acciones sobre ellos.</p>
            <a href="<?php echo $rutaListaUsuarios;  ?>" class="btn">Ir al listado de usuarios</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End demo content -->
  <?php
  include "footer.php";
  ?>




  <script src="../js/jquery-3.6.0.min.js"></script>
  <script src="../js/script.js"></script>
</body>

</html>