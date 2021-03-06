<?php
    //include "repository/bdd.php";

    class UsuariosController{

        private $db;

        function __construct()
        {
            $this->db = new BBDD();
        }
        /**
         * lista todos los usuarios
         *
         * @return void
         */
        public function listaUsuarios(){
            $lista = $this->db->listaUsuarios();

            $rutaAnadir = "http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/anadir-usuario-vista";
            require("view/lista-usuarios.php");
        }
        /**
         * lista todos los usuarios en formato json
         *
         * @param [int] $limit
         * @param [int] $num
         * @return void
         */
        public function listaUsuariosJson($limit, $num){
            $usuarios = $this->db->listaUsuariosJson($limit, $num);
            
            echo json_encode($usuarios);
        }
        /**
         * informacion de un usuario en formato json
         *
         * @param [type] $correo
         * @return void
         */
        public function usuarioJson($correo){
            $usuario = $this->db->recuperarUsuario($correo);

            echo json_encode($usuario);
        }
        /**
         * muestra el formulario para añadir un nuevo usuario
         *
         * @return void
         */
        public function anadirUsuarioVista(){
            $rutaAnadirUsuario = "http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/anadir-usuario";

            require("view/anadir-usuario-form.php");
        }
        /**
         * añade un nuevo usuario
         *
         * @return void
         */
        public function anadirUsuario(){
            $rutaAnadirUsuario = "http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/anadir-usuario";
            $this->db->anadirUsuario($_POST["usuario"], $_POST["contrasena"], $_POST["admin"], $_POST["nombre"]);

            header("Location: http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/anadir-usuario-vista");
        }
        /**
         * informacion de un usuario
         *
         * @param [string] $usuario
         * @return void
         */
        public function fichaUsuario($usuario){
            $usu = $this->db->recuperarUsuario($usuario);
            
            $rutaEliminar = "http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/eliminar-usuario/" . $usuario;
            $rutaModificar = "http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/modificar-usuario";
            require("view/ficha-usuario.php");
        }
        /**
         * modifica un usuario
         *
         * @return void
         */
        public function modificarUsuario(){
            $usuario = $_POST["correo"];
            $admin = $_POST["admin"];
            $nombre = $_POST["nombre"];

            $this->db->modificarUsuario($usuario, $admin, $nombre);

            header("Location: http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/ficha-usuario/" . $_POST["correo"]);
        }
        /**
         * elimina un usuario
         *
         * @param [string] $usuario
         * @return void
         */
        public function eliminarUsuario($usuario){
            $rutaAnadirUsuario = "http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/anadir-usuario";
            $this->db->eliminarUsuario($usuario);

            header("Location: http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/lista-usuarios");
        }


        public function zonaUsuario($flag){
            $modificando = false;

            if($flag == "1"){
                $modificando = true;
            }

            $nombre = $_SESSION["usuario"];
            $username = $_SESSION["idusuario"];
            $usuario = $this->db->recuperarUsuario($username);
            $rutaModificar = "http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/zona-usuario/1";

            $pinchos = $this->db->recuperarPinchosValoradosDeUsuario($username);
            $lista = array();
            for($i = 0; $i < count($pinchos); $i++){ 
                $aux = $this->db->recuperarPincho($pinchos[$i]["cod_pincho"]);
                $mini = $this->db->obtenerPrimeraImagenPincho($aux->getCod_pincho());
                if ($mini == null) {
                    $mini = "resources/media/logo-logrocho.png";
                }
                $aux->setMiniatura($mini);
                array_push($lista, $aux);
            }


            $resenas = $this->db->recuperarResenasDeUsuario($username);
                // me quedo aqui
            
            $rutaEliminar = "http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/eliminar-resena/";
            $rutaPincho = "http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/pincho/";
            if($modificando){
                require("view/zona-usuario-modificar.php");
            }else{
                require("view/zona-usuario.php");
            }
            
        }

        

    }

?>