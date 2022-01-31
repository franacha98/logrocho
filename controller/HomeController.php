<?php
    include "repository/bdd.php";

    class HomeController{

        private $db;
        function __construct()
        {
            $this->db = new BBDD();
        }
        /**
         * muestra la home de la pagina
         *
         * @return void
         */
        public function renderizarHome(){
            unset($_SESSION["admin"]);
            unset($_SESSION["usuario"]);
            session_destroy();

            $aux = str_replace("index.php/", "",$_SERVER["REQUEST_URI"]);
            $rutaLogin = "http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/check-login";
            $rutaOlvidada = "http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/contrasena-olvidada";
            require("view/index.php");
        }
        /**
         * muestra la pagina de contraseña olvidada
         *
         * @return void
         */
        public function renderizarContrasenaOlvidada(){

            $aux = str_replace("index.php/", "",$_SERVER["REQUEST_URI"]);
            //$rutaLogin = "http://" . $_SERVER["HTTP_HOST"] . $aux . "index.php/check-login";
            $rutaLogin = "http://" . $_SERVER["HTTP_HOST"] . "/logrocho/";
            $rutaOlvidada = "http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/contrasena-olvidada";
            require("view/contrasena-olvidada.php");
        }
        /**
         * comprueba el login
         *
         * @return void
         */
        public function comprobarLogin(){
            
            $username = $_POST["usuario"];
            $password = $_POST["pass"];

            $aux = str_replace("index.php/check-login", "",$_SERVER["REQUEST_URI"]);
            
            if($this->db->comprobarLogin($username, $password)){
                
                $_SESSION["admin"] = "YES";
                $nombre = $this->db->nombreUsuario($username);
                $_SESSION["usuario"] = $nombre;
                $ruta = "http://" . $_SERVER["HTTP_HOST"] . $aux . "index.php/panel-administracion";
                echo $ruta;

                header("Location: $ruta");
            }else{
                $ruta = "http://" . $_SERVER["HTTP_HOST"] . $aux . "index.php";
                header("Location: $ruta");
            }
        }
        /**
         * lleva al panel de administracion
         *
         * @return void
         */
        public function panelAdministracion(){
            $rutaListaBares = "http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/lista-bares";
            $rutaListaPinchos = "http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/lista-pinchos";
            $rutaListaUsuarios = "http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/lista-usuarios";
            
            require("view/panel-administracion.php");
        }

    }

?>