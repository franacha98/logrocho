<?php
    class Usuario{

        private $correo;
        private $contrasena;
        private $admin;
        private $nombre;
        
        function __construct($correo, $contrasena, $admin = false, $nombre)
        {
            $this->correo = $correo;
            $this->contrasena = $contrasena;
            $this->admin = $admin;   
            $this->nombre = $nombre;         
        }        

        /**
         * Get the value of correo
         */ 
        public function getCorreo()
        {
                return $this->correo;
        }

        /**
         * Set the value of correo
         *
         * @return  self
         */ 
        public function setCorreo($correo)
        {
                $this->correo = $correo;

                return $this;
        }

        /**
         * Get the value of contrasena
         */ 
        public function getContrasena()
        {
                return $this->contrasena;
        }

        /**
         * Set the value of contrasena
         *
         * @return  self
         */ 
        public function setContrasena($contrasena)
        {
                $this->contrasena = $contrasena;

                return $this;
        }

        /**
         * Get the value of admin
         */ 
        public function getAdmin()
        {
                return $this->admin;
        }

        /**
         * Set the value of admin
         *
         * @return  self
         */ 
        public function setAdmin($admin)
        {
                $this->admin = $admin;

                return $this;
        }

        /**
         * Get the value of nombre
         */ 
        public function getNombre()
        {
                return $this->nombre;
        }

        /**
         * Set the value of nombre
         *
         * @return  self
         */ 
        public function setNombre($nombre)
        {
                $this->nombre = $nombre;

                return $this;
        }
    }
?>