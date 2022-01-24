<html>
  <head>
    <title>Logrocho - Iniciar sesión</title>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="estilos/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="estilos/css/estilos.css" />
  </head>

  <body>
    <div class="container-login100">
      <div class="wrap-login100">
        <form class="login100-form validate-form" method="POST" action="<?php echo $rutaLogin; ?>">
          <img id="img-logo" src="resources/media/logo-logrocho.png">
          <div class="wrap-input100 validate-input">
            <input class="input100" type="text" name="usuario" placeholder="Usuario" />
            <span class="focus-input100"></span>
          </div>
          <div class="wrap-input100 validate-input">
            <input class="input100" type="password" name="pass" placeholder="Contraseña" />
            <span class="focus-input100"></span>
          </div>
          <div id="olvidada">
            <a href="<?php echo $rutaOlvidada; ?>" class="txt1"> ¿Olvidó su contraseña? </a>
          </div>
          <div class="container-login100-form-btn">
            <button class="login100-form-btn">Iniciar sesión</button>
          </div>
        </form>
        <div class="login100-more" style="background-image: url('resources/media/fondo4.jpg');"></div>
      </div>
    </div>
  </body>
</html>
