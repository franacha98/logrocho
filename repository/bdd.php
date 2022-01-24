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

    public function eliminarPincho($cod_pincho){
        try {
            $sql = "DELETE FROM pinchos WHERE cod_pincho=$cod_pincho";
            $result = $this->conexion->query($sql);
            echo $sql;
        } catch (PDOException $e) {
            echo "Error con la DB: " . $e->getMessage();
        }
    }


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

    public function modificarUsuario($usuario, $contrasena, $admin, $nombre){
        try {      
            $sql = "UPDATE usuarios SET nombre='$nombre', usuario='$usuario', admin='$admin', contrasena='$contrasena' WHERE usuario='$usuario'";
            echo $sql;
            $resultado = $this->conexion->query($sql);
        } catch (PDOException $e) {
            echo "Error con la DB: " . $e->getMessage();
        }
    }

    public function eliminarUsuario($usuario){
        try {
            $sql = "DELETE FROM usuarios WHERE usuario='$usuario'";
            $result = $this->conexion->query($sql);
            echo $sql;
        } catch (PDOException $e) {
            echo "Error con la DB: " . $e->getMessage();
        }
    }

    public function modificarPincho($cod_pincho, $nombre, $descripcion, $precio, $bar){
        try {      
            $sql = "UPDATE pinchos SET nombre='$nombre', descripcion='$descripcion', precio='$precio', bar='$bar' WHERE cod_pincho=$cod_pincho";
            echo $sql;
            $resultado = $this->conexion->query($sql);
        } catch (PDOException $e) {
            echo "Error con la DB: " . $e->getMessage();
        }
    }

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

    public function eliminarBar($cod_bar){
        try {
            $sql = "DELETE FROM bares WHERE cod_bar=$cod_bar";
            $result = $this->conexion->query($sql);
            echo $sql;
        } catch (PDOException $e) {
            echo "Error con la DB: " . $e->getMessage();
        }
    }

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
