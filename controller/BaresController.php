<?php
    //include "repository/bdd.php";

    class BaresController{

        private $db;

        function __construct()
        {
            $this->db = new BBDD();
        }
        /**
         * Lista con todos los bares para la vista
         *
         * @return void
         */
        public function listaBares(){
            $lista = $this->db->listaBares();

            $rutaAnadir = "http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/anadir-bar-vista";
            require("view/lista-bares.php");
        }
        /**
         * muestra el formulario para añadir un bar nuevo
         *
         * @return void
         */
        public function anadirBarVista(){
            $rutaAnadirBar = "http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/anadir-bar";

            require("view/anadir-bar-form.php");
        }
        /**
         * añade un nuevo bar
         *
         * @return void
         */
        public function anadirBar(){
            $rutaAnadirBar = "http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/anadir-bar";
            $this->db->anadirBar($_POST["nombre"], $_POST["latitud"], $_POST["longitud"]);

            $cod_bar = $this->db->recuperarBarNombre($_POST["nombre"]);
            //echo $cod_bar;
            //var_dump($_FILES);
            $countfiles = count($_FILES['file']['name']);
            //echo $countfiles;
            $fotos_bar = array();
            $rutaBase = file_get_contents("config.txt");
            echo $rutaBase;
            $rutaFotos = $rutaBase . "\\img_bares\\" . $cod_bar;
            for($i=0;$i<$countfiles;$i++){
                $filename = $_FILES['file']['name'][$i];
                array_push($fotos_bar, $filename);
                if (!file_exists($rutaFotos.$filename)) {
                    mkdir($rutaFotos, 0777, true);
                }
                move_uploaded_file($_FILES['file']['tmp_name'][$i], $rutaFotos."\\".$filename);                
            }
            $this->db->anadirFotosBar($cod_bar, $fotos_bar);
            header("Location: http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/anadir-bar-vista");
        }

        /**
         * elimina un bar
         *
         * @param [int] $cod_bar
         * @return void
         */
        public function eliminarBar($cod_bar){
            $rutaAnadirBar = "http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/anadir-bar";
            $this->db->eliminarBar($cod_bar);

            header("Location: http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/lista-bares");
        }
        /**
         * muestra la ficha de un bar
         *
         * @param [int] $cod_bar
         * @return void
         */
        public function fichaBar($cod_bar){
            $bar = $this->db->recuperarBar($cod_bar);
            $aux_fotos = $this->db->recuperarFotosBar($cod_bar);
            
            $fotos = array();
            $ids = array();
            for ($i=0; $i < count($aux_fotos); $i++) { 
                array_push($fotos, $aux_fotos[$i]["ruta"]);
                array_push($ids, $aux_fotos[$i]["id"]);
            }

            $rutaEliminar = "http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/eliminar-bar/" . $bar->getCod_bar();
            $rutaModificar = "http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/modificar-bar";
            require("view/ficha-bar.php");
        }
        /**
         * modifica un bar
         *
         * @return void
         */
        public function modificarBar(){
            $cod_bar = $_POST["cod_bar"];
            $nombre = $_POST["nombre"];
            $latitud = $_POST["latitud"];
            $longitud = $_POST["longitud"];

            $countfiles = count($_FILES['file']['name']);
            $fotos_bar = array();
            $rutaBase = file_get_contents("config.txt");
            echo $rutaBase;
            $rutaFotos = $rutaBase . "\\img_bares\\" . $cod_bar;
            for($i=0;$i<$countfiles;$i++){
                $filename = $_FILES['file']['name'][$i];
                array_push($fotos_bar, $filename);
                if (!file_exists($rutaFotos.$filename)) {
                    mkdir($rutaFotos, 0777, true);
                }
                move_uploaded_file($_FILES['file']['tmp_name'][$i], $rutaFotos."\\".$filename);
                
            }

            $this->db->modificarBar($cod_bar, $nombre, $latitud, $longitud);
            $this->db->anadirFotosBar($cod_bar, $fotos_bar);

            header("Location: http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/ficha-bar/" . $_POST["cod_bar"]);
        }
        /**
         * lista los bares en formato json
         *
         * @param [int] $limit
         * @param [int] $num
         * @return void
         */
        public function listaBaresJson($limit, $num){
            $bares = $this->db->listaBaresJson($limit, $num);
            //var_dump($bares);
            echo json_encode($bares);
            //$rutaAnadir = "http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/anadir-bar-vista";
            //require("view/lista-bares.php");
        }
        /**
         * informacion de un bar en formato json
         *
         * @param [int] $cod_bar
         * @return void
         */
        public function barJson($cod_bar){
            $bar = $this->db->recuperarBar($cod_bar);

            echo json_encode($bar);
        }

        public function eliminarFotoBar($id){
            $ok = $this->db->eliminarFotoBar($id);

            if($ok){
                echo "OK";
            }else{
                echo "KO";
            }
        } 
    }
