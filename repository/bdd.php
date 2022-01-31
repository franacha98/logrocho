<?php
class BBDD
{
    private $DB_INFO;
    private $DB_USER;
    private $DB_PASS;
    private $conexion;

    public function __construct()
    {
        $this->DB_INFO = 'mysql:host=localhost;dbname=logrocho';
        $this->DB_USER = 'root';
        $this->DB_PASS = '';
        $this->conexion = new PDO($this->DB_INFO, $this->DB_USER, $this->DB_PASS);
    }
    /**
     * Comprueba el login para un usuario y contraseña
     *
     * @param [string] $usuario
     * @param [string] $passwd
     * @return void
     */
    public function comprobarLogin($usuario, $passwd)
    {
        try {
            $sql = "SELECT * FROM usuarios WHERE usuario=:user AND contrasena=:pass;";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute(array("user" => $usuario, "pass" => $passwd));

            $num = $stmt->rowCount();

            if ($num == 0) {
                return false;
            } else {
                return true;
            }
        } catch (PDOException $e) {
            echo "Error con la DB: " . $e->getMessage();
        }
    }
    /**
     * Devuelve el nombre de un usuario para añadirlo a la sesion
     *
     * @param [string] $usuario
     * @return string
     */
    public function nombreUsuario($usuario){
        try {
            $sql = "SELECT nombre FROM usuarios WHERE usuario=:user";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute(array("user" => $usuario));

            $usuarios = array();
            foreach ($stmt as $bar) {
                $aux = $bar["nombre"];
                array_push($usuarios, $aux);
            }
            return $usuarios[0];
        } catch (PDOException $e) {
            echo "Error con la DB: " . $e->getMessage();
        }
    }

    /**
     * Lista todas las reseñas
     *
     * @return void
     */
    public function listaResenas()
    {
        try {
            $sql = "SELECT * FROM valoraciones;";
            $resultado = $this->conexion->query($sql);
            $valoraciones = array();
            foreach ($resultado as $aux) {
                $valoracion = new Resena($aux["cod_valoracion"], $aux["usuario"], $aux["pincho"], $aux["comentario"], $aux["likes"]);
                array_push($valoraciones, $valoracion);
            }
            return $valoraciones;
        } catch (PDOException $e) {
            echo "Error con la DB: " . $e->getMessage();
        }
    }
    /**
     * JSON con todas las reseñas
     *
     * @param [int] $limit
     * @param [int] $num
     * @return void
     */
    public function listaResenaJson($limit, $num)
    {
        try {
            $sql = "SELECT * FROM valoraciones LIMIT $limit, $num;";
            $resultado = $this->conexion->query($sql);        
            $valoraciones = array();
            foreach ($resultado as $aux) {
                array_push($valoraciones, $aux);
            }
            return $valoraciones;
        } catch (PDOException $e) {
            echo "Error con la DB: " . $e->getMessage();
        }
    }
    /**
     * Lista todos los usuarios
     *
     * @return void
     */
    public function listaUsuarios()
    {
        try {
            $sql = "SELECT * FROM usuarios;";
            $resultado = $this->conexion->query($sql);
            $usuarios = array();
            foreach ($resultado as $aux) {
                $usuario = new Usuario($aux["usuario"], $aux["contrasena"], $aux["admin"], $aux["nombre"]);
                array_push($usuarios, $usuario);
            }
            return $usuarios;
        } catch (PDOException $e) {
            echo "Error con la DB: " . $e->getMessage();
        }
    }
    /**
     * Lista formato JSON de todos los usuarios
     *
     * @param [int] $limit
     * @param [int] $num
     * @return void
     */
    public function listaUsuariosJson($limit, $num)
    {
        try {
            $sql = "SELECT * FROM usuarios LIMIT $limit, $num;";
            $resultado = $this->conexion->query($sql);        
            $usuarios = array();
            foreach ($resultado as $aux) {
                $usuario = new Usuario($aux["usuario"], $aux["contrasena"], $aux["admin"], $aux["nombre"]);
                array_push($usuarios, $aux);
            }
            return $usuarios;
            //echo json_encode($bares);
        } catch (PDOException $e) {
            echo "Error con la DB: " . $e->getMessage();
        }
    }
    /**
     * añade una nueva reseña
     *
     * @param [string] $usuario
     * @param [int] $pincho
     * @param [string] $comentario
     * @param [int] $likes
     * @return void
     */
    public function anadirResena($usuario, $pincho, $comentario, $likes)
    {
        try {

            $this->conexion->beginTransaction();

            $sql = "INSERT INTO valoraciones (usuario, pincho, comentario, likes) VALUES ('$usuario', '$pincho', '$comentario', '$likes')";
            
            $resultado = $this->conexion->query($sql);

            if (!$resultado) {
                echo print_r($this->conexion->errorInfo());
                $this->conexion->rollBack();
                return false;
            }


            $this->conexion->commit();
            return true;
        } catch (PDOException $e) {
            echo "Error con la DB: " . $e->getMessage();
        }
    }
    /**
     * Aañded un nuevo pincho
     *
     * @param [string] $nombre
     * @param [string] $descripcion
     * @param [float] $precio
     * @param [int] $bar
     * @return void
     */
    public function anadirPincho($nombre, $descripcion, $precio, $bar)
    {
        try {

            $this->conexion->beginTransaction();

            $sql = "INSERT INTO pinchos (nombre, descripcion, bar, precio) VALUES ('$nombre', '$descripcion', '$bar', '$precio')";
            //echo $sql;
            $resultado = $this->conexion->query($sql);

            if (!$resultado) {
                echo print_r($this->conexion->errorInfo());
                $this->conexion->rollBack();
                return false;
            }


            $this->conexion->commit();
            return true;
        } catch (PDOException $e) {
            echo "Error con la DB: " . $e->getMessage();
        }
    }
    /**
     * elimina un pincho
     *
     * @param [int] $cod_pincho
     * @return void
     */
    public function eliminarPincho($cod_pincho){
        try {
            $sql = "DELETE FROM pinchos WHERE cod_pincho=$cod_pincho";
            $result = $this->conexion->query($sql);
            echo $sql;
        } catch (PDOException $e) {
            echo "Error con la DB: " . $e->getMessage();
        }
    }
    /**
     * Elimina una reseña
     *
     * @param [int] $cod_valoracion
     * @return void
     */
    public function eliminarResena($cod_valoracion){
        try {
            $sql = "DELETE FROM valoraciones WHERE cod_valoracion=$cod_valoracion";
            $result = $this->conexion->query($sql);
        } catch (PDOException $e) {
            echo "Error con la DB: " . $e->getMessage();
        }
    }
    /**
     * devuelve todos los pinchos
     *
     * @return void
     */
    public function listaPinchos()
    {
        try {
            $sql = "SELECT * FROM pinchos;";
            $resultado = $this->conexion->query($sql);
            $pinchos = array();
            foreach ($resultado as $aux) {
                $pincho = new Pincho($aux["cod_pincho"], $aux["nombre"], $aux["descripcion"], $aux["precio"], $aux["bar"]);
                array_push($pinchos, $pincho);
            }
            return $pinchos;
        } catch (PDOException $e) {
            echo "Error con la DB: " . $e->getMessage();
        }
    }
    /**
     * Devuelve todos los pinchos en formato JSON
     *
     * @param [int] $limit
     * @param [int] $num
     * @return void
     */
    public function listaPinchosJson($limit, $num)
    {
        try {
            $sql = "SELECT * FROM pinchos LIMIT $limit, $num;";
            $resultado = $this->conexion->query($sql);        
            $pinchos = array();
            foreach ($resultado as $aux) {
                $pincho = new Pincho($aux["cod_pincho"], $aux["nombre"], $aux["descripcion"], $aux["precio"], $aux["bar"]);
                array_push($pinchos, $aux);
            }
            return $pinchos;
            //echo json_encode($bares);
        } catch (PDOException $e) {
            echo "Error con la DB: " . $e->getMessage();
        }
    }
    /**
     * Recupera los datos de un pincho con un ID dado
     *
     * @param [int] $cod_pincho
     * @return void
     */
    public function recuperarPincho($cod_pincho)
    {
        try {
            $sql = "SELECT * FROM pinchos WHERE cod_pincho=:cod;";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute(array("cod" => $cod_pincho));
            $pinchos = array();
            foreach ($stmt as $bar) {
                $aux = new Pincho($bar["cod_pincho"], $bar["nombre"], $bar["descripcion"], $bar["precio"], $bar["bar"]);
                array_push($pinchos, $aux);
            }
            return $pinchos[0];
        } catch (PDOException $e) {
            echo "Error con la DB: " . $e->getMessage();
        }
    }
    /**
     * Recupera una reseña con un id dado
     *
     * @param [int] $cod_valoracion
     * @return void
     */
    public function recuperarResena($cod_valoracion)
    {
        try {
            $sql = "SELECT * FROM valoraciones WHERE cod_valoracion=:cod;";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute(array("cod" => $cod_valoracion));
            $valoraciones = array();
            foreach ($stmt as $bar) {
                $aux = new Resena($bar["cod_valoracion"], $bar["usuario"], $bar["pincho"], $bar["comentario"], $bar["likes"]);
                array_push($valoraciones, $aux);
            }
            return $valoraciones[0];
        } catch (PDOException $e) {
            echo "Error con la DB: " . $e->getMessage();
        }
    }

    /**
     * Recupera un usuario con un correo dado
     *
     * @param [string] $correo
     * @return void
     */
    public function recuperarUsuario($correo)
    {
        try {
            $sql = "SELECT * FROM usuarios WHERE usuario=:cod;";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute(array("cod" => $correo));
            $usuarios = array();
            foreach ($stmt as $usuario) {
                $aux = new Usuario($usuario["usuario"], $usuario["contrasena"], $usuario["admin"], $usuario["nombre"]);
                array_push($usuarios, $aux);
            }
            return $usuarios[0];
        } catch (PDOException $e) {
            echo "Error con la DB: " . $e->getMessage();
        }
    }
    /**
     * Añade un nuevo usuario
     *
     * @param [string] $usuario
     * @param [string] $contrasena
     * @param [bool] $admin
     * @param [string] $nombre
     * @return void
     */
    public function anadirUsuario($usuario, $contrasena, $admin, $nombre)
    {
        try {

            $this->conexion->beginTransaction();

            $sql = "INSERT INTO usuarios (usuario, contrasena, admin, nombre) VALUES ('$usuario', '$contrasena', '$admin', '$nombre')";
            echo $sql;
            $resultado = $this->conexion->query($sql);

            if (!$resultado) {
                echo print_r($this->conexion->errorInfo());
                $this->conexion->rollBack();
                return false;
            }


            $this->conexion->commit();
            return true;
        } catch (PDOException $e) {
            echo "Error con la DB: " . $e->getMessage();
        }
    }
    /**
     * modifica un usuario
     *
     * @param [string] $usuario
     * @param [string] $contrasena
     * @param [bool] $admin
     * @param [string] $nombre
     * @return void
     */
    public function modificarUsuario($usuario, $contrasena, $admin, $nombre){
        try {      
            $sql = "UPDATE usuarios SET nombre='$nombre', usuario='$usuario', admin='$admin', contrasena='$contrasena' WHERE usuario='$usuario'";
            echo $sql;
            $resultado = $this->conexion->query($sql);
        } catch (PDOException $e) {
            echo "Error con la DB: " . $e->getMessage();
        }
    }
    /**
     * elimina un usuario
     *
     * @param [string] $usuario
     * @return void
     */
    public function eliminarUsuario($usuario){
        try {
            $sql = "DELETE FROM usuarios WHERE usuario='$usuario'";
            $result = $this->conexion->query($sql);
            echo $sql;
        } catch (PDOException $e) {
            echo "Error con la DB: " . $e->getMessage();
        }
    }
    /**
     * modifica un pincho
     *
     * @param [int] $cod_pincho
     * @param [string] $nombre
     * @param [string] $descripcion
     * @param [float] $precio
     * @param [int] $bar
     * @return void
     */
    public function modificarPincho($cod_pincho, $nombre, $descripcion, $precio, $bar){
        try {      
            $sql = "UPDATE pinchos SET nombre='$nombre', descripcion='$descripcion', precio='$precio', bar='$bar' WHERE cod_pincho=$cod_pincho";
            echo $sql;
            $resultado = $this->conexion->query($sql);
        } catch (PDOException $e) {
            echo "Error con la DB: " . $e->getMessage();
        }
    }
    /**
     * modifica una reseña
     *
     * @param [int] $cod_valoracion
     * @param [string] $usuario
     * @param [int] $pincho
     * @param [string] $comentario
     * @param [int] $likes
     * @return void
     */
    public function modificarResena($cod_valoracion, $usuario, $pincho, $comentario, $likes){
        try {      
            $sql = "UPDATE valoraciones SET usuario='$usuario', pincho='$pincho', comentario='$comentario', likes='$likes' WHERE cod_valoracion=$cod_valoracion";
            echo $sql;
            $resultado = $this->conexion->query($sql);
        } catch (PDOException $e) {
            echo "Error con la DB: " . $e->getMessage();
        }
    }
    /**
     * añade un nuevo bar
     *
     * @param [string] $nombre
     * @param [double] $latitud
     * @param [double] $longitud
     * @return void
     */
    public function anadirBar($nombre, $latitud, $longitud)
    {
        try {

            $this->conexion->beginTransaction();

            $sql = "INSERT INTO bares (nombre, latitud, longitud) VALUES ('$nombre', '$latitud', '$longitud')";
            echo $sql;
            $resultado = $this->conexion->query($sql);

            if (!$resultado) {
                echo print_r($this->conexion->errorInfo());
                $this->conexion->rollBack();
                return false;
            }


            $this->conexion->commit();
            return true;
        } catch (PDOException $e) {
            echo "Error con la DB: " . $e->getMessage();
        }
    }
    /**
     * lista todos los bares
     *
     * @return void
     */
    public function listaBares()
    {
        try {
            $sql = "SELECT * FROM bares;";
            $resultado = $this->conexion->query($sql);
            $bares = array();
            foreach ($resultado as $aux) {
                $bar = new Bar($aux["cod_bar"], $aux["nombre"], $aux["latitud"], $aux["longitud"]);
                array_push($bares, $bar);
            }
            return $bares;
        } catch (PDOException $e) {
            echo "Error con la DB: " . $e->getMessage();
        }
    }
    /**
     * Formato JSON de la lista de todos los bares
     *
     * @param [int] $limit
     * @param [int] $num
     * @return void
     */
    public function listaBaresJson($limit, $num)
    {
        try {
            $sql = "SELECT * FROM bares LIMIT $limit, $num;";
            $resultado = $this->conexion->query($sql);        
            $bares = array();
            foreach ($resultado as $aux) {
                $bar = new Bar($aux["cod_bar"], $aux["nombre"], $aux["latitud"], $aux["longitud"]);
                array_push($bares, $aux);
            }
            return $bares;
            //echo json_encode($bares);
        } catch (PDOException $e) {
            echo "Error con la DB: " . $e->getMessage();
        }
    }
    /**
     * recupera informacion de un bar especifico mediante el id
     *
     * @param [int] $cod_bar
     * @return void
     */
    public function recuperarBar($cod_bar)
    {
        try {
            $sql = "SELECT * FROM bares WHERE cod_bar=:cod;";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute(array("cod" => $cod_bar));
            $bares = array();
            foreach ($stmt as $bar) {
                $aux = new Bar($bar["cod_bar"], $bar["nombre"], $bar["latitud"], $bar["longitud"]);
                array_push($bares, $aux);
            }
            return $bares[0];
        } catch (PDOException $e) {
            echo "Error con la DB: " . $e->getMessage();
        }
    }
    /**
     * elimina un bar especifico
     *
     * @param [int] $cod_bar
     * @return void
     */
    public function eliminarBar($cod_bar){
        try {
            $sql = "DELETE FROM bares WHERE cod_bar=$cod_bar";
            $result = $this->conexion->query($sql);
            echo $sql;
        } catch (PDOException $e) {
            echo "Error con la DB: " . $e->getMessage();
        }
    }
    /**
     * modifica un bar especifico
     *
     * @param [int] $cod_bar
     * @param [string] $nombre
     * @param [double] $latitud
     * @param [double] $longitud
     * @return void
     */
    public function modificarBar($cod_bar, $nombre, $latitud, $longitud){
        try {      
            $sql = "UPDATE bares SET nombre='$nombre', latitud='$latitud', longitud='$longitud' WHERE cod_bar=$cod_bar";
            echo $sql;
            $resultado = $this->conexion->query($sql);
        } catch (PDOException $e) {
            echo "Error con la DB: " . $e->getMessage();
        }
    }



}
