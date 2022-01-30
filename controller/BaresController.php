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

            $this->db->modificarBar($cod_bar, $nombre, $latitud, $longitud);

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
    }

?>