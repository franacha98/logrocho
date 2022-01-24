<?php
    //include "repository/bdd.php";

    class UsuariosController{

        private $db;

        function __construct()
        {
            $this->db = new BBDD();
        }

    }

?>