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
            $pincho = $this->db->recuperarPincho($cod_pincho);
            
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

            $this->db->modificarPincho($cod_pincho, $nombre, $descripcion, $precio, $bar);

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
            //var_dump($bares);
            echo json_encode($pinchos);
            //$rutaAnadir = "http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/anadir-bar-vista";
            //require("view/lista-bares.php");
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
    }

?>