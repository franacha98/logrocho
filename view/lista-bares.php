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
    <button id="sidebarCollapse" type="button" class="btn btn-light bg-white rounded-pill shadow-sm px-4 mb-4"><i
        class="fa fa-bars mr-2"></i></button>

      <h1>Panel de administración - Listado de bares</h1>
      
  <!-- End demo content -->
    <input class="form-control" id="buscador" type="text" placeholder="Buscar...">
    <br>
    <div id="filtros">
      <a href="<?php echo $rutaAnadir; ?>"><button class="btn btn-dark">Añadir</button></a>
      <button id="btnEliminar" class="btn btn-danger">Eliminar seleccionados</button>
    </div><br>
    <table class="table table-hover table-bordered">
      <thead>
        <tr>
          <th scope="col"></th>
          <th scope="col">ID</th>
          <th scope="col">Nombre</th>
          <th scope="col">Latidud</th>
          <th scope="col">Longitud</th>
        </tr>
      </thead>
      <tbody id="myTable">
      </tbody>
    </table>
    <div id="paginacion">
            <button id="btAnterior" class="btn btn-dark" onclick="anterior()">Anterior</button>
            <button id="btSiguiente" class="btn btn-dark" onclick="siguiente()">Siguiente</button>
        </div>
  <script src="../js/jquery-3.6.0.min.js"></script>
  <script>
    let pag;
    window.onload = function(){
      pintarTablaBares();
    }

    function pintarTablaBares() {  
    let tabla = $("#myTable");
    pag = 0;
    $.ajax({
        type: "GET",
        url: "http://localhost/logrocho/index.php/listado-bares/0/3",
        dataType: "json",
        success: function (response) {
            //TABLA
            tabla.html("");
            for(let i = 0; i < 3; i++){
                tabla.append("<tr><th scope='row'><input type='checkbox' class='checkbox-list'></th><td onclick='irAFicha(this)'>"+response[i].cod_bar+"</td><td onclick='irAFicha(this)'>"+response[i].nombre+"</td><td onclick='irAFicha(this)'>"+response[i].latitud+"</td><td onclick='irAFicha(this)'>"+response[i].longitud+"</td></tr>");
            
            }
            //tabla.append(tbody);
            $("#btAnterior").prop("disabled", true);
        }
    });
}

function siguiente(){
    let tabla = $("#myTable");
    pag = pag + 3;
    $.ajax({
        type: "GET",
        url: "http://localhost/logrocho/index.php/listado-bares/"+pag+"/3",
        //data: {"pais" : datalist.value},
        dataType: "json",
        success: function (response) {
            //TABLA
            tabla.html("");
            $("#btAnterior").prop("disabled", false);
            if(response.length < pag){
              for(let i = 0; i < response.length; i++){
                tabla.append("<tr><th scope='row'><input type='checkbox' class='checkbox-list'></th><td onclick='irAFicha(this)'>"+response[i].cod_bar+"</td><td onclick='irAFicha(this)'>"+response[i].nombre+"</td><td onclick='irAFicha(this)'>"+response[i].latitud+"</td><td onclick='irAFicha(this)'>"+response[i].longitud+"</td></tr>");
                $("#btSiguiente").prop("disabled", true);
              }
            }else{
              for(let i = 0; i < 3; i++){
                tabla.append("<tr><th scope='row'><input type='checkbox' class='checkbox-list'></th><td onclick='irAFicha(this)'>"+response[i].cod_bar+"</td><td onclick='irAFicha(this)'>"+response[i].nombre+"</td><td onclick='irAFicha(this)'>"+response[i].latitud+"</td><td onclick='irAFicha(this)'>"+response[i].longitud+"</td></tr>");
                $("#btSiguiente").prop("disabled", false);
              }
            }          
            
        }
    });   
}

function anterior(){
    let tabla = $("#myTable");
    if((pag - 3) >= 0){
      pag = pag - 3;   
    }
    $.ajax({
        type: "GET",
        url: "http://localhost/logrocho/index.php/listado-bares/"+pag+"/3",
        //data: {"pais" : datalist.value},
        dataType: "json",
        success: function (response) {
            //TABLA
            tabla.html("");
            $("#btSiguiente").prop("disabled", false);
            if(response.length < pag){
              for(let i = 0; i < response.length; i++){
                tabla.append("<tr><th scope='row'><input type='checkbox' class='checkbox-list'></th><td onclick='irAFicha(this)'>"+response[i].cod_bar+"</td><td onclick='irAFicha(this)'>"+response[i].nombre+"</td><td onclick='irAFicha(this)'>"+response[i].latitud+"</td><td onclick='irAFicha(this)'>"+response[i].longitud+"</td></tr>");
                $("#btAnterior").prop("disabled", true);
              }
            }else{
              for(let i = 0; i < 3; i++){
                tabla.append("<tr><th scope='row'><input type='checkbox' class='checkbox-list'></th><td onclick='irAFicha(this)'>"+response[i].cod_bar+"</td><td onclick='irAFicha(this)'>"+response[i].nombre+"</td><td onclick='irAFicha(this)'>"+response[i].latitud+"</td><td onclick='irAFicha(this)'>"+response[i].longitud+"</td></tr>");
                $("#btAnterior").prop("disabled", false);
              }
            }          
            // pag = nuevoPag;
        }
    });   
}

  </script>
  <script src="../js/script.js"></script>
  
</body>

</html>