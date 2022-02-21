<html>

<head>
  <title>Logrocho - Pinchos</title>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../estilos/bootstrap/css/bootstrap.min.css" />
  <link rel="stylesheet" href="../estilos/css/estilos-administracion.css" />
  <link rel="stylesheet" href="../estilos/font-awesome-4.7.0/font-awesome-4.7.0/css/font-awesome.min.css" />
  <style>
    .card{
      transition: background .3s ease;
      box-shadow: 0 1px 2px rgba(0,0,0,0.15);
      transition: box-shadow 0.3s ease-in-out;
    }
    .card:hover{
      background-color: #d4d4d4;
      cursor: pointer;
      box-shadow: 0 10px 20px rgba(0,0,0,0.3);
    }
  </style>
</head>

<body>
  <?php
  include "menu-publico.php";
  ?>

  <div class="page-content p-5" id="content">
 
    <button id="sidebarCollapse" type="button" class="btn btn-light bg-white rounded-pill shadow-sm px-4 mb-4"><i class="fa fa-bars mr-2"></i></button>
    <h1>Lista de pinchos</h1><br><br>

    <input class="form-control" list="datalistOptions" id="exampleDataList" placeholder="Buscar un pincho por nombre...">
    <datalist id="datalistOptions">
      <?php
        for($i = 0; $i < count($lista); $i++){ ?>
        <option value="<?php echo $lista[$i]->getNombre(); ?>">
        <?php } ?>  
      ?>
    </datalist>
    <div class="row">
    <?php 
      for ($i=0; $i < count($lista); $i++) { 
      ?>          
          <div class="card col-lg-3 col-md-3 col-6" style="margin-left: 5%; margin-bottom:10px;">
          <img style="border:1px solid black;" class="card-img-top" src="../<?php echo $lista[$i]->getMiniatura(); ?>" alt="Card image cap">
          <div class="card-body">
            <input type="hidden" value="<?php echo $lista[$i]->getCod_pincho(); ?>" />
            <br>
            <h3 class="card-text"><?php echo $lista[$i]->getNombre(); ?></h3>
            <p><strong>Descripción:</strong> <?php echo $lista[$i]->getDescripcion(); ?></p>
            <strong>Precio: <?php echo $lista[$i]->getPrecio(); ?> euros</strong><br>
            <strong>Bar: <?php echo $lista[$i]->getBar()->getNombre(); ?></strong><br>
            <strong>Puntuación: <?php echo $lista[$i]->getPuntuacion(); ?></strong><br><br>
            <a style="width: 100%;" onclick="irAFichaBarPublica(this)" class="btn btn-primary">Ir al pincho</a>
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

</body>

</html>