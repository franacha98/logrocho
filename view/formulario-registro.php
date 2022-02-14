<html>
  <head>
    <title>Logrocho - Registro</title>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../estilos/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../estilos/css/estilos.css" />
  </head>

  <body>
    <div class="container-login100">
      <div class="wrap-login100">
        <form class="login100-form validate-form" method="POST" action="<?php echo $rutaRegistro; ?>">
          <img id="img-logo" src="../resources/media/logo-logrocho.png">
          <div class="wrap-input100 validate-input">
            <input class="input100" type="text" name="nombre" placeholder="Nombre completo" />
            <span class="focus-input100"></span>
          </div>
          <div class="wrap-input100 validate-input">
            <input class="input100" type="text" name="usuario" placeholder="Usuario" />
            <span class="focus-input100"></span>
          </div>
          <div class="wrap-input100 validate-input">
            <input class="input100" type="password" name="pass" placeholder="Contraseña" />
            <span class="focus-input100"></span>
          </div>
          <div class="container-login100-form-btn">
            <button class="login100-form-btn">Registrarse</button>
          </div>
        </form>
        <div class="login100-more" style="background-image: url('../resources/media/fondo4.jpg');"></div>
      </div>
    </div>
  </body>
</html>
