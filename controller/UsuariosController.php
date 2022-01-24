<?php
    //include "repository/bdd.php";

    class UsuariosController{

        private $db;

        function __construct()
        {
            $this->db = new BBDD();
        }

        public function listaUsuarios(){
            $lista = $this->db->listaUsuarios();

            $rutaAnadir = "http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/anadir-usuario-vista";
            require("view/lista-usuarios.php");
        }

        public function listaUsuariosJson($limit, $num){
            $usuarios = $this->db->listaUsuariosJson($limit, $num);
            
            echo json_encode($usuarios);
        }

        public function usuarioJson($correo){
            $usuario = $this->db->recuperarUsuario($correo);

            echo json_encode($usuario);
        }

        public function anadirUsuarioVista(){
            $rutaAnadirUsuario = "http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/anadir-usuario";

            require("view/anadir-usuario-form.php");
        }

        public function anadirUsuario(){
            $rutaAnadirUsuario = "http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/anadir-usuario";
            $this->db->anadirUsuario($_POST["usuario"], $_POST["contrasena"], $_POST["admin"], $_POST["nombre"]);

            header("Location: http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/anadir-usuario-vista");
        }
        
        public function fichaUsuario($usuario){
            $usu = $this->db->recuperarUsuario($usuario);
            
            $rutaEliminar = "http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/eliminar-usuario/" . $usuario;
            $rutaModificar = "http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/modificar-usuario";
            require("view/ficha-usuario.php");
        }

        public function modificarUsuario(){
            $usuario = $_POST["usuario"];
            $contrasena = $_POST["contrasena"];
            $admin = $_POST["admin"];
            $nombre = $_POST["nombre"];

            $this->db->modificarUsuario($usuario, $contrasena, $admin, $nombre);

            header("Location: http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/ficha-usuario/" . $usuario);
        }

        public function eliminarUsuario($usuario){
            $rutaAnadirUsuario = "http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/anadir-usuario";
            $this->db->eliminarUsuario($usuario);

            header("Location: http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/lista-usuarios");
        }
    }

?>