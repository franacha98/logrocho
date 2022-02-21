<html>

<head>
    <title>Logrocho - <?php echo $pincho->getNombre(); ?></title>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../../estilos/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../estilos/css/estilos-administracion.css" />
    <link rel="stylesheet" href="../../estilos/font-awesome-4.7.0/font-awesome-4.7.0/css/font-awesome.min.css" />
    <style>
        .fa-star, .fa-minus-circle, .fa-plus-circle {
            font-size: 40px;           
        }
        #menos, #mas {
            color: black;
        }
        #menos:hover{
            cursor: pointer;
            color: #40A980
        }
        #mas:hover{
            cursor: pointer;
            color: #40A980;
        }
        .resena{
            border-radius: 15px; border: 1px solid gray; background-color: white; padding: 5px; margin-bottom: 1%;
        }
        .resena:hover{
            cursor: pointer;
            background-color: silver;
        }
        #carouselExampleCaptions {
            width: 100%;
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

        <h1><?php echo $pincho->getNombre(); ?></h1>
        <div class="card">
            <div class="container-fliud">
                <div class="wrapper row">
                    <div class="preview col-md-6">
                    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                            </div>
                            <div class="carousel-inner">
                                <?php
                                for ($i = 0; $i < count($fotos); $i++) {
                                    if($i == 0){
                                        echo "<div class='carousel-item active' data-bs-interval='5000'>";
                                    }else{
                                        echo "<div class='carousel-item' data-bs-interval='5000'>";
                                    }
                                ?>
                                <img src="../../<?php echo $fotos[$i] ?>" class="d-block w-100" alt="pincho" />;
                                <?php
                                    echo "<div class='carousel-caption d-none d-md-block'>";
                                    echo "<p>Imagen</p>";
                                    echo "</div>";
                                    echo "</div>";
                                }
                                ?>

                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                    <div class="details col-md-6">
                        <h3 class="product-title"><?php echo $pincho->getNombre(); ?></h3>
                        <h3 class="product-title">Puntuación:</h3>
                        <div id="puntos">
                            <?php
                            if ($puntuacion > 4 && $puntuacion < 5) {
                                echo $estrellaCheck . $estrellaCheck . $estrellaCheck . $estrellaCheck . $estrella;
                            } else if ($puntuacion > 3 && $puntuacion < 4) {
                                echo $estrellaCheck . $estrellaCheck . $estrellaCheck . $estrella . $estrella;
                            } else if ($puntuacion > 2 && $puntuacion < 3) {
                                echo $estrellaCheck . $estrellaCheck . $estrella . $estrella . $estrella;
                            } else if ($puntuacion > 1 && $puntuacion < 2) {
                                echo $estrellaCheck . $estrella . $estrella . $estrella . $estrella;
                            } else if ($puntuacion > 0 && $puntuacion < 1) {
                                echo $estrella . $estrella . $estrella . $estrella . $estrella;
                            } else if ($puntuacion >= 5) {
                                echo $estrellaCheck . $estrellaCheck . $estrellaCheck . $estrellaCheck . $estrellaCheck;
                            }
                            ?>
                            <span><?php echo $puntuacion . "/5"; ?></span><br>
                            <span>Número de votos: <?php echo $votos; ?></span>
                        </div><br>
                        <h3 class="product-title">Descripción</h3>
                        <blockquote class="blockquote">
                            <p><?php echo $pincho->getDescripcion(); ?></p>
                        </blockquote>
                        <h3 class="product-title">Precio: <?php echo $pincho->getPrecio(); ?>€</h3>
                        <h3 class="product-title">Bar: <?php echo $bar->getNombre() . " "; ?></h3>
                        <a class="btn btn-dark" href="<?php echo $rutaBar; ?>">IR AL BAR</a><br>
                        <form>
                            <div class="form-group">           
                                <label for="puntos" style="font-size:22px;">Puntúa el pincho</label><br>              
                                <input class="form-control" id="puntosUsuario" type="number" min=0 max=5 placeholder="0">                                 
                            </div><br>
                            <div class="form-group">
                                <label for="resena" style="font-size:22px;">Añade una reseña</label><br><br>
                                <textarea class="form-control" id="resena" rows="4" placeholder="Escribe aquí tu comentario..."></textarea>
                            </div><br>
                            <button type="submit" class="btn btn-dark">Envíar reseña</button>
                        </form>
                    </div>                      
                    <div id="resenas" style="margin-top: 5%;">
                        <h3 class="product-title">Reseñas</h3>
                        <?php
                        if($resenas != null && count($resenas) > 0){
                            for ($i=0; $i < count($resenas); $i++) { 
                                echo "<div class='resena'>";
                                echo "<h4><i class='fa fa-user-circle' style='color: gray'></i> ". $resenas[$i]->getUsuario() .":</h4>";
                                echo "<blockquote class='blockquote'>";
                                echo $resenas[$i]->getComentario();
                                echo "</blockquote>";
                                echo "<span>Likes: " . $resenas[$i]->getLikes() . " </span>";
                                echo "<i class='fa fa-heart'></i>";
                                echo "</div>"; 
                                echo "<figcaption style='margin-top:-1%; margin-bottom:1%' class='figure-caption text-right'>Haz click en la reseña para indicar que te gusta</figcaption>";
                            }
                        }else{
                            echo "<h4>Todavía no hay reseñas 🥱</h4>";
                        }
                        
                        ?>
                        
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <?php
    include "footer.php";
    ?>
    <script src="../../js/jquery-3.6.0.min.js"></script>
    <script src="../../estilos/bootstrap/js/bootstrap.min.js"></script>
    <script src="../../js/script.js"></script>
    <script>
        var myCarousel = document.querySelector('#carouselExampleCaptions');
        var carousel = new bootstrap.Carousel(myCarousel);
    </script>
</body>

</html>