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
            $rutaRegistro = "http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/registro";
            require("view/index.php");
        }

        public function registro(){
            $rutaRegistro = "http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/controlar-registro";

            require("view/formulario-registro.php");
        }

        public function controlRegistro(){
            $usuario = $_POST["usuario"];
            $pass = $_POST["pass"];
            $nombre = $_POST["nombre"];

            $registroOK = $this->db->registrarUsuario($nombre, $usuario, $pass);
            $ruta = "";

            if($registroOK){
                $_SESSION["usuario"] = $nombre;
                $_SESSION["idusuario"] = $usuario;
                $_SESSION["admin"] = "NO";
                $ruta = "http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/inicio";               
            }else{
                $ruta = "http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/registro";  
            }  

            header("Location: $ruta");
        }

        public function cerrarSesion(){
            unset($_SESSION["admin"]);
            unset($_SESSION["usuario"]);
            unset($_SESSION["idusuario"]);
            session_destroy();

            $ruta = "http://" . $_SERVER["HTTP_HOST"]."/logrocho/index.php";
            header("Location: $ruta");
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
                              
                $nombre = $this->db->nombreUsuario($username);
                $esAdmin = $this->db->esAdmin($username);
                $_SESSION["usuario"] = $nombre;
                $_SESSION["idusuario"] = $username;
                $ruta = "";
                if($esAdmin == 1){
                    $_SESSION["admin"] = "YES";
                    $ruta = "http://" . $_SERVER["HTTP_HOST"] . $aux . "index.php/panel-administracion";
                }else{
                    $_SESSION["admin"] = "NO";
                    $ruta = "http://" . $_SERVER["HTTP_HOST"] . $aux . "index.php/inicio";
                }

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
            $rutaListaResenas = "http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/lista-resenas";
            require("view/panel-administracion.php");
        }

        public function homePublica(){
            $rutaListaBares = "http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/lista-bares";
            $rutaListaPinchos = "http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/lista-pinchos";
            $rutaListaUsuarios = "http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/lista-usuarios";
            $rutaListaResenas = "http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/lista-resenas";
            require("view/home-publica.php");
        }
    }

?>