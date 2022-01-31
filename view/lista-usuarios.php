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

    <h1>Panel de administración - Listado de usuarios</h1>

    <!-- End demo content -->
    <input class="form-control" id="buscador" type="text" placeholder="Buscar...">
    <br>
    <div id="filtros">
      <label for="paginacion">Configurar páginación:</label>
      <select id="paginacion" name="paginacion" class="form-select" aria-label="Default select example" onchange="pintarTablaBares()">
        <option selected value="3">Tres en tres</option>
        <option value="5">Cinco en cinco</option>
        <option value="20">Todo</option>
      </select><br>
      <a href="<?php echo $rutaAnadir; ?>"><button class="btn btn-dark">Añadir nuevo usuario</button></a>
      <button id="btnEliminar" class="btn btn-danger">Eliminar seleccionados</button><br><br>
    </div>
    <table class="table table-hover table-bordered">
      <thead>
        <tr>
          <th scope="col"></th>
          <th scope="col" onclick="ordenarPorCorreo()">Correo</th>
          <th scope="col" onclick="ordenarPorNombre()">Nombre</th>
          <th scope="col" onclick="ordenarPorAdmin()">Es administrador</th>
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
    let users;
    let ordCorreo = true;
    let ordNombre = false;
    let ordAdmin = false;
    window.onload = function() {
      pintarTablaUsuarios();
    }

    function ordenarPorCorreo() {
      ordNombre = false;
      ordAdmin = false;
      if (ordCorreo == false) {
        users.sort(function(a, b) {
          if (a.usuario > b.usuario) {
            return 1;
          }
          if (a.usuario < b.usuario) {
            return -1;
          }
          // a must be equal to b
          return 0;
        });
        ordCorreo = true;

      } else {
        users.sort(function(a, b) {
          if (a.usuario < b.usuario) {
            return 1;
          }
          if (a.usuario > b.usuario) {
            return -1;
          }
          // a must be equal to b
          return 0;
        });
        ordCorreo = false;
      }
      let tabla = $("#myTable");
      let numero = parseInt($("#paginacion").val());

      tabla.html("");
      for (let i = 0; i < numero; i++) {
        tabla.append("<tr><th scope='row'><input type='checkbox' class='checkbox-list'></th><td onclick='irAFicha(this)'>" + users[i].usuario + "</td><td onclick='irAFicha(this)'>" + users[i].nombre + "</td><td onclick='irAFicha(this)'>" + ((users[i].admin == 1) ? 'SI' : 'NO') + "</td></tr>");
      }
    }

    function ordenarPorNombre() {
      ordCorreo = false;
      ordAdmin = false;
      if (ordNombre == false) {
        users.sort(function(a, b) {
          if (a.nombre > b.nombre) {
            return 1;
          }
          if (a.nombre < b.nombre) {
            return -1;
          }
          // a must be equal to b
          return 0;
        });
        ordNombre = true;

      } else {
        users.sort(function(a, b) {
          if (a.nombre < b.nombre) {
            return 1;
          }
          if (a.nombre > b.nombre) {
            return -1;
          }
          return 0;
        });
        ordNombre = false;
      }
      let tabla = $("#myTable");
      let numero = parseInt($("#paginacion").val());

      tabla.html("");
      for (let i = 0; i < numero; i++) {
        tabla.append("<tr><th scope='row'><input type='checkbox' class='checkbox-list'></th><td onclick='irAFicha(this)'>" + users[i].usuario + "</td><td onclick='irAFicha(this)'>" + users[i].nombre + "</td><td onclick='irAFicha(this)'>" + ((users[i].admin == 1) ? 'SI' : 'NO') + "</td></tr>");
      }
    }

    function ordenarPorAdmin() {
      ordCorreo = false;
      ordNombre = false;
      if (ordAdmin == false) {
        users.sort(function(a, b) {
          if (a.admin > b.admin) {
            return 1;
          }
          if (a.admin < b.admin) {
            return -1;
          }
          // a must be equal to b
          return 0;
        });
        ordAdmin = true;

      } else {
        users.sort(function(a, b) {
          if (a.admin < b.admin) {
            return 1;
          }
          if (a.admin > b.admin) {
            return -1;
          }
          return 0;
        });
        ordAdmin = false;
      }
      let tabla = $("#myTable");
      let numero = parseInt($("#paginacion").val());

      tabla.html("");
      for (let i = 0; i < numero; i++) {
        tabla.append("<tr><th scope='row'><input type='checkbox' class='checkbox-list'></th><td onclick='irAFicha(this)'>" + users[i].usuario + "</td><td onclick='irAFicha(this)'>" + users[i].nombre + "</td><td onclick='irAFicha(this)'>" + ((users[i].admin == 1) ? 'SI' : 'NO') + "</td></tr>");
      }
    }

    function pintarTablaUsuarios() {
      let tabla = $("#myTable");
      let numero = parseInt($("#paginacion").val());
      pag = 0;
      $.ajax({
        type: "GET",
        url: "http://localhost/logrocho/index.php/listado-usuarios/0/" + numero,
        dataType: "json",
        success: function(response) {
          users = response;
          //TABLA
          tabla.html("");
          for (let i = 0; i < response.length; i++) {
            tabla.append("<tr><th scope='row'><input type='checkbox' class='checkbox-list'></th><td onclick='irAFicha(this)'>" + response[i].usuario + "</td><td onclick='irAFicha(this)'>" + response[i].nombre + "</td><td onclick='irAFicha(this)'>" + ((response[i].admin == 1) ? 'SI' : 'NO') + "</td></tr>");

          }
        }
      });
    }

    function siguiente() {
      let tabla = $("#myTable");
      let numero = parseInt($("#paginacion").val());
      pag = pag + numero;
      $.ajax({
        type: "GET",
        url: "http://localhost/logrocho/index.php/listado-usuarios/" + pag + "/" + numero,
        dataType: "json",
        success: function(response) {
          if (response.length != 0) {
            users = response;
            //TABLA
            tabla.html("");
            for (let i = 0; i < numero; i++) {
              tabla.append("<tr><th scope='row'><input type='checkbox' class='checkbox-list'></th><td onclick='irAFicha(this)'>" + users[i].usuario + "</td><td onclick='irAFicha(this)'>" + users[i].nombre + "</td><td onclick='irAFicha(this)'>" + ((users[i].admin == 1) ? 'SI' : 'NO') + "</td></tr>");
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
        url: "http://localhost/logrocho/index.php/listado-usuarios/" + pag + "/" + numero,
        //data: {"pais" : datalist.value},
        dataType: "json",
        success: function(response) {
          //TABLA
          users = response;
          tabla.html("");
          for (let i = 0; i < numero; i++) {
            tabla.append("<tr><th scope='row'><input type='checkbox' class='checkbox-list'></th><td onclick='irAFicha(this)'>" + users[i].usuario + "</td><td onclick='irAFicha(this)'>" + users[i].nombre + "</td><td onclick='irAFicha(this)'>" + ((users[i].admin == 1) ? 'SI' : 'NO') + "</td></tr>");
          }
        }
      });
    }
  </script>
  <script src="../js/script.js"></script>

</body>

</html>