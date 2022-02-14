<?php
    session_start();

    //importamos los modelos
    require("model/BarModel.php");
    require("model/UsuarioModel.php");
    require("model/PinchoModel.php");
    require("model/ResenasModel.php");

    //importamos los controladores
    require("controller/HomeController.php");
    require("controller/BaresController.php");
    require("controller/PinchosController.php");
    require("controller/UsuariosController.php");
    require("controller/ResenasController.php");

    $homecontroller = new HomeController;
    $barescontroller = new BaresController;
    $pinchoscontroller = new PinchosController;
    $usuarioscontroller = new UsuariosController;
    $resenascontroller = new ResenasController;

    //calcular ruta
    $home = "/logrocho/index.php/";
    $ruta = str_replace($home, "", $_SERVER["REQUEST_URI"]);

 
    $array_ruta = explode("/", $ruta);


    if(isset($array_ruta[0]) && $array_ruta[0] == "check-login"){
        $homecontroller->comprobarLogin();    
    }else if(isset($array_ruta[0]) && $array_ruta[0] == "panel-administracion"){
        $homecontroller->panelAdministracion();  
    }else if(isset($array_ruta[0]) && $array_ruta[0] == "inicio"){
        $homecontroller->homePublica();  
    }else if(isset($array_ruta[0]) && $array_ruta[0] == "contrasena-olvidada"){
        $homecontroller->renderizarContrasenaOlvidada();  
    }else if(isset($array_ruta[0]) && $array_ruta[0] == "lista-bares"){
        $barescontroller->listaBares();
    }else if(isset($array_ruta[0]) && $array_ruta[0] == "lista-pinchos"){
        $pinchoscontroller->listaPinchos();
    }else if(isset($array_ruta[0]) && $array_ruta[0] == "lista-resenas"){
        $resenascontroller->listaResenas();
    }else if(isset($array_ruta[0]) && $array_ruta[0] == "anadir-bar-vista"){
        $barescontroller->anadirBarVista();
    }else if(isset($array_ruta[0]) && $array_ruta[0] == "anadir-pincho-vista"){
        $pinchoscontroller->anadirPinchoVista();
    }else if(isset($array_ruta[0]) && $array_ruta[0] == "anadir-usuario-vista"){
        $usuarioscontroller->anadirUsuarioVista();
    }else if(isset($array_ruta[0]) && $array_ruta[0] == "anadir-resena-vista"){
        $resenascontroller->anadirResenaVista();
    }else if(isset($array_ruta[0]) && $array_ruta[0] == "anadir-bar"){
        $barescontroller->anadirBar();
    }else if(isset($array_ruta[0]) && $array_ruta[0] == "anadir-usuario"){
        $usuarioscontroller->anadirUsuario();
    }else if(isset($array_ruta[0]) && $array_ruta[0] == "anadir-pincho"){
        $pinchoscontroller->anadirPincho();
    }else if(isset($array_ruta[0]) && $array_ruta[0] == "anadir-resena"){
        $resenascontroller->anadirResena();
    }else if(isset($array_ruta[0]) && $array_ruta[0] == "ficha-bar"){
        $barescontroller->fichaBar($array_ruta[1]);
    }else if(isset($array_ruta[0]) && $array_ruta[0] == "ficha-usuario"){
        $usuarioscontroller->fichaUsuario($array_ruta[1]);
    }else if(isset($array_ruta[0]) && $array_ruta[0] == "ficha-pincho"){
        $pinchoscontroller->fichaPincho($array_ruta[1]);
    }else if(isset($array_ruta[0]) && $array_ruta[0] == "ficha-resena"){
        $resenascontroller->fichaResena($array_ruta[1]);
    }else if(isset($array_ruta[0]) && $array_ruta[0] == "eliminar-bar"){
        $barescontroller->eliminarBar($array_ruta[1]);
    }else if(isset($array_ruta[0]) && $array_ruta[0] == "eliminar-pincho"){
        $pinchoscontroller->eliminarPincho($array_ruta[1]);
    }else if(isset($array_ruta[0]) && $array_ruta[0] == "eliminar-usuario"){
        $usuarioscontroller->eliminarUsuario($array_ruta[1]);
    }else if(isset($array_ruta[0]) && $array_ruta[0] == "eliminar-resena"){
        $resenascontroller->eliminarResena($array_ruta[1]);
    }else if(isset($array_ruta[0]) && $array_ruta[0] == "modificar-bar"){
        $barescontroller->modificarBar();
    }else if(isset($array_ruta[0]) && $array_ruta[0] == "modificar-pincho"){
        $pinchoscontroller->modificarPincho();
    }else if(isset($array_ruta[0]) && $array_ruta[0] == "modificar-usuario"){
        $usuarioscontroller->modificarUsuario();
    }else if(isset($array_ruta[0]) && $array_ruta[0] == "modificar-resena"){
        $resenascontroller->modificarResena();
    }else if(isset($array_ruta[0]) && $array_ruta[0] == "listado-bares"){
        $barescontroller->listaBaresJson($array_ruta[1], $array_ruta[2]);
    }else if(isset($array_ruta[0]) && $array_ruta[0] == "listado-pinchos"){
        $pinchoscontroller->listaPinchosJson($array_ruta[1], $array_ruta[2]);
    }else if(isset($array_ruta[0]) && $array_ruta[0] == "lista-usuarios"){
        $usuarioscontroller->listaUsuarios();
    }else if(isset($array_ruta[0]) && $array_ruta[0] == "listado-usuarios"){
        $usuarioscontroller->listaUsuariosJson($array_ruta[1], $array_ruta[2]);
    }else if(isset($array_ruta[0]) && $array_ruta[0] == "listado-resenas"){
        $resenascontroller->listaResenaJson($array_ruta[1], $array_ruta[2]);
    }else if(isset($array_ruta[0]) && $array_ruta[0] == "eliminar-foto-pincho"){
        $pinchoscontroller->eliminarFotoPincho($array_ruta[1]);
    }else if(isset($array_ruta[0]) && $array_ruta[0] == "eliminar-foto-bar"){
        $barescontroller->eliminarFotoBar($array_ruta[1]);
    }else if(isset($array_ruta[0]) && $array_ruta[0] == "cerrar-sesion"){
        $homecontroller->cerrarSesion();
// PARTE PUBLICA
    }else if(isset($array_ruta[0]) && $array_ruta[0] == "bares"){
        $barescontroller->listaBaresPublico();
    }else if(isset($array_ruta[0]) && $array_ruta[0] == "bar"){
        $barescontroller->barPublico($array_ruta[1]);
    }else if(isset($array_ruta[0]) && $array_ruta[0] == "pinchos"){
        $pinchoscontroller->listaPinchosPublico();
    }else if(isset($array_ruta[0]) && $array_ruta[0] == "pincho"){
        $pinchoscontroller->pinchoPublico($array_ruta[1]);
    }else if(isset($array_ruta[0]) && $array_ruta[0] == "zona-usuario"){
        $usuarioscontroller->zonaUsuario($array_ruta[1]);
    }else if(isset($array_ruta[0]) && $array_ruta[0] == "registro"){
        $homecontroller->registro();
    }else if(isset($array_ruta[0]) && $array_ruta[0] == "controlar-registro"){
        $homecontroller->controlRegistro();
    }else{   
        $homecontroller->renderizarHome();
    }

?>