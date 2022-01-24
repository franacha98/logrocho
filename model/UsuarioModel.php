<?php
    class Usuario{

        private $correo;
        private $contrasena;
        private $admin;

        function __construct($correo, $contrasena, $admin = false)
        {
            $this->correo = $correo;
            $this->contrasena = $contrasena;
            $this->admin = $admin;            
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
    }
?>