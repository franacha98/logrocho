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

    <h1>Panel de administración - Listado de pinchos</h1>

    <!-- End demo content -->
    <input class="form-control" id="buscador" type="text" placeholder="Buscar...">
    <br>
    <div id="filtros">
      <label for="paginacion">Configurar páginación:</label>
      <select id="paginacion" name="paginacion" class="form-select" aria-label="Default select example" onchange="pintarTablaPinchos()">
        <option selected value="3">Tres en tres</option>
        <option value="5">Cinco en cinco</option>
        <option value="20">Todo</option>
      </select><br>

      <div id="columnasAMostrar">
        <span>Columnas a mostrar</span>
        <div class="form-check">
          <input type="checkbox" class="form-check-input" id="colIdPincho" checked onchange="ocultarColumna('colIdPincho')">
          <label class="form-check-label" for="colIdBar">ID</label>
        </div>
        <div class="form-check">
          <input type="checkbox" class="form-check-input" id="colNombrePincho" checked onchange="ocultarColumna('colNombrePincho')">
          <label class="form-check-label" for="colNombreBar">Nombre</label>
        </div>
        <div class="form-check">
          <input type="checkbox" class="form-check-input" id="colDescripcionPincho" checked onchange="ocultarColumna('colDescripcionPincho')">
          <label class="form-check-label" for="colDescripcionPincho">Descripcion</label>
        </div>
        <div class="form-check">
          <input type="checkbox" class="form-check-input" id="colPrecioPincho" checked onchange="ocultarColumna('colPrecioPincho')">
          <label class="form-check-label" for="colPrecioPincho">Precio</label>
        </div>
        <div class="form-check">
          <input type="checkbox" class="form-check-input" id="colBarPincho" checked onchange="ocultarColumna('colBarPincho')">
          <label class="form-check-label" for="colBarPincho">Bar</label>
        </div>
      </div>
      <br>
      <a href="<?php echo $rutaAnadir; ?>"><button class="btn btn-dark">Añadir nuevo pincho</button></a>
      <button id="btnEliminar" class="btn btn-danger">Eliminar seleccionados</button><br><br>
    </div>
    <table class="table table-hover table-bordered">
      <thead>
        <tr>
          <th scope="col"></th>
          <th scope="col" onclick="ordenarID()" class="idpincho">ID</th>
          <th scope="col" onclick="ordenarNombre()" class="nombrepincho">Nombre</th>
          <th scope="col" onclick="ordenarDescripcion()" class="descripcionpincho">Descripcion</th>
          <th scope="col" onclick="ordenarPrecio()" class="preciopincho">Precio</th>
          <th scope="col" onclick="ordenarBar()" class="barpincho">Bar</th>
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
    let ordID = true;
    let ordNombre = false;
    let ordDesc = false;
    let ordPrecio = false;
    let ordBar = false;
    let pinchos;

    window.onload = function() {
      pintarTablaPinchos();
    }

    function ordenarID() {
      ordNombre = false;
      ordDesc = false;
      ordPrecio = false;
      ordBar = false;
      if (ordID == false) {
        pinchos.sort(function(a, b) {
          if (a.cod_pincho > b.cod_pincho) {
            return 1;
          }
          if (a.cod_pincho < b.cod_pincho) {
            return -1;
          }
          // a must be equal to b
          return 0;
        });
        ordID = true;   
      } else {
        pinchos.sort(function(a, b) {
        if (a.cod_pincho < b.cod_pincho) {
          return 1;
        }
        if (a.cod_pincho > b.cod_pincho) {
          return -1;
        }
        // a must be equal to b
        return 0;
      });
        ordID= false;
      }
      let tabla = $("#myTable");
      let numero = parseInt($("#paginacion").val());

      tabla.html("");
      for (let i = 0; i < numero; i++) {
        tabla.append("<tr><th scope='row'><input type='checkbox' class='checkbox-list'></th><td onclick='irAFicha(this)'>" + pinchos[i].cod_pincho + "</td><td onclick='irAFicha(this)'>" + pinchos[i].nombre + "</td><td onclick='irAFicha(this)'>" + pinchos[i].descripcion + "</td><td onclick='irAFicha(this)'>" + pinchos[i].precio + "€</td><td onclick='irAFicha(this)'>" + pinchos[i].bar + "</td></tr>");
      }
    }

    function ordenarNombre() {
      ordID = false;
      ordDesc = false;
      ordPrecio = false;
      ordBar = false;

      if (ordNombre == false) {
        pinchos.sort(function(a, b) {
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
        pinchos.sort(function(a, b) {
        if (a.nombre < b.nombre) {
          return 1;
        }
        if (a.nombre > b.nombre) {
          return -1;
        }
        // a must be equal to b
        return 0;
      });
      ordNombre= false;
      }
      let tabla = $("#myTable");
      let numero = parseInt($("#paginacion").val());

      tabla.html("");
      for (let i = 0; i < numero; i++) {
        tabla.append("<tr><th scope='row'><input type='checkbox' class='checkbox-list'></th><td onclick='irAFicha(this)'>" + pinchos[i].cod_pincho + "</td><td onclick='irAFicha(this)'>" + pinchos[i].nombre + "</td><td onclick='irAFicha(this)'>" + pinchos[i].descripcion + "</td><td onclick='irAFicha(this)'>" + pinchos[i].precio + "€</td><td onclick='irAFicha(this)'>" + pinchos[i].bar + "</td></tr>");
      }
    }

    function ordenarDescripcion() {
      ordID = false;
      ordNombre = false;
      ordPrecio = false;
      ordBar = false;

      if (ordDesc == false) {
        pinchos.sort(function(a, b) {
          if (a.descripcion > b.descripcion) {
            return 1;
          }
          if (a.descripcion < b.descripcion) {
            return -1;
          }
          // a must be equal to b
          return 0;
        });
        ordDesc = true;   
      } else {
        pinchos.sort(function(a, b) {
        if (a.descripcion < b.descripcion) {
          return 1;
        }
        if (a.descripcion > b.descripcion) {
          return -1;
        }
        // a must be equal to b
        return 0;
      });
      ordDesc= false;
      }
      let tabla = $("#myTable");
      let numero = parseInt($("#paginacion").val());

      tabla.html("");
      for (let i = 0; i < numero; i++) {
        tabla.append("<tr><th scope='row'><input type='checkbox' class='checkbox-list'></th><td onclick='irAFicha(this)'>" + pinchos[i].cod_pincho + "</td><td onclick='irAFicha(this)'>" + pinchos[i].nombre + "</td><td onclick='irAFicha(this)'>" + pinchos[i].descripcion + "</td><td onclick='irAFicha(this)'>" + pinchos[i].precio + "€</td><td onclick='irAFicha(this)'>" + pinchos[i].bar + "</td></tr>");
      }
    }

    function ordenarBar() {
      ordID = false;
      ordNombre = false;
      ordPrecio = false;
      ordDesc = false;

      if (ordBar == false) {
        pinchos.sort(function(a, b) {
          if (a.bar > b.bar) {
            return 1;
          }
          if (a.bar < b.bar) {
            return -1;
          }
          // a must be equal to b
          return 0;
        });
        ordBar = true;   
      } else {
        pinchos.sort(function(a, b) {
        if (a.bar < b.bar) {
          return 1;
        }
        if (a.bar > b.bar) {
          return -1;
        }
        // a must be equal to b
        return 0;
      });
      ordBar= false;
      }
      let tabla = $("#myTable");
      let numero = parseInt($("#paginacion").val());

      tabla.html("");
      for (let i = 0; i < numero; i++) {
        tabla.append("<tr><th scope='row'><input type='checkbox' class='checkbox-list'></th><td onclick='irAFicha(this)'>" + pinchos[i].cod_pincho + "</td><td onclick='irAFicha(this)'>" + pinchos[i].nombre + "</td><td onclick='irAFicha(this)'>" + pinchos[i].descripcion + "</td><td onclick='irAFicha(this)'>" + pinchos[i].precio + "€</td><td onclick='irAFicha(this)'>" + pinchos[i].bar + "</td></tr>");
      }
    }
    
    function ordenarPrecio() {
      ordID = false;
      ordNombre = false;
      ordBar = false;
      ordDesc = false;

      if (ordPrecio == false) {
        pinchos.sort(function(a, b) {
          if (a.precio > b.precio) {
            return 1;
          }
          if (a.precio < b.precio) {
            return -1;
          }
          // a must be equal to b
          return 0;
        });
        ordPrecio = true;   
      } else {
        pinchos.sort(function(a, b) {
        if (a.precio < b.precio) {
          return 1;
        }
        if (a.precio > b.precio) {
          return -1;
        }
        // a must be equal to b
        return 0;
      });
      ordPrecio = false;
      }
      let tabla = $("#myTable");
      let numero = parseInt($("#paginacion").val());

      tabla.html("");
      for (let i = 0; i < numero; i++) {
        tabla.append("<tr><th scope='row'><input type='checkbox' class='checkbox-list'></th><td onclick='irAFicha(this)'>" + pinchos[i].cod_pincho + "</td><td onclick='irAFicha(this)'>" + pinchos[i].nombre + "</td><td onclick='irAFicha(this)'>" + pinchos[i].descripcion + "</td><td onclick='irAFicha(this)'>" + pinchos[i].precio + "€</td><td onclick='irAFicha(this)'>" + pinchos[i].bar + "</td></tr>");
      }
    }

    function pintarTablaPinchos() {
      let tabla = $("#myTable");
      let numero = parseInt($("#paginacion").val());
      pag = 0;
      $.ajax({
        type: "GET",
        url: "http://<?php echo $_SERVER["HTTP_HOST"]; ?>/logrocho/index.php/listado-pinchos/0/" + numero,
        dataType: "json",
        success: function(response) {
          pinchos = response;
          //TABLA
          tabla.html("");
          for (let i = 0; i < response.length; i++) {
            tabla.append("<tr><th scope='row'><input type='checkbox' class='checkbox-list'></th><td onclick='irAFicha(this)'>" + response[i].cod_pincho + "</td><td onclick='irAFicha(this)'>" + response[i].nombre + "</td><td onclick='irAFicha(this)'>" + response[i].descripcion + "</td><td onclick='irAFicha(this)'>" + response[i].precio + "€</td><td onclick='irAFicha(this)'>" + response[i].bar + "</td></tr>");
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
        url: "http://<?php echo $_SERVER["HTTP_HOST"]; ?>/logrocho/index.php/listado-pinchos/" + pag + "/" + numero,
        //data: {"pais" : datalist.value},
        dataType: "json",
        success: function(response) {
          pinchos = response;
          if (response.length != 0) {
            tabla.html("");
            for (let i = 0; i < response.length; i++) {
                tabla.append("<tr><th scope='row'><input type='checkbox' class='checkbox-list'></th><td onclick='irAFicha(this)'>" + response[i].cod_pincho + "</td><td onclick='irAFicha(this)'>" + response[i].nombre + "</td><td onclick='irAFicha(this)'>" + response[i].descripcion + "</td><td onclick='irAFicha(this)'>" + response[i].precio + "€</td><td onclick='irAFicha(this)'>" + response[i].bar + "</td></tr>");
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
        url: "http://<?php echo $_SERVER["HTTP_HOST"]; ?>/logrocho/index.php/listado-pinchos/" + pag + "/" + numero,
        //data: {"pais" : datalist.value},
        dataType: "json",
        success: function(response) {
          pinchos = response;
          //TABLA
          tabla.html("");
          
          for (let i = 0; i < response.length; i++) {
                tabla.append("<tr><th scope='row'><input type='checkbox' class='checkbox-list'></th><td onclick='irAFicha(this)'>" + response[i].cod_pincho + "</td><td onclick='irAFicha(this)'>" + response[i].nombre + "</td><td onclick='irAFicha(this)'>" + response[i].descripcion + "</td><td onclick='irAFicha(this)'>" + response[i].precio + "€</td><td onclick='irAFicha(this)'>" + response[i].bar + "</td></tr>");
               
          }
        }
      });
    }
  </script>
  <script src="../js/script.js"></script>

</body>

</html>