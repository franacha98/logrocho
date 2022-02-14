<html>

<head>
    <title>Logrocho - <?php echo $nombre; ?></title>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../../estilos/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../estilos/css/estilos-administracion.css" />
    <link rel="stylesheet" href="../../estilos/font-awesome-4.7.0/font-awesome-4.7.0/css/font-awesome.min.css" />
    <style>
        .resena{
            border-radius: 15px; border: 1px solid gray; background-color: white; padding: 5px; margin-bottom: 1%;
        }
        .resena:hover{
            cursor: pointer;
            background-color: silver;
        }
    </style>
</head>

<body>

    <?php
    include "menu-publico2.php";
    ?>

    <div class="page-content p-5" id="content">
        <!-- Toggle button -->
        <button id="sidebarCollapse" type="button" class="btn btn-light bg-white rounded-pill shadow-sm px-4 mb-4"><i class="fa fa-bars mr-2"></i></button>

        <h1>Información de usuario</h1>
        <div class="card">
            <div class="container-fliud">
                <div class="wrapper row">
                    <div class="preview col-md-6">
                        <div class="preview-pic tab-content">
                            <div class="tab-pane active" id="pic-1" style="width: 50%;"><img src="../../resources/media/foto_perfil.png" /></div>
                        </div>
                    </div>
                    <div class="details col-md-6">
                    <h3 class="product-title"><?php echo $nombre ?></h3>
                        <form method="POST" action="">
                            <input type="hidden" name="correo" value="<?php echo $username ?>" />
                            <div>
                                <span class="review-no">Nombre</span>
                                <i class="fa fa-pencil mr-3 fa-fw"></i>
                                <input class="form-control" type="text" name="nombre" placeholder="Nombre" value="<?php echo $nombre; ?>">
                            </div><br>
                            <div>
                                <span class="review-no">Correo</span>
                                <i class="fa fa-pencil mr-3 fa-fw"></i>                                
                                <input class="form-control" type="text" name="correo" placeholder="Correo usuario" value="<?php echo $username; ?>">
                            </div><br>
                            <div>
                                <span class="review-no">Contraseña</span> 
                                <i class="fa fa-pencil mr-3 fa-fw"></i>                               
                                <input class="form-control" type="password" name="password" placeholder="Correo usuario" value="<?php echo $usuario->getContrasena(); ?>">
                            </div><br>                          
                            <div class="action">
                                <button class="btn btn-dark" type="submit" type="button">Guardar</button>
                            </div>

                        </form><br>
                    </div>
                </div>
                
            </div><br>
            <div id="contenedor">
                    <button id="btnPinchos" onclick="mostrarListaPinchos()" style="width:100%; height:60px;" class="btn btn-dark">VER LOS PINCHOS QUE HAS VALORADO</button><br><br>
                    <table id="tablaPinchos" class="table table-hover table-bordered" style="display:none;">
                        <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Descripción</th>
                                <th scope="col">Precio</th>
                                <th scope="col">Tu puntuación</th>
                            </tr>
                        </thead>
                        <tbody id="myTable">
                            <?php
                            
                            for ($i = 0; $i < count($pinchos); $i++) {
                                echo "<tr><th scope='row'></th><td onclick='irAFichaDesdeOtraFicha(this)'><input type='hidden' value='" . $pinchos[$i]["pincho"] . "' />" . $pinchos[$i]["nombre"] . "</td><td onclick='irAFichaDesdeOtraFicha(this)'>" . $pinchos[$i]["descripcion"] . "</td><td onclick='irAFichaDesdeOtraFicha(this)'>" . $pinchos[$i]["precio"] . "€</td><td onclick='irAFichaDesdeOtraFicha(this)'>" . $pinchos[$i]["nota"] . "</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                    <button onclick="mostrarResenas()" id="btnResenas" class="btn btn-dark" style="width:100%; height:60px;">VER TUS RESEÑAS</button><br><br>
                    <div id="resenasUsuario" style="display:none">
                    <?php
                        if($resenas != null && count($resenas) > 0){
                            for ($i=0; $i < count($resenas); $i++) { 
                                echo "<div class='resena' onclick='eliminarResena(this)'>";
                                echo "<input type='hidden' value='" . $resenas[$i]["cod_valoracion"] . "'>";
                                echo "<h4><i class='fa fa-user-circle' style='color: gray'></i> ". $resenas[$i]["usuario"] ." sobre <a href='".$rutaPincho.$resenas[$i]["pincho"]."'>". $resenas[$i]["nombre"]."</a> <i style='color:black' class='fa fa-external-link'></i></h4>";
                                echo "<blockquote class='blockquote'>";
                                echo $resenas[$i]["comentario"];
                                echo "</blockquote>";
                                echo "<span>Likes: " . $resenas[$i]["likes"] . " </span>";
                                echo "<i class='fa fa-heart'></i>";
                                echo "</div>"; 
                                echo "<figcaption style='margin-top:-1%; margin-bottom:1%' class='figure-caption text-right'>Haz click en la reseña para eliminarla</figcaption>";  
                            }
                        }else{
                            echo "<h4>Todavía no hay reseñas 🥱</h4>";
                        }
                        
                        ?>
                    </div>
            </div>


        </div>
    </div>
    
    <?php
    include "footer.php";
    ?>
    <script src="../../js/jquery-3.6.0.min.js"></script>
    <script src="../../js/script.js"></script>
    <script>
        let pinchos = true;

        function mostrarListaPinchos() {
            $("#tablaPinchos").toggle();
            if (pinchos == true) {
                $("#btnPinchos").text("OCULTAR PINCHOS");
                $("#btnPinchos").css("background-color", "grey");
                pinchos = false;
            } else {
                $("#btnPinchos").text("VER LOS PINCHOS QUE HAS VALORADO");
                $("#btnPinchos").css("background-color", "#40A980");
                pinchos = true;
            }
        }

        let resenas = true;
        function mostrarResenas() {
            $("#resenasUsuario").toggle();
            if (pinchos == true) {
                $("#btnResenas").text("OCULTAR RESEÑAS");
                $("#btnResenas").css("background-color", "grey");
                pinchos = false;
            } else {
                $("#btnResenas").text("VER TUS RESEÑAS");
                $("#btnResenas").css("background-color", "#40A980");
                pinchos = true;
            }
        }

        function eliminarResena(element){
            let cod_valoracion = element.children[0].value;
            
        }

    </script>
</body>

</html>