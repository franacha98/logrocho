<?php
    //include "repository/bdd.php";

    class PinchosController{

        private $db;

        function __construct()
        {
            $this->db = new BBDD();
        }
        /**
         * lista todos los pinchos
         *
         * @return void
         */
        public function listaPinchos(){
            $lista = $this->db->listaPinchos();

            $rutaAnadir = "http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/anadir-pincho-vista";
            require("view/lista-pinchos.php");
        }
        /**
         * añade un nuevo pincho
         *
         * @return void
         */
        public function anadirPincho(){
            $rutaAnadirPincho = "http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/anadir-pincho";
            
            $this->db->anadirPincho($_POST["nombre"], $_POST["descripcion"], $_POST["precio"], $_POST["bar"]);

            $cod_pincho = $this->db->recuperarPinchoNombre($_POST["nombre"]);
            //echo $cod_bar;
            //var_dump($_FILES);
            $countfiles = count($_FILES['file']['name']);
            //echo $countfiles;
            $fotos_bar = array();
            $rutaBase = file_get_contents("config.txt");
            
            $rutaFotos = $rutaBase . "\\img_pinchos\\" . $cod_pincho;
            for($i=0;$i<$countfiles;$i++){
                $filename = $_FILES['file']['name'][$i];               
                array_push($fotos_bar, $filename);
                if (!file_exists($rutaFotos.$filename)) {
                    mkdir($rutaFotos, 0777, true);
                }
                move_uploaded_file($_FILES['file']['tmp_name'][$i], $rutaFotos."\\".$filename);                
            }
            $this->db->anadirFotosPincho($cod_pincho, $fotos_bar);

            echo "http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/anadir-pincho-vista";
            //header("Location: http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/anadir-pincho-vista");
        }
        /**
         * muestra el formulario para añadir un nuevo pincho
         *
         * @return void
         */
        public function anadirPinchoVista(){
            $rutaAnadirPincho = "http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/anadir-pincho";
            $bares = $this->db->listaBares();
            require("view/anadir-pincho-form.php");
        }
        /**
         * elimina un pincho
         *
         * @param [int] $cod_pincho
         * @return void
         */
        public function eliminarPincho($cod_pincho){
            $rutaAnadirPincho = "http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/anadir-pincho";
            $this->db->eliminarPincho($cod_pincho);

            header("Location: http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/lista-pinchos");
        }
        /**
         * muestra la ficha de un pincho
         *
         * @param [int] $cod_pincho
         * @return void
         */
        public function fichaPincho($cod_pincho){
            $bares = $this->db->listaBares();
            $pincho = $this->db->recuperarPincho($cod_pincho);
            $aux_fotos = $this->db->recuperarFotosPincho($cod_pincho);
               
            $fotos = array();
            $ids = array();
            for ($i=0; $i < count($aux_fotos); $i++) { 
                array_push($fotos, $aux_fotos[$i]["ruta"]);
                array_push($ids, $aux_fotos[$i]["id"]);
            }

            $rutaEliminar = "http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/eliminar-pincho/" . $pincho->getCod_pincho();
            $rutaModificar = "http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/modificar-pincho";
            require("view/ficha-pincho.php");
        }
        /**
         * modifica un pincho
         *
         * @return void
         */
        public function modificarPincho(){
            $cod_pincho = $_POST["cod_pincho"];
            $nombre = $_POST["nombre"];
            $descripcion = $_POST["descripcion"];
            $precio = $_POST["precio"];
            $bar = $_POST["bar"];

            $countfiles = count($_FILES['file']['name']);
            $fotos_bar = array();
            $rutaBase = file_get_contents("config.txt");
            echo $rutaBase;
            $rutaFotos = $rutaBase . "\\img_pinchos\\" . $cod_pincho;
            for($i=0;$i<$countfiles;$i++){
                $filename = $_FILES['file']['name'][$i];
                array_push($fotos_bar, $filename);
                if (!file_exists($rutaFotos.$filename)) {
                    mkdir($rutaFotos, 0777, true);
                }
                move_uploaded_file($_FILES['file']['tmp_name'][$i], $rutaFotos."\\".$filename);
                
            }

            $this->db->modificarPincho($cod_pincho, $nombre, $descripcion, $precio, $bar);
            $this->db->anadirFotosPincho($cod_pincho, $fotos_bar);
            header("Location: http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/ficha-pincho/" . $_POST["cod_pincho"]);
        }
        /**
         * listado de los pinchos en formato json
         *
         * @param [int] $limit
         * @param [int] $num
         * @return void
         */
        public function listaPinchosJson($limit, $num){
            $pinchos = $this->db->listaPinchosJson($limit, $num);
            echo json_encode($pinchos);        
        }

        /**
         * pincho en formato json
         *
         * @param [int] $cod_pincho
         * @return void
         */
        public function pinchoJson($cod_pincho){
            $pincho = $this->db->recuperarPincho($cod_pincho);

            echo json_encode($pincho);
        }
        /**
         * elimina la foto de un pincho
         *
         * @param [type] $id
         * @return void
         */
        public function eliminarFotoPincho($id){
            $ok = $this->db->eliminarFotoPincho($id);

            if($ok){
                echo "OK";
            }else{
                echo "KO";
            }
        }  
        /**
         * carga los datos del listado de pinchos de la parte publica
         *
         * @return void
         */
        public function listaPinchosPublico(){
            $lista = $this->db->listaPinchos();
           
            for ($i=0; $i < count($lista); $i++) { 
                $mini = $this->db->obtenerPrimeraImagenPincho($lista[$i]->getCod_pincho());
                if($mini == null){
                    $mini = "resources/media/logo-logrocho.png";
                }
                $lista[$i]->setMiniatura($mini);
                $bar = $this->db->recuperarBar($lista[$i]->getBar());
                $lista[$i]->setBar($bar);
                $puntuacion = $this->db->puntuacionPincho($lista[$i]->getCod_pincho());
                if($puntuacion["puntuacion"] == null){
                    $lista[$i]->setPuntuacion("0");
                }else{
                    $lista[$i]->setPuntuacion($puntuacion["puntuacion"]);
                }
                
            }


            require("view/pinchos-publico.php");
        }
        /**
         * carga los datos de un pincho en especifico para que se pinten en la ficha publica de un pincho
         *
         * @param [type] $cod_pincho
         * @return void
         */
        public function pinchoPublico($cod_pincho){
            $bares = $this->db->listaBares();
            $pincho = $this->db->recuperarPincho($cod_pincho);

            $aux_fotos = $this->db->recuperarFotosPincho($cod_pincho);
               
            $fotos = array();
            $ids = array();
            for ($i=0; $i < count($aux_fotos); $i++) { 
                array_push($fotos, $aux_fotos[$i]["ruta"]);
                array_push($ids, $aux_fotos[$i]["id"]);
            }

            $aux = $this->db->puntuacionPincho($cod_pincho);
            $nota = $aux["puntuacion"];
            $votos = $aux["votos"];
            $puntuacion = round($nota/$votos, 2);  
            $estrellaCheck = "<span class='fa fa-star checked'></span>  ";
            $estrella = "<span class='fa fa-star'></span>  ";

            $bar = $this->db->recuperarBar($pincho->getBar());
            $rutaBar = "http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/bar/" . $pincho->getBar();

            $resenas = $this->db->resenasDePincho($cod_pincho);

            $mislikes = $this->db->misLikes($_SESSION["idusuario"]);

            for ($i=0; $i < count($resenas); $i++) { 
                $nombre = $this->db->nombreUsuario($resenas[$i]->getUsuario());
                $resenas[$i]->setUsuario($nombre);
                $resenas[$i]->setFlag(false);
                for ($j=0; $j < count($mislikes); $j++) { 
                    if($mislikes[$j] == $resenas[$i]->getCod_valoracion()){
                        $resenas[$i]->setFlag(true);
                    }
                }
            }

            $rutaAnadirResena = "http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/anadir-resena-ajax";

            require("view/pincho.php");
        }
    }


?>