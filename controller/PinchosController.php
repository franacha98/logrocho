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
            $this->db->anadirFotosPincho($cod_pincho, $fotos_bar);

            header("Location: http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/anadir-pincho-vista");
        }
        /**
         * muestra el formulario para añadir un nuevo pincho
         *
         * @return void
         */
        public function anadirPinchoVista(){
            $rutaAnadirPincho = "http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/anadir-pincho";

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

        public function eliminarFotoPincho($id){
            $ok = $this->db->eliminarFotoPincho($id);

            if($ok){
                echo "OK";
            }else{
                echo "KO";
            }
        }   
    }

?>