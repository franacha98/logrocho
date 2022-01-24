<header id="header">
    <img src="../resources/media/logo-logrocho.png"> 
</header>
<div class="vertical-nav bg-white" id="sidebar">
    <div class="py-4 px-3 mb-4 bg-light">
      <div class="media d-flex align-items-center"><a href="#"><img src="../resources/media/foto_perfil.png" alt="Foto de perfil" width="65" class="mr-3 rounded-circle img-thumbnail shadow-sm"></a>
        <div class="media-body">
          <h4 class="m-0">ADMIN</h4>
          <p class="font-weight-light text-muted mb-0">Logrocho</p>
        </div>
      </div>
    </div>

    <p class="text-gray font-weight-bold text-uppercase px-3 small pb-4 mb-0">MENÚ</p>

    <ul class="nav flex-column bg-white mb-0">
      <li class="nav-item">
        <a href="<?php echo "http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/lista-bares";?>" class="nav-link text-dark font-italic">
          <i class="fa fa-glass mr-3 fa-fw"></i>
          <span>Listado de bares</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="<?php echo "http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/lista-pinchos";?>" class="nav-link text-dark font-italic">
          <i class="fa fa-cutlery mr-3 fa-fw"></i>
          <span>Listado de pinchos</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="<?php echo "http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/lista-resenas";?>" class="nav-link text-dark font-italic">
          <i class="fa fa-comments mr-3 fa-fw"></i>
          <span>Listado de reseñas</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="<?php echo "http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/lista-usuarios";?>" class="nav-link text-dark font-italic">
          <i class="fa fa-user mr-3 fa-fw"></i>
          <span>Listado de usuarios</span>
        </a>
      </li>
    </ul>
  </div>