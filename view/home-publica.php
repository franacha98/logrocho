<html>

<head>
  <title>Logrocho - Inicio</title>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../estilos/bootstrap/css/bootstrap.min.css" />
  <link rel="stylesheet" href="../estilos/css/estilos-administracion.css" />
  <link rel="stylesheet" href="../estilos/font-awesome-4.7.0/font-awesome-4.7.0/css/font-awesome.min.css" />
  <style>
    .resena {
      border-radius: 15px;
      border: 1px solid gray;
      background-color: white;
      padding: 5px;
      margin-bottom: 1%;
    }

    .resena:hover {
      cursor: pointer;
      background-color: silver;
    }

    #carouselExampleCaptions {
      width: 80%;
    }
  </style>
</head>

<body>
  <?php
  include "menu-publico.php";
  ?>



  <div class="page-content p-5" id="content">
    <!-- Toggle button -->
    <button id="sidebarCollapse" type="button" class="btn btn-light bg-white rounded-pill shadow-sm px-4 mb-4"><i class="fa fa-bars mr-2"></i></button>
    <h1>Inicio</h1><br><br>
    <p>
      <span id="logrocho-footer"><b>Logro</b><i>cho</i></span> es la página web que todo ciudadano o visitante de Logroño necesita. Tenemos toda la información del principal lugar de interés de nuestra querida ciudad: la calle Laurel.
      Aquí podrás encontrar cualquier pincho y bar de la Laurel, con información detallada de cada uno. También podrás acceder a la ubicación de los bares para que no os perdáis en vuestra maravillosa visita por la Laurel.
    </p>
    <h2>Pinchos mejor valorados</h2><br>
    <div id="contenido">
      <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
          <?php
          for ($i = 0; $i < count($fotos); $i++) {
            if ($i == 0) {
              echo "<div class='carousel-item active' data-bs-interval='5000'>";
            } else {
              echo "<div class='carousel-item' data-bs-interval='5000'>";
            }
          ?>
            <img src="../<?php echo $fotos[$i] ?>" class="d-block w-100" alt="pincho" />;
          <?php
            echo "<div class='carousel-caption d-none d-md-block'>";
            echo "<p>" . $pinchos[$i]["nombre"] . "</p>";
            echo "<p>" . $pinchos[$i]["descripcion"] . "</p>";
            echo "<p>Puntuación: " . round($pinchos[$i]["nota"], 1) . "</p>";
            echo "</div>";
            echo "</div>";
          }
          ?>
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
    <div>
      <h2>Reseñas mejor valoradas</h2>
      <?php
      if ($resenas != null && count($resenas) > 0) {
        for ($i = 0; $i < count($resenas); $i++) {
          echo "<div class='resena'>";
          echo "<h4><i class='fa fa-user-circle' style='color: gray'></i> " . $resenas[$i]->getUsuario() . ":</h4>";
          echo "<blockquote class='blockquote'>";
          echo $resenas[$i]->getComentario();
          echo "</blockquote>";
          echo "<span>Likes: " . $resenas[$i]->getLikes() . " </span>";

          echo "</div>";
        }
      } else {
        echo "<h4>Todavía no hay reseñas 🥱</h4>";
      }

      ?>
    </div>
    <br><br>


    <script src="../js/jquery-3.6.0.min.js"></script>
    <script src="../estilos/bootstrap/js/bootstrap.min.js"></script>
    <script src="../js/script.js"></script>
    <script>
      var myCarousel = document.querySelector('#carouselExampleCaptions');
      var carousel = new bootstrap.Carousel(myCarousel);
    </script>
</body>
<?php
include "footer.php";
?>

</html>