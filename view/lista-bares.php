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

    <h1>Panel de administración - Listado de bares</h1>

    <!-- End demo content -->
    <input class="form-control" id="buscador" type="text" placeholder="Buscar...">
    <br>
    <div id="filtros">
      <a href="<?php echo $rutaAnadir; ?>"><button class="btn btn-dark">Añadir</button></a>
      <button id="btnEliminar" class="btn btn-danger">Eliminar seleccionados</button><br><br>
      <label for="paginacion">Configurar páginación:</label>
      <select id="paginacion" name="paginacion" class="form-select" aria-label="Default select example" onchange="pintarTablaBares()">
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
          <th scope="col" onclick="ordenarNombre()">Nombre</th>
          <th scope="col" onclick="ordenarLatitud()">Latidud</th>
          <th scope="col" onclick="ordenarLongitud()">Longitud</th>
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
    let bares;
    let ordID = true;
    let ordNombre = false;
    let ordLat = false;
    let ordLon = false;
    
    window.onload = function() {
      pintarTablaBares();
    }

    function ordenarID() {
      ordLat = false;
      ordNombre = false;
      ordLon = false;

      if (ordID == false) {
        bares.sort(function(a, b) {
          if (a.cod_bar > b.cod_bar) {
            return 1;
          }
          if (a.cod_bar < b.cod_bar) {
            return -1;
          }
          // a must be equal to b
          return 0;
        });
        ordID = true;   
      } else {
        bares.sort(function(a, b) {
        if (a.cod_bar < b.cod_bar) {
          return 1;
        }
        if (a.cod_bar > b.cod_bar) {
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
        tabla.append("<tr><th scope='row'><input type='checkbox' class='checkbox-list'></th><td onclick='irAFicha(this)'>" + bares[i].cod_bar + "</td><td onclick='irAFicha(this)'>" + bares[i].nombre + "</td><td onclick='irAFicha(this)'>" + bares[i].latitud + "</td><td onclick='irAFicha(this)'>" + bares[i].longitud + "</td></tr>");
      }
    }

    function ordenarNombre() {
      ordLat = false;
      ordID = false;
      ordLon = false;

      if (ordNombre == false) {
        bares.sort(function(a, b) {
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
        bares.sort(function(a, b) {
        if (a.nombre < b.nombre) {
          return 1;
        }
        if (a.nombre > b.nombre) {
          return -1;
        }
        // a must be equal to b
        return 0;
      });
      ordNombre = false;
      }
      let tabla = $("#myTable");
      let numero = parseInt($("#paginacion").val());

      tabla.html("");
      for (let i = 0; i < numero; i++) {
        tabla.append("<tr><th scope='row'><input type='checkbox' class='checkbox-list'></th><td onclick='irAFicha(this)'>" + bares[i].cod_bar + "</td><td onclick='irAFicha(this)'>" + bares[i].nombre + "</td><td onclick='irAFicha(this)'>" + bares[i].latitud + "</td><td onclick='irAFicha(this)'>" + bares[i].longitud + "</td></tr>");
      }
    }

    function ordenarLatitud() {
      ordNombre = false;
      ordID = false;
      ordLon = false;

      if (ordLat == false) {
        bares.sort(function(a, b) {
          if (a.latitud > b.latitud) {
            return 1;
          }
          if (a.latitud < b.latitud) {
            return -1;
          }
          // a must be equal to b
          return 0;
        });
        ordLat = true;   
      } else {
        bares.sort(function(a, b) {
        if (a.latitud < b.latitud) {
          return 1;
        }
        if (a.latitud > b.latitud) {
          return -1;
        }
        // a must be equal to b
        return 0;
      });
      ordLat = false;
      }
      let tabla = $("#myTable");
      let numero = parseInt($("#paginacion").val());

      tabla.html("");
      for (let i = 0; i < numero; i++) {
        tabla.append("<tr><th scope='row'><input type='checkbox' class='checkbox-list'></th><td onclick='irAFicha(this)'>" + bares[i].cod_bar + "</td><td onclick='irAFicha(this)'>" + bares[i].nombre + "</td><td onclick='irAFicha(this)'>" + bares[i].latitud + "</td><td onclick='irAFicha(this)'>" + bares[i].longitud + "</td></tr>");
      }
    }

    function ordenarLongitud() {
      ordNombre = false;
      ordID = false;
      ordLat = false;

      if (ordLon == false) {
        bares.sort(function(a, b) {
          if (a.longitud > b.longitud) {
            return 1;
          }
          if (a.longitud < b.longitud) {
            return -1;
          }
          // a must be equal to b
          return 0;
        });
        ordLon = true;   
      } else {
        bares.sort(function(a, b) {
        if (a.longitud < b.longitud) {
          return 1;
        }
        if (a.longitud > b.longitud) {
          return -1;
        }
        // a must be equal to b
        return 0;
      });
      ordLon = false;
      }
      let tabla = $("#myTable");
      let numero = parseInt($("#paginacion").val());

      tabla.html("");
      for (let i = 0; i < numero; i++) {
        tabla.append("<tr><th scope='row'><input type='checkbox' class='checkbox-list'></th><td onclick='irAFicha(this)'>" + bares[i].cod_bar + "</td><td onclick='irAFicha(this)'>" + bares[i].nombre + "</td><td onclick='irAFicha(this)'>" + bares[i].latitud + "</td><td onclick='irAFicha(this)'>" + bares[i].longitud + "</td></tr>");
      }
    }

    function pintarTablaBares() {
      let tabla = $("#myTable");
      let numero = parseInt($("#paginacion").val());
      pag = 0;
      $.ajax({
        type: "GET",
        url: "http://localhost/logrocho/index.php/listado-bares/0/" + numero,
        dataType: "json",
        success: function(response) {
          bares = response;
          //TABLA
          tabla.html("");
          for (let i = 0; i < response.length; i++) {
            tabla.append("<tr><th scope='row'><input type='checkbox' class='checkbox-list'></th><td onclick='irAFicha(this)'>" + response[i].cod_bar + "</td><td onclick='irAFicha(this)'>" + response[i].nombre + "</td><td onclick='irAFicha(this)'>" + response[i].latitud + "</td><td onclick='irAFicha(this)'>" + response[i].longitud + "</td></tr>");

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
        url: "http://localhost/logrocho/index.php/listado-bares/" + pag + "/" + numero,
        //data: {"pais" : datalist.value},
        dataType: "json",
        success: function(response) {
          if (response.length != 0) {
            bares = response;
            tabla.html("");
            $("#btAnterior").prop("disabled", false);
            if (response.length < pag) {
              for (let i = 0; i < response.length; i++) {
                tabla.append("<tr><th scope='row'><input type='checkbox' class='checkbox-list'></th><td onclick='irAFicha(this)'>" + response[i].cod_bar + "</td><td onclick='irAFicha(this)'>" + response[i].nombre + "</td><td onclick='irAFicha(this)'>" + response[i].latitud + "</td><td onclick='irAFicha(this)'>" + response[i].longitud + "</td></tr>");
                $("#btSiguiente").prop("disabled", true);
              }
            } else {
              for (let i = 0; i < numero; i++) {
                tabla.append("<tr><th scope='row'><input type='checkbox' class='checkbox-list'></th><td onclick='irAFicha(this)'>" + response[i].cod_bar + "</td><td onclick='irAFicha(this)'>" + response[i].nombre + "</td><td onclick='irAFicha(this)'>" + response[i].latitud + "</td><td onclick='irAFicha(this)'>" + response[i].longitud + "</td></tr>");
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
        url: "http://localhost/logrocho/index.php/listado-bares/" + pag + "/" + numero,
        //data: {"pais" : datalist.value},
        dataType: "json",
        success: function(response) {
          bares = response;
          //TABLA
          tabla.html("");
          $("#btSiguiente").prop("disabled", false);
          if (response.length < pag) {
            for (let i = 0; i < response.length; i++) {
              tabla.append("<tr><th scope='row'><input type='checkbox' class='checkbox-list'></th><td onclick='irAFicha(this)'>" + response[i].cod_bar + "</td><td onclick='irAFicha(this)'>" + response[i].nombre + "</td><td onclick='irAFicha(this)'>" + response[i].latitud + "</td><td onclick='irAFicha(this)'>" + response[i].longitud + "</td></tr>");
              $("#btAnterior").prop("disabled", true);
            }
          } else {
            for (let i = 0; i < numero; i++) {
              tabla.append("<tr><th scope='row'><input type='checkbox' class='checkbox-list'></th><td onclick='irAFicha(this)'>" + response[i].cod_bar + "</td><td onclick='irAFicha(this)'>" + response[i].nombre + "</td><td onclick='irAFicha(this)'>" + response[i].latitud + "</td><td onclick='irAFicha(this)'>" + response[i].longitud + "</td></tr>");
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