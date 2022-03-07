<?php
//include "repository/bdd.php";

class BaresController
{

    private $db;

    function __construct()
    {
        $this->db = new BBDD();
    }
    /**
     * Lista con todos los bares para la vista
     *
     * @return void
     */
    public function listaBares()
    {
        $lista = $this->db->listaBares();

        $rutaAnadir = "http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/anadir-bar-vista";
        require("view/lista-bares.php");
    }

    public function listaBaresPublico()
    {
        $lista = $this->db->listaBares();

        for ($i = 0; $i < count($lista); $i++) {
            $mini = $this->db->obtenerPrimeraImagenBar($lista[$i]->getCod_bar());
            if ($mini == null) {
                $mini = "resources/media/logo-logrocho.png";
            }
            $lista[$i]->setMiniatura($mini);

            $aux_fotos = $this->db->recuperarFotosBar($lista[$i]->getCod_bar());
            $aux = $this->db->puntuacionBar($lista[$i]->getCod_bar());
            $nota = $aux["nota"];
            $votos = $aux["votos"];
            if($votos != null && $votos != 0){
                $puntuacion = round($nota / $votos, 2);
            }
            //$puntuacion = round($nota / $votos, 2);
            $estrellaCheck = "<span class='fa fa-star checked'></span>  ";
            $estrella = "<span class='fa fa-star'></span>  ";

            if($nota == null || $votos == null){
                $lista[$i]->setPuntuacion(0);
            }else{
                $lista[$i]->setPuntuacion($puntuacion);
            }
            

            $pEspecialidad = $this->db->especialidadBar($lista[$i]->getCod_bar());
            $especialidad = $this->db->recuperarPincho($pEspecialidad["pincho"]);
            $lista[$i]->setEspecialidad($especialidad);
        }




        $rutaAnadir = "http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/anadir-bar-vista";
        require("view/bares-publico.php");
    }

    /**
     * muestra el formulario para añadir un bar nuevo
     *
     * @return void
     */
    public function anadirBarVista()
    {
        $rutaAnadirBar = "http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/anadir-bar";

        require("view/anadir-bar-form.php");
    }
    /**
     * añade un nuevo bar
     *
     * @return void
     */
    public function anadirBar()
    {
        $rutaAnadirBar = "http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/anadir-bar";
        $this->db->anadirBar($_POST["nombre"], $_POST["latitud"], $_POST["longitud"]);

        $cod_bar = $this->db->recuperarBarNombre($_POST["nombre"]);
        //echo $cod_bar;
        //var_dump($_FILES);
        $countfiles = count($_FILES['file']['name']);
        //echo $countfiles;
        $fotos_bar = array();
        $rutaBase = file_get_contents("config.txt");
        echo $rutaBase;
        $rutaFotos = $rutaBase . "\\img_bares\\" . $cod_bar;
        for ($i = 0; $i < $countfiles; $i++) {
            $filename = $_FILES['file']['name'][$i];
            array_push($fotos_bar, $filename);
            if (!file_exists($rutaFotos . $filename)) {
                mkdir($rutaFotos, 0777, true);
            }
            move_uploaded_file($_FILES['file']['tmp_name'][$i], $rutaFotos . "\\" . $filename);
        }
        $this->db->anadirFotosBar($cod_bar, $fotos_bar);

        echo "http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/anadir-bar-vista";

        header("Location: http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/anadir-bar-vista");
    }

    /**
     * elimina un bar
     *
     * @param [int] $cod_bar
     * @return void
     */
    public function eliminarBar($cod_bar)
    {
        $rutaAnadirBar = "http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/anadir-bar";
        $this->db->eliminarBar($cod_bar);

        header("Location: http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/lista-bares");
    }
    /**
     * muestra la ficha de un bar
     *
     * @param [int] $cod_bar
     * @return void
     */
    public function fichaBar($cod_bar)
    {
        $bar = $this->db->recuperarBar($cod_bar);
        $aux_fotos = $this->db->recuperarFotosBar($cod_bar);

        $fotos = array();
        $ids = array();
        for ($i = 0; $i < count($aux_fotos); $i++) {
            array_push($fotos, $aux_fotos[$i]["ruta"]);
            array_push($ids, $aux_fotos[$i]["id"]);
        }

        $rutaEliminar = "http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/eliminar-bar/" . $bar->getCod_bar();
        $rutaModificar = "http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/modificar-bar";

        require("view/ficha-bar.php");
    }
    /**
     * carga datos para pintar la vista publica de la ficha de un bar en especifico
     *
     * @param [int] $cod_bar
     * @return void
     */
    public function barPublico($cod_bar)
    {
        $bar = $this->db->recuperarBar($cod_bar);
        $aux_fotos = $this->db->recuperarFotosBar($cod_bar);
        $aux = $this->db->puntuacionBar($cod_bar);
        $nota = $aux["nota"];
        $votos = $aux["votos"];
        $puntuacion = round($nota / $votos, 2);
        $estrellaCheck = "<span class='fa fa-star checked'></span>  ";
        $estrella = "<span class='fa fa-star'></span>  ";

        $especialidad = $this->db->especialidadBar($cod_bar);
        $pinchoEspecialidad = $this->db->recuperarPincho($especialidad["pincho"]);
        $puntosEspecialidad = $especialidad["puntos"];
        $pinchosDelBar = $this->db->recuperarPinchosDeBar($cod_bar);

        for($i = 0; $i < count($pinchosDelBar); $i++){
            $mini = $this->db->obtenerPrimeraImagenBar($pinchosDelBar[$i]->getCod_pincho());
            if ($mini == null) {
                $mini = "resources/media/logo-logrocho.png";
            }
            $pinchosDelBar[$i]->setMiniatura($mini);
        }

        $encodedName = urlencode($bar->getNombre());
        $rutaEspecialidad = "";
        if ($pinchoEspecialidad != null) {
            $rutaEspecialidad = "http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/pincho/" . $pinchoEspecialidad->getCod_pincho();
        }

        $fotos = array();
        $ids = array();
        for ($i = 0; $i < count($aux_fotos); $i++) {
            array_push($fotos, $aux_fotos[$i]["ruta"]);
            array_push($ids, $aux_fotos[$i]["id"]);
        }

        $rutaEliminar = "http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/eliminar-bar/" . $bar->getCod_bar();
        $rutaModificar = "http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/modificar-bar";

        require("view/bar.php");
    }

    /**
     * modifica un bar
     *
     * @return void
     */
    public function modificarBar()
    {
        $cod_bar = $_POST["cod_bar"];
        $nombre = $_POST["nombre"];
        $latitud = $_POST["latitud"];
        $longitud = $_POST["longitud"];

        $countfiles = count($_FILES['file']['name']);
        $fotos_bar = array();
        $rutaBase = file_get_contents("config.txt");
        echo $rutaBase;
        $rutaFotos = $rutaBase . "\\img_bares\\" . $cod_bar;
        for ($i = 0; $i < $countfiles; $i++) {
            $filename = $_FILES['file']['name'][$i];
            array_push($fotos_bar, $filename);
            if (!file_exists($rutaFotos . $filename)) {
                mkdir($rutaFotos, 0777, true);
            }
            move_uploaded_file($_FILES['file']['tmp_name'][$i], $rutaFotos . "\\" . $filename);
        }

        $this->db->modificarBar($cod_bar, $nombre, $latitud, $longitud);
        $this->db->anadirFotosBar($cod_bar, $fotos_bar);

        header("Location: http://" . $_SERVER["HTTP_HOST"] . "/logrocho/index.php/ficha-bar/" . $_POST["cod_bar"]);
    }
    /**
     * lista los bares en formato json
     *
     * @param [int] $limit
     * @param [int] $num
     * @return void
     */
    public function listaBaresJson($limit, $num)
    {
        $bares = $this->db->listaBaresJson($limit, $num);
        if($_SESSION["admin"]=="YES"){
            echo json_encode($bares);
        }else{
            $arraybares = array();
        for ($i = 0; $i < count($bares); $i++) {
            $codbar = $bares[$i]["cod_bar"];

            $puntuacion = $this->db->puntuacionBar($codbar)["nota"];


            $bar = new Bar($codbar, $bares[$i]["nombre"], $bares[$i]["latitud"], $bares[$i]["longitud"]);
            if ($puntuacion == null) {
                $puntuacion = 0;
            }
            $bar->setPuntuacion($puntuacion);

            $especialidadCode = $this->db->especialidadBar($codbar)["pincho"];
            $especialidad = $this->db->recuperarNombrePincho($especialidadCode);
            if ($especialidad == null) {
                $especialidad = "No tiene";
            }
            $bar->setEspecialidad($especialidad);

            array_push($arraybares, $bar);
            //$bares[$i]->setPuntuacion($puntuacion);
            //$bares[$i]->setEspecialidad($this->db->especialidadBar($codbar));
        }
        //var_dump($bares);
        echo json_encode($arraybares);
        }
    }
    /**
     * informacion de un bar en formato json
     *
     * @param [int] $cod_bar
     * @return void
     */
    public function barJson($cod_bar)
    {
        $bar = $this->db->recuperarBar($cod_bar);

        echo json_encode($bar);
    }
    /**
     * elimina la foto de un bar 
     *
     * @param [int] $id
     * @return void
     */
    public function eliminarFotoBar($id)
    {
        $ok = $this->db->eliminarFotoBar($id);

        if ($ok) {
            echo "OK";
        } else {
            echo "KO";
        }
    }
}
