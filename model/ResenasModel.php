<?php
    class Resena{

        private $cod_valoracion;
        private $usuario;
        private $pincho;
        private $comentario;
        private $likes;

        public function __construct($cod_valoracion, $usuario, $pincho, $comentario, $likes)
        {
            $this->cod_valoracion = $cod_valoracion;
            $this->usuario = $usuario;
            $this->pincho = $pincho;
            $this->comentario = $comentario;
            $this->likes = $likes;
        }

        /**
         * Get the value of cod_valoracion
         */ 
        public function getCod_valoracion()
        {
                return $this->cod_valoracion;
        }

        /**
         * Set the value of cod_valoracion
         *
         * @return  self
         */ 
        public function setCod_valoracion($cod_valoracion)
        {
                $this->cod_valoracion = $cod_valoracion;

                return $this;
        }

        /**
         * Get the value of usuario
         */ 
        public function getUsuario()
        {
                return $this->usuario;
        }

        /**
         * Set the value of usuario
         *
         * @return  self
         */ 
        public function setUsuario($usuario)
        {
                $this->usuario = $usuario;

                return $this;
        }

        /**
         * Get the value of pincho
         */ 
        public function getPincho()
        {
                return $this->pincho;
        }

        /**
         * Set the value of pincho
         *
         * @return  self
         */ 
        public function setPincho($pincho)
        {
                $this->pincho = $pincho;

                return $this;
        }

        /**
         * Get the value of comentario
         */ 
        public function getComentario()
        {
                return $this->comentario;
        }

        /**
         * Set the value of comentario
         *
         * @return  self
         */ 
        public function setComentario($comentario)
        {
                $this->comentario = $comentario;

                return $this;
        }

        /**
         * Get the value of likes
         */ 
        public function getLikes()
        {
                return $this->likes;
        }

        /**
         * Set the value of likes
         *
         * @return  self
         */ 
        public function setLikes($likes)
        {
                $this->likes = $likes;

                return $this;
        }
    }
?>