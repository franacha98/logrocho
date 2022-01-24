<html>

<head>
    <title>Logrocho - Login</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../resources/icons/favicon-16x16.png" type="image/x-icon">
    <link rel="stylesheet" href="../estilos/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../estilos/css/estilosHome.css" />
    <script src="../js/script.js"></script>
</head>

<body>

<h1 class="display-2">Logrocho</h1>
<form method="POST" action="<?php echo $rutaLogin ?>">

  <div class="form-group">
    <label for="username">Username</label>
    <input type="text" class="form-control" id="username" name="username" aria-describedby="username" placeholder="Enter your username">
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
  </div>
  <button type="submit" class="btn btn-warning">Submit</button>
</form>


</body>
</html>