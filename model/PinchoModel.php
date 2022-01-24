<?php
    class Pincho{

        private $cod_pincho;
        private $nombre;
        private $descripcion;
        private $precio;
        private $bar;

        function __construct($cod_pincho, $nombre, $descripcion, $precio, $bar)
        {
            $this->cod_pincho = $cod_pincho;
            $this->nombre = $nombre;
            $this->descripcion = $descripcion;
            $this->precio = $precio;
            $this->bar = $bar;
        }

        /**
         * Get the value of cod_pincho
         */ 
        public function getCod_pincho()
        {
                return $this->cod_pincho;
        }

        /**
         * Set the value of cod_pincho
         *
         * @return  self
         */ 
        public function setCod_pincho($cod_pincho)
        {
                $this->cod_pincho = $cod_pincho;

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

        /**
         * Get the value of descripcion
         */ 
        public function getDescripcion()
        {
                return $this->descripcion;
        }

        /**
         * Set the value of descripcion
         *
         * @return  self
         */ 
        public function setDescripcion($descripcion)
        {
                $this->descripcion = $descripcion;

                return $this;
        }

        /**
         * Get the value of precio
         */ 
        public function getPrecio()
        {
                return $this->precio;
        }

        /**
         * Set the value of precio
         *
         * @return  self
         */ 
        public function setPrecio($precio)
        {
                $this->precio = $precio;

                return $this;
        }

        /**
         * Get the value of bar
         */ 
        public function getBar()
        {
                return $this->bar;
        }

        /**
         * Set the value of bar
         *
         * @return  self
         */ 
        public function setBar($bar)
        {
                $this->bar = $bar;

                return $this;
        }
    }
?>