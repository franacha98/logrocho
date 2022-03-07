<html>

<head>
  <title>Logrocho - Bares</title>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../estilos/bootstrap/css/bootstrap.min.css" />
  <link rel="stylesheet" href="../estilos/css/estilos-administracion.css" />
  <link rel="stylesheet" href="../estilos/font-awesome-4.7.0/font-awesome-4.7.0/css/font-awesome.min.css" />
  <style>
    .card {
      transition: background .3s ease;
      box-shadow: 0 1px 2px rgba(0, 0, 0, 0.15);
      transition: box-shadow 0.3s ease-in-out;
    }

    .card:hover {
      background-color: #d4d4d4;
      cursor: pointer;
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
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

    <h1>Lista de bares</h1><br><br>
    
    <input class="form-control" list="datalistOptions" id="exampleDataList" placeholder="Buscar un bar por nombre..." onchange="irABar()">
    <datalist id="datalistOptions">
      <?php
      for ($i = 0; $i < count($lista); $i++) { ?>
        <option value="<?php echo $lista[$i]->getCod_bar().". ".$lista[$i]->getNombre(); ?>">
        <?php } ?>
    </datalist>
    <div class="row">
      <?php
      for ($i = 0; $i < count($lista); $i++) {
      ?>


        <div class="card col-lg-3 col-md-3 col-6" style="margin-left: 5%; margin-bottom:10px;">
          <img style="border:1px solid black;" class="card-img-top" src="../<?php echo $lista[$i]->getMiniatura(); ?>" alt="Card image cap">
          <div class="card-body">
            <input type="hidden" value="<?php echo $lista[$i]->getCod_bar(); ?>" />
            <br>
            <h3 class="card-text"><?php echo $lista[$i]->getNombre(); ?></h3>
            <span style="font-weight: bold" class="card-text">Especialidad: 
              <?php 
              if($lista[$i]->getEspecialidad() == null){
                echo "No tiene";
              }else{
                echo $lista[$i]->getEspecialidad()->getNombre(); 
              }
              
              ?>
            </span>

            <div id="puntos">
              <strong>Puntuación:</strong>
              <?php
              if ($lista[$i]->getPuntuacion() >= 4 && $lista[$i]->getPuntuacion() < 5) {
                echo $estrellaCheck . $estrellaCheck . $estrellaCheck . $estrellaCheck . $estrella;
              } else if ($lista[$i]->getPuntuacion() >= 3 && $lista[$i]->getPuntuacion() < 4) {
                echo $estrellaCheck . $estrellaCheck . $estrellaCheck . $estrella . $estrella;
              } else if ($lista[$i]->getPuntuacion() >= 2 && $lista[$i]->getPuntuacion() < 3) {
                echo $estrellaCheck . $estrellaCheck . $estrella . $estrella . $estrella;
              } else if ($lista[$i]->getPuntuacion() >= 1 && $lista[$i]->getPuntuacion() < 2) {
                echo $estrellaCheck . $estrella . $estrella . $estrella . $estrella;
              } else if ($lista[$i]->getPuntuacion() >= 0 && $lista[$i]->getPuntuacion() < 1) {
                echo $estrella . $estrella . $estrella . $estrella . $estrella;
              } else if ($lista[$i]->getPuntuacion() >= 5) {
                echo $estrellaCheck . $estrellaCheck . $estrellaCheck . $estrellaCheck . $estrellaCheck;
              }
              ?>
              <span><?php echo $lista[$i]->getPuntuacion() . "/5"; ?></span><br>
            </div><br><br>
            <a style="width: 100%;" onclick="irAFichaBarPublica(this)" class="btn btn-primary">Ir al bar</a>
          </div>
        </div>

      <?php } ?>
    </div>
  </div>


  <?php
  include "footer.php";
  ?>
  <script src="../js/jquery-3.6.0.min.js"></script>
  <script src="../js/script.js"></script>
  <script>
    function irABar(){
      var cod = $("#exampleDataList").val().substr(0,1);
      window.location.href = "http://<?php echo $_SERVER["HTTP_HOST"]; ?>/logrocho/index.php/bar/" + cod;
    }
  </script>
</body>

</html>