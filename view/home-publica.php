<html>

<head>
  <title>Logrocho - Inicio</title>
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
    <button id="sidebarCollapse" type="button" class="btn btn-light bg-white rounded-pill shadow-sm px-4 mb-4"><i
        class="fa fa-bars mr-2"></i></button>
      <div id="contenido">
        <h1>Inicio</h1>
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
              <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
              <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
              <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
              <div class="carousel-item active" data-bs-interval="5000">
                <img src="../resources/media/losrotos-gulas.jpg" class="d-block w-100" alt="pincho1">
                <div class="carousel-caption d-none d-md-block">
                  <h5>Roto de gulas</h5>
                  <p>Huevos rotos sobre un bollo de pan tierno con patatas y gulas.</p>
                </div>
              </div>
              <div class="carousel-item" data-bs-interval="5000"> 
                <img src="../resources/media/tioagus5.jpg" class="d-block w-100" alt="pincho2">
                <div class="carousel-caption d-none d-md-block">
                  <h5>Tío Agus</h5>
                  <p>Cerdo adobado con salsa secreta de la abuela Damiana.</p>
                </div>
              </div>
              <div class="carousel-item" data-bs-interval="5000">
                <img src="../resources/media/zorropito.jpg" class="d-block w-100" alt="pincho3">
                <div class="carousel-caption d-none d-md-block">
                  <h5>Zorropito</h5>
                  <p>Bacon o lomo sobre un bollo caliente con una suave salsa ali-oli a la que añadimos jamon york.</p>
                </div>
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
      </div>
    </div>  
      <br><br>
    

        <script src="../js/jquery-3.6.0.min.js"></script>
        <script src="../estilos/bootstrap/js/bootstrap.min.js"></script>
        <script src="../js/script.js"></script>
      </body>
      <?php
        include "footer.php";
      ?>
      </html>