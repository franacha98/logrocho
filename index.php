<?php
    session_start();

    //importamos los modelos
    require("model/BarModel.php");
    require("model/UsuarioModel.php");
    require("model/PinchoModel.php");

    //importamos los controladores
    require("controller/HomeController.php");
    require("controller/BaresController.php");
    require("controller/PinchosController.php");
    require("controller/UsuariosController.php");

    $homecontroller = new HomeController;
    $barescontroller = new BaresController;
    $pinchoscontroller = new PinchosController;
    $usuarioscontroller = new UsuariosController;

    //calcular ruta
    $home = "/logrocho/index.php/";
    $ruta = str_replace($home, "", $_SERVER["REQUEST_URI"]);

 
    $array_ruta = explode("/", $ruta);


    if(isset($array_ruta[0]) && $array_ruta[0] == "check-login"){
        $homecontroller->comprobarLogin();    
    }else if(isset($array_ruta[0]) && $array_ruta[0] == "panel-administracion"){
        $homecontroller->panelAdministracion();  
    }else if(isset($array_ruta[0]) && $array_ruta[0] == "contrasena-olvidada"){
        $homecontroller->renderizarContrasenaOlvidada();  
    }else if(isset($array_ruta[0]) && $array_ruta[0] == "lista-bares"){
        $barescontroller->listaBares();
    }else if(isset($array_ruta[0]) && $array_ruta[0] == "lista-pinchos"){
        $pinchoscontroller->listaPinchos();
    }else if(isset($array_ruta[0]) && $array_ruta[0] == "anadir-bar-vista"){
        $barescontroller->anadirBarVista();
    }else if(isset($array_ruta[0]) && $array_ruta[0] == "anadir-pincho-vista"){
        $pinchoscontroller->anadirPinchoVista();
    }else if(isset($array_ruta[0]) && $array_ruta[0] == "anadir-usuario-vista"){
        $usuarioscontroller->anadirUsuarioVista();
    }else if(isset($array_ruta[0]) && $array_ruta[0] == "anadir-bar"){
        $barescontroller->anadirBar();
    }else if(isset($array_ruta[0]) && $array_ruta[0] == "anadir-usuario"){
        $usuarioscontroller->anadirUsuario();
    }else if(isset($array_ruta[0]) && $array_ruta[0] == "anadir-pincho"){
        $pinchoscontroller->anadirPincho();
    }else if(isset($array_ruta[0]) && $array_ruta[0] == "ficha-bar"){
        $barescontroller->fichaBar($array_ruta[1]);
    }else if(isset($array_ruta[0]) && $array_ruta[0] == "ficha-usuario"){
        $usuarioscontroller->fichaUsuario($array_ruta[1]);
    }else if(isset($array_ruta[0]) && $array_ruta[0] == "ficha-pincho"){
        $pinchoscontroller->fichaPincho($array_ruta[1]);
    }else if(isset($array_ruta[0]) && $array_ruta[0] == "eliminar-bar"){
        $barescontroller->eliminarBar($array_ruta[1]);
    }else if(isset($array_ruta[0]) && $array_ruta[0] == "eliminar-pincho"){
        $pinchoscontroller->eliminarPincho($array_ruta[1]);
    }else if(isset($array_ruta[0]) && $array_ruta[0] == "eliminar-usuario"){
        $usuarioscontroller->eliminarUsuario($array_ruta[1]);
    }else if(isset($array_ruta[0]) && $array_ruta[0] == "modificar-bar"){
        $barescontroller->modificarBar();
    }else if(isset($array_ruta[0]) && $array_ruta[0] == "modificar-pincho"){
        $pinchoscontroller->modificarPincho();
    }else if(isset($array_ruta[0]) && $array_ruta[0] == "modificar-usuario"){
        $usuarioscontroller->modificarUsuario();
    }else if(isset($array_ruta[0]) && $array_ruta[0] == "listado-bares"){
        $barescontroller->listaBaresJson($array_ruta[1], $array_ruta[2]);
    }else if(isset($array_ruta[0]) && $array_ruta[0] == "listado-pinchos"){
        $pinchoscontroller->listaPinchosJson($array_ruta[1], $array_ruta[2]);
    }else if(isset($array_ruta[0]) && $array_ruta[0] == "lista-usuarios"){
        $usuarioscontroller->listaUsuarios();
    }else if(isset($array_ruta[0]) && $array_ruta[0] == "listado-usuarios"){
        $usuarioscontroller->listaUsuariosJson($array_ruta[1], $array_ruta[2]);
    }else{   
        $homecontroller->renderizarHome();
    }

?>