<?php
class BBDD
{
    private $DB_INFO;
    private $DB_USER;
    private $DB_PASS;
    private $conexion;

    public function __construct()
    {
        $this->DB_INFO = 'mysql:host=' . $_SERVER["HTTP_HOST"] . ';dbname=logrocho;charset=utf8mb4';
        //$this->DB_INFO = 'mysql:host='. $_SERVER["HTTP_HOST"] .';dbname=franciscoociobin_logrocho;charset=utf8mb4';
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
    public function nombreUsuario($usuario)
    {
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
     * Comprueba si un usuario tiene permisos de administrador
     *
     * @param [string] $usuario
     * @return void
     */
    public function esAdmin($usuario)
    {
        try {
            $sql = "SELECT admin FROM usuarios WHERE usuario=:user";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute(array("user" => $usuario));

            $usuarios = array();
            foreach ($stmt as $bar) {
                $aux = $bar["admin"];
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
     * añade una nueva reseña
     *
     * @param [string] $usuario
     * @param [int] $pincho
     * @param [string] $comentario
     * @param [int] $likes
     * @return void
     */
    public function anadirResenaYPuntuacion($usuario, $pincho, $comentario, $puntos)
    {
        try {

            $this->conexion->beginTransaction();

            $sql = "INSERT INTO valoraciones (usuario, pincho, comentario, likes) VALUES ('$usuario', '$pincho', '$comentario', '0')";

            $resultado = $this->conexion->query($sql);

            if (!$resultado) {
                echo print_r($this->conexion->errorInfo());
                $this->conexion->rollBack();
                return false;
            }

            $sql2 = "INSERT INTO likes_pincho (usuario, pincho, nota) VALUES ('$usuario', '$pincho', '$puntos')";

            $resultado2 = $this->conexion->query($sql2);

            if (!$resultado2) {
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
    public function eliminarPincho($cod_pincho)
    {
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
    public function eliminarResena($cod_valoracion)
    {
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
            $sql = "SELECT pinchos.cod_pincho,pinchos.nombre as nombre,pinchos.descripcion,pinchos.precio,bares.nombre as bar FROM pinchos JOIN bares ON (pinchos.bar=bares.cod_bar) LIMIT $limit, $num;";

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
     * Obtiene el nombre de un pincho mediante su codigo
     *
     * @param [int] $cod_pincho
     * @return void
     */
    public function recuperarNombrePincho($cod_pincho)
    {
        try {
            $sql = "SELECT nombre FROM pinchos WHERE cod_pincho=:cod;";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute(array("cod" => $cod_pincho));
            $pinchos = array();
            foreach ($stmt as $bar) {
                $aux = $bar["nombre"];
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
     * Obtiene una lista con todas las reseñas de un pincho
     *
     * @param [int] $cod_pincho
     * @return void
     */
    public function resenasDePincho($cod_pincho)
    {
        try {
            $sql = "SELECT * FROM valoraciones WHERE pincho=:cod;";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute(array("cod" => $cod_pincho));
            $valoraciones = array();
            foreach ($stmt as $bar) {
                $aux = new Resena($bar["cod_valoracion"], $bar["usuario"], $bar["pincho"], $bar["comentario"], $bar["likes"]);
                array_push($valoraciones, $aux);
            }
            return $valoraciones;
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
     * Guarda un nuevo usuario en la base de datos, por defecto no será administrador, esto solo puede hacerlo un admin
     *
     * @param [string] $nombre
     * @param [string] $usuario
     * @param [string] $contrasena
     * @return void
     */
    public function registrarUsuario($nombre, $usuario, $contrasena)
    {
        try {

            $this->conexion->beginTransaction();

            $sql = "INSERT INTO usuarios (usuario, contrasena, admin, nombre) VALUES ('$usuario', '$contrasena', '0', '$nombre')";
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
    public function modificarUsuario($usuario, $admin, $nombre)
    {
        try {
            $sql = "UPDATE usuarios SET nombre='$nombre', usuario='$usuario', admin='$admin' WHERE usuario='$usuario'";
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
    public function eliminarUsuario($usuario)
    {
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
    public function modificarPincho($cod_pincho, $nombre, $descripcion, $precio, $bar)
    {
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
    public function modificarResena($cod_valoracion, $usuario, $pincho, $comentario, $likes)
    {
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
    public function eliminarBar($cod_bar)
    {
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
    public function modificarBar($cod_bar, $nombre, $latitud, $longitud)
    {
        try {
            $sql = "UPDATE bares SET nombre='$nombre', latitud='$latitud', longitud='$longitud' WHERE cod_bar=$cod_bar";
            echo $sql;
            $resultado = $this->conexion->query($sql);
        } catch (PDOException $e) {
            echo "Error con la DB: " . $e->getMessage();
        }
    }
    /**
     * Añade fotos a un pincho
     *
     * @param [int] $cod_pincho
     * @param [string array] $fotos
     * @return void
     */
    public function anadirFotosPincho($cod_pincho, $fotos)
    {
        try {
            $this->conexion->beginTransaction();
            $ruta = "resources/img_pinchos/" . $cod_pincho . "/";

            for ($i = 0; $i < count($fotos); $i++) {
                if ($fotos[$i] != "" && $fotos[$i] != null) {
                    $rutaCompleta = $ruta . "" . $fotos[$i];
                    $sql = "INSERT INTO fotos_pinchos (ruta, pincho) VALUES ('$rutaCompleta', '$cod_pincho')";
                    $resultado = $this->conexion->query($sql);
                    if (!$resultado) {

                        $this->conexion->rollBack();
                        return false;
                    }
                }
            }

            $this->conexion->commit();
            return true;
        } catch (PDOException $e) {
            echo "Error con la DB: " . $e->getMessage();
        }
    }
    /**
     * Añade fotos a un bar
     *
     * @param [int] $cod_bar
     * @param [string array] $fotos
     * @return void
     */
    public function anadirFotosBar($cod_bar, $fotos)
    {
        try {
            $this->conexion->beginTransaction();
            $ruta = "resources/img_bares/" . $cod_bar . "/";

            for ($i = 0; $i < count($fotos); $i++) {
                if ($fotos[$i] != "" && $fotos[$i] != null) {
                    $rutaCompleta = $ruta . "" . $fotos[$i];
                    $sql = "INSERT INTO fotos_bares (ruta, bar) VALUES ('$rutaCompleta', '$cod_bar')";
                    $resultado = $this->conexion->query($sql);
                    if (!$resultado) {
                        //echo print_r($this->conexion->errorInfo());
                        $this->conexion->rollBack();
                        return false;
                    }
                }
            }

            $this->conexion->commit();
            return true;
        } catch (PDOException $e) {
            echo "Error con la DB: " . $e->getMessage();
        }
    }
    /**
     * Obtiene todas las fotos de un bar
     *
     * @param [int] $cod_bar
     * @return void
     */
    public function recuperarFotosBar($cod_bar)
    {
        try {
            $sql = "SELECT id, ruta FROM fotos_bares WHERE bar=:cod;";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute(array("cod" => $cod_bar));
            $bares = array();
            foreach ($stmt as $bar) {
                $aux = array(
                    "id" => $bar["id"],
                    "ruta" => $bar["ruta"]
                );
                array_push($bares, $aux);
            }
            return $bares;
        } catch (PDOException $e) {
            echo "Error con la DB: " . $e->getMessage();
        }
    }
    /**
     * Obtiene todas las fotos de un pincho
     *
     * @param [int] $cod_pincho
     * @return void
     */
    public function recuperarFotosPincho($cod_pincho)
    {
        try {
            $sql = "SELECT id,ruta FROM fotos_pinchos WHERE pincho=:cod;";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute(array("cod" => $cod_pincho));
            $bares = array();
            foreach ($stmt as $bar) {
                $aux = array(
                    "id" => $bar["id"],
                    "ruta" => $bar["ruta"]
                );
                array_push($bares, $aux);
            }
            return $bares;
        } catch (PDOException $e) {
            echo "Error con la DB: " . $e->getMessage();
        }
    }
    /**
     * Obtiene los datos de un bar mediante su nombre, ya que el nombre es unico
     *
     * @param [int] $nombre
     * @return void
     */
    public function recuperarBarNombre($nombre)
    {
        try {
            $sql = "SELECT cod_bar FROM bares WHERE nombre=:cod;";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute(array("cod" => $nombre));
            $bares = array();
            foreach ($stmt as $bar) {
                $aux = $bar["cod_bar"];
                array_push($bares, $aux);
            }
            return $bares[0];
        } catch (PDOException $e) {
            echo "Error con la DB: " . $e->getMessage();
        }
    }
    /**
     * Obtiene los datos de un pincho mediante su nombre, ya que es unico
     *
     * @param [int] $nombre
     * @return void
     */
    public function recuperarPinchoNombre($nombre)
    {
        try {
            $sql = "SELECT cod_pincho FROM pinchos WHERE nombre=:cod;";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute(array("cod" => $nombre));
            $bares = array();
            foreach ($stmt as $bar) {
                $aux = $bar["cod_pincho"];
                array_push($bares, $aux);
            }
            return $bares[0];
        } catch (PDOException $e) {
            echo "Error con la DB: " . $e->getMessage();
        }
    }
    /**
     * Elimina la foto de un pincho
     *
     * @param [int] $id
     * @return void
     */
    public function eliminarFotoPincho($id)
    {
        try {
            $sql = "DELETE FROM fotos_pinchos WHERE id='$id'";
            $resultado = $this->conexion->query($sql);

            if (!$resultado) {
                $this->conexion->rollBack();
                return false;
            }
            return true;
        } catch (PDOException $e) {
            echo "Error con la DB: " . $e->getMessage();
        }
    }
    /**
     * ELimina la foto de un bar
     *
     * @param [int] $id
     * @return void
     */
    public function eliminarFotoBar($id)
    {
        try {
            $sql = "DELETE FROM fotos_bares WHERE id='$id'";
            $resultado = $this->conexion->query($sql);

            if (!$resultado) {
                $this->conexion->rollBack();
                return false;
            }
            return true;
        } catch (PDOException $e) {
            echo "Error con la DB: " . $e->getMessage();
        }
    }
    /**
     * Devuelve la puntuacion total de un bar (media de la puntuacion de todos sus pinchos)
     *
     * @param [int] $bar
     * @return void
     */
    public function puntuacionBar($bar)
    {
        try {
            $sql = "select count(*) as votos, sum(nota) as nota from pinchos join likes_pincho on (cod_pincho = pincho) where bar=:bar group by bar;";

            $stmt = $this->conexion->prepare($sql);
            $stmt->execute(array("bar" => $bar));
            $bares = array();
            foreach ($stmt as $bar) {
                $aux = array(
                    "nota" => $bar["nota"],
                    "votos" => $bar["votos"]
                );
                array_push($bares, $aux);
            }
            return $bares[0];
        } catch (PDOException $e) {
            echo "Error con la DB: " . $e->getMessage();
        }
    }
    /**
     * Obtiene la puntuacion media de un pincho
     *
     * @param [int] $cod_pincho
     * @return void
     */
    public function puntuacionPincho($cod_pincho)
    {
        try {
            $sql = "SELECT SUM(nota) as puntuacion, COUNT(*) as votos FROM likes_pincho where pincho = :pincho";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute(array("pincho" => $cod_pincho));
            $bares = array();
            foreach ($stmt as $bar) {
                $aux = array(
                    "puntuacion" => $bar["puntuacion"],
                    "votos" => $bar["votos"]
                );
                array_push($bares, $aux);
            }
            return $bares[0];
        } catch (PDOException $e) {
            echo "Error con la DB: " . $e->getMessage();
        }
    }
    /**
     * Obtiene el pincho mejor valorado (mas nota media) de un bar
     *
     * @param [int] $bar
     * @return void
     */
    public function especialidadBar($bar)
    {
        try {
            $sql = "select pincho, sum(nota) as puntos from pinchos join likes_pincho on (cod_pincho = pincho) where bar=:bar group by pincho order by puntos desc;";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute(array("bar" => $bar));
            $bares = array();
            foreach ($stmt as $bar) {
                $aux = array(
                    "puntos" => $bar["puntos"],
                    "pincho" => $bar["pincho"]
                );
                array_push($bares, $aux);
            }

            return $bares[0];
        } catch (PDOException $e) {
            echo "Error con la DB: " . $e->getMessage();
        }
    }
    /**
     * Recupera todos los pinchos de un bar
     *
     * @param [int] $bar
     * @return void
     */
    public function recuperarPinchosDeBar($bar)
    {
        try {
            $sql = "select * from pinchos where bar=:bar;";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute(array("bar" => $bar));
            $pinchos = array();
            foreach ($stmt as $bar) {
                $pincho = new Pincho($bar["cod_pincho"], $bar["nombre"], $bar["descripcion"], $bar["precio"], $bar["bar"]);
                array_push($pinchos, $pincho);
            }
            return $pinchos;
        } catch (PDOException $e) {
            echo "Error con la DB: " . $e->getMessage();
        }
    }
    /**
     * Recupera los pinchos que ha valorado un usuario
     *
     * @param [int] $usuario
     * @return void
     */
    public function recuperarPinchosValoradosDeUsuario($usuario)
    {
        try {
            $sql = "select * from likes_pincho join pinchos on (pincho=cod_pincho) where usuario=:usuario;";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute(array("usuario" => $usuario));
            $pinchos = array();
            foreach ($stmt as $bar) {
                array_push($pinchos, $bar);
            }
            return $pinchos;
        } catch (PDOException $e) {
            echo "Error con la DB: " . $e->getMessage();
        }
    }
    /**
     * Obtiene todas las reseñas de un usuario
     *
     * @param [int] $usuario
     * @return void
     */
    public function recuperarResenasDeUsuario($usuario)
    {
        try {
            $sql = "SELECT * FROM valoraciones join pinchos on (pincho=cod_pincho) where usuario=:usuario";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute(array("usuario" => $usuario));
            $resenas = array();
            foreach ($stmt as $bar) {
                array_push($resenas, $bar);
            }
            return $resenas;
        } catch (PDOException $e) {
            echo "Error con la DB: " . $e->getMessage();
        }
    }
    /**
     * Obitene la primera imagen de un bar en BD
     *
     * @param [int] $cod_bar
     * @return void
     */
    public function obtenerPrimeraImagenBar($cod_bar)
    {
        try {
            $sql = "SELECT ruta FROM fotos_bares where bar=:bar";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute(array("bar" => $cod_bar));
            $fotos = array();
            foreach ($stmt as $bar) {
                array_push($fotos, $bar);
            }
            return $fotos[0]["ruta"];
        } catch (PDOException $e) {
            echo "Error con la DB: " . $e->getMessage();
        }
    }
    /**
     * Obtiene la primera imagen de un pincho en BD
     *
     * @param [int] $cod_pincho
     * @return void
     */
    public function obtenerPrimeraImagenPincho($cod_pincho)
    {
        try {
            $sql = "SELECT ruta FROM fotos_pinchos where pincho=:pincho";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute(array("pincho" => $cod_pincho));
            $fotos = array();
            foreach ($stmt as $bar) {
                array_push($fotos, $bar);
            }
            return $fotos[0]["ruta"];
        } catch (PDOException $e) {
            echo "Error con la DB: " . $e->getMessage();
        }
    }
    /**
     * Obtiene los likes que ha dado un usuario
     *
     * @param [string] $usuario
     * @return void
     */
    public function misLikes($usuario)
    {
        try {
            $sql = "SELECT * FROM likes_valoracion where usuario=:usuario";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute(array("usuario" => $usuario));
            $fotos = array();
            foreach ($stmt as $aux) {
                array_push($fotos, $aux["valoracion"]);
            }
            return $fotos;
        } catch (PDOException $e) {
            echo "Error con la DB: " . $e->getMessage();
        }
    }
    /**
     * USuario da un like a una reseña
     *
     * @param [string] $usuario
     * @param [int] $resena
     * @return void
     */
    public function meGusta($usuario, $resena)
    {
        try {
            //comprobamos si el usuario ya le habia dado like
            $sql = "SELECT * FROM likes_valoracion WHERE usuario=:usuario AND valoracion=:resena";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute(array("usuario" => $usuario, "resena" => $resena));
            $num = $stmt->rowCount();

            //numero de likes de la resena
            $numerolikes = "SELECT likes FROM valoraciones where cod_valoracion=:resena";
            $st = $this->conexion->prepare($numerolikes);
            $st->execute(array("resena" => $resena));

            $aux = array();
            foreach ($st as $bar) {
                $a = $bar["likes"];
                array_push($aux, $a);
            }
            $likes = intval($aux[0]);
            if ($num == 0) {
                //si no le ha dado lo guardamos
                $insert = "INSERT INTO likes_valoracion (usuario,valoracion) VALUES ('$usuario', '$resena')";
                $resultado = $this->conexion->query($insert);
                $likes++;

                echo "ME GUSTA";
            } else {
                //si ya le habia dado lo borramos
                $delete = "DELETE FROM likes_valoracion WHERE usuario='$usuario' AND valoracion='$resena'";
                $likes--;
                $resultado = $this->conexion->query($delete);
                echo "YA NO ME GUSTA";
            }

            $update = "UPDATE valoraciones SET likes = '$likes' WHERE cod_valoracion='$resena'";
            $exe = $this->conexion->query($update);
        } catch (PDOException $e) {
            echo "Error con la DB: " . $e->getMessage();
        }
    }
    /**
     * Obtiene los pinchos mejor valorados de todos
     *
     * @return void
     */
    public function pinchosMejorValorados()
    {
        $sql = "SELECT nombre,pincho,descripcion, AVG(nota) as nota FROM likes_pincho join pinchos on (likes_pincho.pincho=pinchos.cod_pincho) GROUP BY pincho ORDER BY AVG(nota) DESC";
        $resultado = $this->conexion->query($sql);
        $pinchos = array();
        foreach ($resultado as $aux) {
            array_push($pinchos, $aux);
        }
        return $pinchos;
    }
    /**
     * Obtiene las 4 reseñas con mas likes
     *
     * @return void
     */
    public function resenasMejorValoradas()
    {
        $sql = "SELECT * FROM valoraciones order by likes DESC LIMIT 0,4";
        $resultado = $this->conexion->query($sql);
        $pinchos = array();
        foreach ($resultado as $aux) {
            $resena = new Resena($aux["cod_valoracion"], $aux["usuario"], $aux["pincho"], $aux["comentario"], $aux["likes"]);
            array_push($pinchos, $resena);
        }
        return $pinchos;
    }
    
}
