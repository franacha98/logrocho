<?php
    class Bar{

        private $cod_bar;
        private $nombre;
        private $latitud;
        private $longitud;
        private $pinchos;

        function __construct($cod_bar, $nombre, $latitud, $longitud, $pinchos = null)
        {
            $this->cod_bar = $cod_bar;
            $this->nombre = $nombre;
            $this->latitud = $latitud;
            $this->longitud = $longitud;
            $this->pinchos = $pinchos;
        }

        /**
         * Get the value of cod_bar
         */ 
        public function getCod_bar()
        {
                return $this->cod_bar;
        }

        /**
         * Set the value of cod_bar
         *
         * @return  self
         */ 
        public function setCod_bar($cod_bar)
        {
                $this->cod_bar = $cod_bar;

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
         * Get the value of latitud
         */ 
        public function getLatitud()
        {
                return $this->latitud;
        }

        /**
         * Set the value of latitud
         *
         * @return  self
         */ 
        public function setLatitud($latitud)
        {
                $this->latitud = $latitud;

                return $this;
        }

        /**
         * Get the value of longitud
         */ 
        public function getLongitud()
        {
                return $this->longitud;
        }

        /**
         * Set the value of longitud
         *
         * @return  self
         */ 
        public function setLongitud($longitud)
        {
                $this->longitud = $longitud;

                return $this;
        }

        /**
         * Get the value of pinchos
         */ 
        public function getPinchos()
        {
                return $this->pinchos;
        }

        /**
         * Set the value of pinchos
         *
         * @return  self
         */ 
        public function setPinchos($pinchos)
        {
                $this->pinchos = $pinchos;

                return $this;
        }
    }
?>