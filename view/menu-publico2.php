<header id="header">
    <a href="<?php echo "http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/inicio";?>">
      <img src="../../resources/media/logo-logrocho.png"> 
    </a>
  </header>
<div class="vertical-nav bg-white" id="sidebar">
    <div class="py-4 px-3 mb-4 bg-light">
      <div class="media d-flex align-items-center"><a href="#"><img src="../../resources/media/foto_perfil.png" alt="Foto de perfil" width="65" class="mr-3 rounded-circle img-thumbnail shadow-sm"></a>
        <div class="media-body">
          <h4 class="m-0"><?php echo $_SESSION["usuario"]; ?></h4>
          <p class="font-weight-light text-muted mb-0">Logrocho</p>
        </div>
      </div>
    </div>

    <p class="text-gray font-weight-bold text-uppercase px-3 small pb-4 mb-0">MENÚ</p>
    <?php 
      $auxbar = false;
      $auxusuario = false;
      $auxcontacto = false;
      $auxpincho = false;
      $auxmapa = false;
      if(strpos($_SERVER['REQUEST_URI'], "bar")){
        $auxbar = true;
        $auxusuario = false;
        $auxcontacto = false;
        $auxpincho = false;
        $auxmapa = false;
      }else if(strpos($_SERVER['REQUEST_URI'], "usuario")){
        $auxbar = false;
        $auxusuario = true;
        $auxcontacto = false;
        $auxpincho = false;
        $auxmapa = false;
      }else if(strpos($_SERVER['REQUEST_URI'], "contacto")){
        $auxbar = false;
        $auxusuario = false;
        $auxcontacto = true;
        $auxpincho = false;
        $auxmapa = false;
      }else if(strpos($_SERVER['REQUEST_URI'], "pincho")){
        $auxbar = false;
        $auxusuario = false;
        $auxcontacto = false;
        $auxpincho = true;
        $auxmapa = false;
      }else if(strpos($_SERVER['REQUEST_URI'], "mapa")){
        $auxbar = false;
        $auxusuario = false;
        $auxcontacto = false;
        $auxpincho = false;
        $auxmapa = true;
      }
      
    ?>
    <ul class="nav flex-column bg-white mb-0">
      <li class="nav-item" <?php echo ($auxbar==true) ? "style='background-color: #40A980'" : "" ?>>
        <a href="<?php echo "http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/bares";?>" class="nav-link text-dark font-italic">
          <i class="fa fa-glass mr-3 fa-fw" <?php echo ($auxbar==true) ? "style='color: white'" : "" ?>></i>
          <span <?php echo ($auxbar==true) ? "style='color: white'" : "" ?>>Bares</span>
        </a>
      </li>
      <li class="nav-item" <?php echo ($auxpincho==true) ? "style='background-color: #40A980'" : "" ?>>
        <a href="<?php echo "http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/pinchos";?>" class="nav-link text-dark font-italic">
          <i class="fa fa-cutlery mr-3 fa-fw" <?php echo ($auxpincho==true) ? "style='color: white'" : "" ?>></i>
          <span <?php echo ($auxpincho==true) ? "style='color: white'" : "" ?>>Pinchos</span>
        </a>
      </li>
      <li class="nav-item" <?php echo ($auxusuario==true) ? "style='background-color: #40A980'" : "" ?>>
        <a href="<?php echo "http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/zona-usuario/0";?>" class="nav-link text-dark font-italic">
          <i class="fa fa-user mr-3 fa-fw" <?php echo ($auxusuario==true) ? "style='color: white'" : "" ?>></i>
          <span <?php echo ($auxusuario==true) ? "style='color: white'" : "" ?>>Perfil de usuario</span>
        </a>
      </li>
      <li class="nav-item" <?php echo ($auxcontacto==true) ? "style='background-color: #40A980'" : "" ?>>
        <a href="<?php echo "http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/contacto";?>" class="nav-link text-dark font-italic">
          <i class="fa fa-envelope mr-3 fa-fw" <?php echo ($auxcontacto==true) ? "style='color: white'" : "" ?>></i>
          <span <?php echo ($auxcontacto==true) ? "style='color: white'" : "" ?>>Contacto</span>
        </a>
      </li> 
      <li class="nav-item" <?php echo ($auxmapa==true) ? "style='background-color: #40A980'" : "" ?>>
        <a href="<?php echo "http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/mapa";?>" class="nav-link text-dark font-italic">
          <i class="fa fa-map-marker mr-3 fa-fw" <?php echo ($auxmapa==true) ? "style='color: white'" : "" ?>></i>
          <span <?php echo ($auxmapa==true) ? "style='color: white'" : "" ?>>Mapa de la Laurel</span>
        </a>
      </li> 
    </ul>
    <div id="cerrarSesion">
      <a href="<?php echo "http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/cerrar-sesion";?>" class="nav-link text-dark font-italic">
        <i class="fa fa-sign-out mr-3 fa-fw"></i>
        <span>Cerrar sesión</span>
      </a>
    </div>
  </div>