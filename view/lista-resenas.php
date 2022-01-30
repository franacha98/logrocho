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
  <!-- Vertical navbar -->
  <?php
  include "menu-admin.php";
  ?>
  <!-- End vertical navbar -->

  <!-- Page content holder -->
  <div class="page-content p-5" id="content">
    <!-- Toggle button -->
    <button id="sidebarCollapse" type="button" class="btn btn-light bg-white rounded-pill shadow-sm px-4 mb-4"><i class="fa fa-bars mr-2"></i></button>

    <h1>Panel de administración - Listado de reseñas</h1>

    <!-- End demo content -->
    <input class="form-control" id="buscador" type="text" placeholder="Buscar...">
    <br>
    <div id="filtros">
      <a href="<?php echo $rutaAnadir; ?>"><button class="btn btn-dark">Añadir</button></a>
      <button id="btnEliminar" class="btn btn-danger">Eliminar seleccionados</button><br><br>
      <label for="paginacion">Configurar páginación:</label>
      <select id="paginacion" name="paginacion" class="form-select" aria-label="Default select example" onchange="pintarTablaResenas()">
        <option selected value="3">Tres en tres</option>
        <option value="5">Cinco en cinco</option>
        <option value="20">Todo</option>
      </select>
    </div><br>
    <table class="table table-hover table-bordered">
      <thead>
        <tr>
          <th scope="col"></th>
          <th scope="col" onclick="ordenarID()">ID</th>
          <th scope="col" onclick="ordenarUsuario()">Usuario</th>
          <th scope="col" onclick="ordenarPincho()">Pincho</th>
          <th scope="col" onclick="ordenarComentario()">Comentario</th>
          <th scope="col" onclick="ordenarLikes()">Likes</th>
        </tr>
      </thead>
      <tbody id="myTable">
      </tbody>
    </table>
    <div id="paginacion">
      <button id="btAnterior" class="btn btn-dark" onclick="anterior()">Anterior</button>
      <button id="btSiguiente" class="btn btn-dark" onclick="siguiente()">Siguiente</button>
    </div>

  </div>
  <?php
  include "footer.php";
  ?>
  <script src="../js/jquery-3.6.0.min.js"></script>
  <script>
    let pag;
    let resenas;
    let ordID = true;
    let ordUsuario = false;
    let ordPincho = false;
    let ordComentario = false;
    let ordLikes = false;
    
    window.onload = function() {
      pintarTablaResenas();
    }

    function ordenarID() {
      ordUsuario = false;
      ordPincho = false;
      ordComentario = false;
      ordLikes = false;

      if (ordID == false) {
        resenas.sort(function(a, b) {
          if (a.cod_valoracion > b.cod_valoracion) {
            return 1;
          }
          if (a.cod_valoracion < b.cod_valoracion) {
            return -1;
          }
          // a must be equal to b
          return 0;
        });
        ordID = true;   
      } else {
        resenas.sort(function(a, b) {
        if (a.cod_valoracion < b.cod_valoracion) {
          return 1;
        }
        if (a.cod_valoracion > b.cod_valoracion) {
          return -1;
        }
        // a must be equal to b
        return 0;
      });
      ordID = false;
      }
      let tabla = $("#myTable");
      let numero = parseInt($("#paginacion").val());

      tabla.html("");
      for (let i = 0; i < numero; i++) {
        tabla.append("<tr><th scope='row'><input type='checkbox' class='checkbox-list'></th><td onclick='irAFicha(this)'>" + resenas[i].cod_valoracion + "</td><td onclick='irAFicha(this)'>" + resenas[i].usuario + "</td><td onclick='irAFicha(this)'>" + resenas[i].pincho + "</td><td onclick='irAFicha(this)'>" + resenas[i].comentario + "</td><td onclick='irAFicha(this)'>" + resenas[i].likes + "</td></tr>");
      }
    }

    function ordenarUsuario() {
      ordID = false;
      ordPincho = false;
      ordComentario = false;
      ordLikes = false;

      if (ordUsuario == false) {
        resenas.sort(function(a, b) {
          if (a.usuario > b.usuario) {
            return 1;
          }
          if (a.usuario < b.usuario) {
            return -1;
          }
          // a must be equal to b
          return 0;
        });
        ordUsuario = true;   
      } else {
        resenas.sort(function(a, b) {
        if (a.usuario < b.usuario) {
          return 1;
        }
        if (a.usuario > b.usuario) {
          return -1;
        }
        // a must be equal to b
        return 0;
      });
      ordUsuario = false;
      }
      let tabla = $("#myTable");
      let numero = parseInt($("#paginacion").val());

      tabla.html("");
      for (let i = 0; i < numero; i++) {
        tabla.append("<tr><th scope='row'><input type='checkbox' class='checkbox-list'></th><td onclick='irAFicha(this)'>" + resenas[i].cod_valoracion + "</td><td onclick='irAFicha(this)'>" + resenas[i].usuario + "</td><td onclick='irAFicha(this)'>" + resenas[i].pincho + "</td><td onclick='irAFicha(this)'>" + resenas[i].comentario + "</td><td onclick='irAFicha(this)'>" + resenas[i].likes + "</td></tr>");
      }
    }

    function ordenarPincho() {
      ordID = false;
      ordNombre = false;
      ordComentario = false;
      ordLikes = false;

      if (ordPincho == false) {
        resenas.sort(function(a, b) {
          if (a.pincho > b.pincho) {
            return 1;
          }
          if (a.pincho < b.pincho) {
            return -1;
          }
          // a must be equal to b
          return 0;
        });
        ordPincho = true;   
      } else {
        resenas.sort(function(a, b) {
        if (a.pincho < b.pincho) {
          return 1;
        }
        if (a.pincho > b.pincho) {
          return -1;
        }
        // a must be equal to b
        return 0;
      });
      ordPincho = false;
      }
      let tabla = $("#myTable");
      let numero = parseInt($("#paginacion").val());

      tabla.html("");
      for (let i = 0; i < numero; i++) {
        tabla.append("<tr><th scope='row'><input type='checkbox' class='checkbox-list'></th><td onclick='irAFicha(this)'>" + resenas[i].cod_valoracion + "</td><td onclick='irAFicha(this)'>" + resenas[i].usuario + "</td><td onclick='irAFicha(this)'>" + resenas[i].pincho + "</td><td onclick='irAFicha(this)'>" + resenas[i].comentario + "</td><td onclick='irAFicha(this)'>" + resenas[i].likes + "</td></tr>");
      }
    }

    function ordenarComentario() {
      ordID = false;
      ordNombre = false;
      ordPincho = false;
      ordLikes = false;

      if (ordComentario == false) {
        resenas.sort(function(a, b) {
          if (a.comentario > b.comentario) {
            return 1;
          }
          if (a.pincho < b.pincho) {
            return -1;
          }
          // a must be equal to b
          return 0;
        });
        ordComentario = true;   
      } else {
        resenas.sort(function(a, b) {
        if (a.comentario < b.comentario) {
          return 1;
        }
        if (a.comentario > b.comentario) {
          return -1;
        }
        // a must be equal to b
        return 0;
      });
      ordComentario = false;
      }
      let tabla = $("#myTable");
      let numero = parseInt($("#paginacion").val());

      tabla.html("");
      for (let i = 0; i < numero; i++) {
        tabla.append("<tr><th scope='row'><input type='checkbox' class='checkbox-list'></th><td onclick='irAFicha(this)'>" + resenas[i].cod_valoracion + "</td><td onclick='irAFicha(this)'>" + resenas[i].usuario + "</td><td onclick='irAFicha(this)'>" + resenas[i].pincho + "</td><td onclick='irAFicha(this)'>" + resenas[i].comentario + "</td><td onclick='irAFicha(this)'>" + resenas[i].likes + "</td></tr>");
      }
    }

    function ordenarLikes() {
      ordID = false;
      ordNombre = false;
      ordPincho = false;
      ordComentario = false;

      if (ordLikes == false) {
        resenas.sort(function(a, b) {
          if (a.likes > b.likes) {
            return 1;
          }
          if (a.likes < b.likes) {
            return -1;
          }
          // a must be equal to b
          return 0;
        });
        ordLikes = true;   
      } else {
        resenas.sort(function(a, b) {
        if (a.likes < b.likes) {
          return 1;
        }
        if (a.likes > b.likes) {
          return -1;
        }
        // a must be equal to b
        return 0;
      });
      ordLikes = false;
      }
      let tabla = $("#myTable");
      let numero = parseInt($("#paginacion").val());

      tabla.html("");
      for (let i = 0; i < numero; i++) {
        tabla.append("<tr><th scope='row'><input type='checkbox' class='checkbox-list'></th><td onclick='irAFicha(this)'>" + resenas[i].cod_valoracion + "</td><td onclick='irAFicha(this)'>" + resenas[i].usuario + "</td><td onclick='irAFicha(this)'>" + resenas[i].pincho + "</td><td onclick='irAFicha(this)'>" + resenas[i].comentario + "</td><td onclick='irAFicha(this)'>" + resenas[i].likes + "</td></tr>");
      }
    }

    function pintarTablaResenas() {
      let tabla = $("#myTable");
      let numero = parseInt($("#paginacion").val());
      pag = 0;
      $.ajax({
        type: "GET",
        url: "http://localhost/logrocho/index.php/listado-resenas/0/" + numero,
        dataType: "json",
        success: function(response) {
          resenas = response;
          //TABLA
          tabla.html("");
          for (let i = 0; i < numero; i++) {
            tabla.append("<tr><th scope='row'><input type='checkbox' class='checkbox-list'></th><td onclick='irAFicha(this)'>" + response[i].cod_valoracion + "</td><td onclick='irAFicha(this)'>" + response[i].usuario + "</td><td onclick='irAFicha(this)'>" + response[i].pincho + "</td><td onclick='irAFicha(this)'>" + response[i].comentario + "</td><td onclick='irAFicha(this)'>" + response[i].likes + "</td></tr>");

          }
          //tabla.append(tbody);
          $("#btAnterior").prop("disabled", true);
        }
      });
    }

    function siguiente() {
      let tabla = $("#myTable");
      let numero = parseInt($("#paginacion").val());
      pag = pag + numero;
      $.ajax({
        type: "GET",
        url: "http://localhost/logrocho/index.php/listado-resenas/" + pag + "/" + numero,
        //data: {"pais" : datalist.value},
        dataType: "json",
        success: function(response) {
          if (response.length != 0) {
            resenas = response;
            tabla.html("");
            $("#btAnterior").prop("disabled", false);
            if (response.length < pag) {
              for (let i = 0; i < response.length; i++) {
                tabla.append("<tr><th scope='row'><input type='checkbox' class='checkbox-list'></th><td onclick='irAFicha(this)'>" + response[i].cod_valoracion + "</td><td onclick='irAFicha(this)'>" + response[i].usuario + "</td><td onclick='irAFicha(this)'>" + response[i].pincho + "</td><td onclick='irAFicha(this)'>" + response[i].comentario + "</td><td onclick='irAFicha(this)'>" + response[i].likes + "</td></tr>");
                $("#btSiguiente").prop("disabled", true);
              }
            } else {
              for (let i = 0; i < numero; i++) {
                tabla.append("<tr><th scope='row'><input type='checkbox' class='checkbox-list'></th><td onclick='irAFicha(this)'>" + response[i].cod_valoracion + "</td><td onclick='irAFicha(this)'>" + response[i].usuario + "</td><td onclick='irAFicha(this)'>" + response[i].pincho + "</td><td onclick='irAFicha(this)'>" + response[i].comentario + "</td><td onclick='irAFicha(this)'>" + response[i].likes + "</td></tr>");
                $("#btSiguiente").prop("disabled", false);
              }
            }
          } else {
            pag = pag - numero;
          }


        }
      });
    }

    function anterior() {
      let tabla = $("#myTable");
      let numero = parseInt($("#paginacion").val());
      if ((pag - numero) >= 0) {
        pag = pag - numero;
      }
      $.ajax({
        type: "GET",
        url: "http://localhost/logrocho/index.php/listado-resenas/" + pag + "/" + numero,
        //data: {"pais" : datalist.value},
        dataType: "json",
        success: function(response) {
          resenas = response;
          //TABLA
          tabla.html("");
          $("#btSiguiente").prop("disabled", false);
          if (response.length < pag) {
            for (let i = 0; i < response.length; i++) {
                tabla.append("<tr><th scope='row'><input type='checkbox' class='checkbox-list'></th><td onclick='irAFicha(this)'>" + response[i].cod_valoracion + "</td><td onclick='irAFicha(this)'>" + response[i].usuario + "</td><td onclick='irAFicha(this)'>" + response[i].pincho + "</td><td onclick='irAFicha(this)'>" + response[i].comentario + "</td><td onclick='irAFicha(this)'>" + response[i].likes + "</td></tr>");
              $("#btAnterior").prop("disabled", true);
            }
          } else {
            for (let i = 0; i < numero; i++) {
                tabla.append("<tr><th scope='row'><input type='checkbox' class='checkbox-list'></th><td onclick='irAFicha(this)'>" + response[i].cod_valoracion + "</td><td onclick='irAFicha(this)'>" + response[i].usuario + "</td><td onclick='irAFicha(this)'>" + response[i].pincho + "</td><td onclick='irAFicha(this)'>" + response[i].comentario + "</td><td onclick='irAFicha(this)'>" + response[i].likes + "</td></tr>");
              $("#btAnterior").prop("disabled", false);
            }
          }
        }
      });
    }
  </script>
  <script src="../js/script.js"></script>

</body>

</html>