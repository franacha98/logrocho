<?php

    class ResenasController{

        private $db;

        function __construct()
        {
            $this->db = new BBDD();
        }

        /**
         * Rellena una lista con todas las resenas obtenidas de BD para que la vista pueda acceder a ella
         *
         * @return void
         */
        public function listaResenas(){
            $lista = $this->db->listaResenas();

            $rutaAnadir = "http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/anadir-resena-vista";
            require("view/lista-resenas.php");
        }
        /**
         * Muestra el formulario para añadir una nueva reseña
         *
         * @return void
         */
        public function anadirResenaVista(){
            $rutaAnadirResena = "http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/anadir-resena";
            $pinchos = $this->db->listaPinchos();
            require("view/anadir-resena-form.php");
        }
        /**
         * Añade una nueva reseña a la BD llamando al metodo del gestor de base de datos
         *
         * @return void
         */
        public function anadirResena(){
            $rutaAnadirResena = "http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/anadir-resena";
            $this->db->anadirResena($_POST["usuario"], $_POST["pincho"], $_POST["comentario"], $_POST["likes"]);

            header("Location: http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/anadir-resena-vista");
        }
        /**
         * Añade una nueva reseña a la BD llamando al metodo del gestor de base de datos
         *
         * @return void
         */
        public function anadirResenaAJAX(){
            $usuario = $_SESSION["idusuario"];
            $pincho = $_POST["pincho"];
            $comentario = $_POST["comentario"];
            $nota = $_POST["puntosUsuario"];
            $this->db->anadirResenaYPuntuacion($usuario, $pincho, $comentario, $nota);   
            
            header("Location: http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/pincho/" . $pincho);
        }
        /**
         * Elimina una reseña a la BD llamando al metodo del gestor de base de datos
         *
         * @return void
         */
        public function eliminarResena($cod_valoracion){
            $rutaAnadirResena = "http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/anadir-resena";
            $this->db->eliminarResena($cod_valoracion);
            if($_SESSION["admin"] == "YES"){
                header("Location: http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/lista-resenas");
            }else{
                header("Location: http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/zona-usuario/0");
            }
            
        }
        /**
         * Obtiene una reseña a partir del codigo para que se pinte en la vista
         *
         * @return void
         */
        public function fichaResena($cod_valoracion){
            $resena = $this->db->recuperarResena($cod_valoracion);
            $pincho = $this->db->recuperarPincho($resena->getPincho());
            $rutaEliminar = "http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/eliminar-resena/" . $resena->getCod_valoracion();
            $rutaModificar = "http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/modificar-resena";
            require("view/ficha-resena.php");
        }
        /**
         * Modifica una reseña llamando al metodo del gestor de base de datos
         *
         * @return void
         */
        public function modificarResena(){
            $cod_valoracion = $_POST["cod_valoracion"];
            $usuario = $_POST["usuario"];
            $pincho = $_POST["pincho"];
            $comentario = $_POST["comentario"];
            $likes = $_POST["likes"];
            $this->db->modificarResena($cod_valoracion, $usuario, $pincho, $comentario, $likes);

            header("Location: http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/ficha-resena/" . $_POST["cod_valoracion"]);
        }
        /**
         * Pinta un JSON que leera mediante AJAX el JavaScript de la vista
         *
         * @param [int] $limit Parametro LIMIT de una consulta SQL (inicio del registro)
         * @param [int] $num Completa la consulta con el numero de registros a devolver
         * @return void
         */
        public function listaResenaJson($limit, $num){
            $resenas = $this->db->listaResenaJson($limit, $num);
           
            echo json_encode($resenas);

        }
        /**
         * Pinta un JSON con informacion de una reseña que leera mediante AJAX el JavaScript
         *
         * @param [int] $cod_valoracion codigo de una valoracion en base de datos
         * @return void
         */
        public function resenaJson($cod_valoracion){
            $resena = $this->db->recuperarResena($cod_valoracion);

            echo json_encode($resena);
        }
        /**
         * Da un me gusta a una resena
         *
         * @param [int] $cod_resena
         * @return void
         */
        public function meGusta($cod_resena){
            $usuario = $_SESSION["idusuario"];
            $this->db->meGusta($usuario, $cod_resena);
        }
    }

?>