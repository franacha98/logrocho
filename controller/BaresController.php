<?php
    //include "repository/bdd.php";

    class BaresController{

        private $db;

        function __construct()
        {
            $this->db = new BBDD();
        }

        public function listaBares(){
            $lista = $this->db->listaBares();

            $rutaAnadir = "http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/anadir-bar-vista";
            require("view/lista-bares.php");
        }

        public function anadirBarVista(){
            $rutaAnadirBar = "http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/anadir-bar";

            require("view/anadir-bar-form.php");
        }

        public function anadirBar(){
            $rutaAnadirBar = "http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/anadir-bar";
            $this->db->anadirBar($_POST["nombre"], $_POST["latitud"], $_POST["longitud"]);

            header("Location: http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/anadir-bar-vista");
        }

        public function eliminarBar($cod_bar){
            $rutaAnadirBar = "http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/anadir-bar";
            $this->db->eliminarBar($cod_bar);

            header("Location: http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/lista-bares");
        }

        public function fichaBar($cod_bar){
            $bar = $this->db->recuperarBar($cod_bar);
            
            $rutaEliminar = "http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/eliminar-bar/" . $bar->getCod_Bar();
            $rutaModificar = "http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/modificar-bar";
            require("view/ficha-bar.php");
        }

        public function modificarBar(){
            $cod_bar = $_POST["cod_bar"];
            $nombre = $_POST["nombre"];
            $latitud = $_POST["latitud"];
            $longitud = $_POST["longitud"];

            $this->db->modificarBar($cod_bar, $nombre, $latitud, $longitud);

            header("Location: http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/ficha-bar/" . $_POST["cod_bar"]);
        }

        public function listaBaresJson($limit, $num){
            $bares = $this->db->listaBaresJson($limit, $num);
            //var_dump($bares);
            echo json_encode($bares);
            //$rutaAnadir = "http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/anadir-bar-vista";
            //require("view/lista-bares.php");
        }

        public function barJson($cod_bar){
            $bar = $this->db->recuperarBar($cod_bar);

            echo json_encode($bar);
        }
    }

?>