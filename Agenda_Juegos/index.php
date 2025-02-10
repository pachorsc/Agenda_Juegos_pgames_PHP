<?php
    //comprobamos usu y cont
    function iniSes() {   
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }     
        require_once('./clases/usuarios.php');
        $usu = new Usuario();
        if (isset($_COOKIE["cookUsu"])) {
            require_once('clases/sesiones.php');
            iniciar_sesion($_COOKIE["cookUsu"]);
            //si es admin

            if ($_SESSION["usu"] == 8) {
                pag('menu_admin.php');
            } else {
                 
                pag("menu.php");
                exit();
            }
        }

        if (!isset($_POST['usu'])) {
            $_POST['usu'] = "null";
            $_POST['cnt'] = "null";

        }

        if ($usu->cmp_usu($_POST['usu'] , $_POST['cnt']) ==1) {
            //mantener iniciada su sesion si quiere
            require_once('./clases/cookies.php');
            //id del usu iniciado
            $id_usu = $usu->traer_id_usu($_POST["usu"]);
            //dar o quitar cookie de recordar
            if (isset($_POST["ms"])) {
                //creamos la cookie TestCookie con el id del usuario
                mant_sesion($id_usu);
            } else {
                quitar_sesion();
            }

            require_once('clases/sesiones.php');
            iniciar_sesion($id_usu);
            //si es admin
            if ($id_usu == 8 || $_SESSION["usu"] == 8) {
                pag('menu_admin.php');
            } else {
                 
                pag("menu.php");
            }
            
            
        } else {
            //si no existe lo vuelve a llevar al inicio
            inicio();
        }
    }
    //salir 
    function salir() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        session_destroy();
        require_once('./clases/cookies.php');
        quitar_sesion();
        inicio();
    }
    //zona administrador

    //menu contactos admin
    function menu_admin_contactos() {
        //traemos la lista de sus amigos
        require_once('clases/usuarios.php');
        $usuu = new Usuario();
        $amigos= [];
        if (isset($_POST['buscar'])) {
            //trae un array de los contactos que contengan ese string al inicio            
            $amigos = $usuu->traer_contactos_match($_POST['nm']);
        } else {
            //trae todos los contactos de la base de datos en un array excepto el admin
            $amigos = $usuu->traer_contactos();
        }
        //$id_usuario,$amigo_id,$nombre, $apellido,$fecha_nac, $nom_usuario
        
        require_once('./vistas/head.html');
        require_once('./vistas/header_admin.html');
        require_once("./vistas/menu_amigos.php");
        require_once('./vistas/head_fin.html');
    }
    //cambiar contacto
    function modcont() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        require_once('./clases/usuarios.php');
        $usuu = new Usuario();
        //$usuario, $id
        $amigos_list = $usuu->traer_nombre_id_usu();
        //$nom, $apll, $fch ,$usuario
        $amigos = $usuu->traer_amigo_match($_GET["amigo"]);
        
        
        $_SESSION['usuario']=$_GET['usu'];
        $_SESSION['amigo_id']=$_GET["amigo"];
        require_once('./vistas/head.html');
        require_once('./vistas/header_admin.html');
        require_once("./vistas/modificar_amigo.php");
        require_once('./vistas/head_fin.html');
    }

    //update contacto

    function actualizar_contacto() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        require_once('clases/usuarios.php');
        $usu= new Usuario();
        $usu->modificar_contacto($_POST['nm'],$_POST['apll'] ,   $_POST['fch'], $_POST["nusu"] ,$_SESSION['amigo_id'], $_SESSION['usuario']);
        
        menu_admin_contactos();
    }

    //nuevo contacto

    function nuevo_contacto() {
        require_once('./clases/usuarios.php');
        $usuu = new Usuario();
        $amigos = $usuu->traer_nombre_id_usu();

        require_once('./vistas/head.html');
        require_once('./vistas/header_admin.html');
        require_once('./vistas/nuevo_contacto.php');
        require_once('./vistas/head_fin.html');
    }

    //inser a contacto BD
    function insertar_contacto() {
        require_once('./clases/usuarios.php');
        $usuu = new Usuario();
        $usuu->insert_cont($_POST['nm'], $_POST['apll'], $_POST['fch'], $_POST['nusu']);
        
        menu_admin_contactos();
    }

    //menu admun usuarios 
    function menu_admin_usuarios() {
        require_once('./clases/usuarios.php');
        $usuu = new Usuario();
        $usuarios=[];
        if (isset($_POST['buscar'])) {
            $usuarios = $usuu->traer_match_nombre_id_cont($_POST['nm']);
        } else {
            $usuarios = $usuu->traer_nombre_id_cont();
        }
        //usuario, id , contrasena
        require_once('./vistas/head.html');
        require_once('./vistas/header_admin.html');
        require_once('./vistas/menu_admin_usuarios.php');
        require_once('./vistas/head_fin.html');
    }

    //ir a form de nuevo usuario
    function nuevo_usuario() {
        require_once('./vistas/head.html');
        require_once('./vistas/header_admin.html');
        require_once('./vistas/form_nuevo_usuario.php');
        require_once('./vistas/head_fin.html');
    }

    //insertar usuario nuevo

    function insertar_usuario() {
        require_once('clases/usuarios.php');
        $usu= new Usuario();
        //$nom, $cnt, $fch
        $usu->insert_usuario($_POST['nm'], $_POST['cnt'], $_POST['fch']);

        menu_admin_usuarios();
    }

    //modificar usuario

    function mod_usu() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        require_once('./clases/usuarios.php');
        $usu= new Usuario();
        //$usuario, $id, $cnt, $fch
        $usuario = $usu->traer_usuario($_GET['usu']);

        $_SESSION['usuario']=$_GET['usu'];

        require_once('./vistas/head.html');
        require_once('./vistas/header_admin.html');
        require_once('./vistas/form_modificar_usuario.php');
        require_once('./vistas/head_fin.html');
    }


    function update_usuario() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        require_once('clases/usuarios.php');
        $usu= new Usuario();
        //$nom, $cnt
        $usu->update_usuario($_POST['nm'], $_POST['cnt'], $_POST['fch'], $_SESSION['usuario']);

        menu_admin_usuarios();
    }

    //zona de amigos
    function menu_amigos() {
        if (!(isset($_SESSION["usu"]))) session_start();

        //traemos la lista de sus amigos
        require_once('clases/usuarios.php');
        $usuu = new Usuario();
        $amigos= [];

        if ($_SESSION["usu"]==8) {
            
            $amigo = $usuu->traer_contactos();

            if (isset($_POST['buscar'])) {
                $amigos = $usuu->traer_contactos_match($_POST['nm']);
            }

            require_once('./vistas/head.html');
            require_once('./vistas/header_admin.html');
        } else {
            if (isset($_POST['buscar'])) {
                $amigos = $usuu->traer_amigos_match($_SESSION["usu"], $_POST['nm']);
            } else {
                $amigos = $usuu->traer_amigos($_SESSION["usu"]);
            }

            require_once('./vistas/head.html');
            require_once('./vistas/header_registrado.html');
        }
 
        require_once("./vistas/menu_amigos.php");
        require_once('./vistas/head_fin.html');
    }

    //modificar amigo form
    function modamig() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        require_once('./clases/usuarios.php');
        $usu= new Usuario();
        //`nombre`, `apellido`, `fecha_nac`
        $amigos = $usu->traer_amigo_match($_GET['amigo']);
        
        $_SESSION['amigo_id']=$_GET["amigo"];
        require_once('./vistas/head.html');
        require_once('./vistas/header_registrado.html');
        require_once("./vistas/modificar_amigo.php");
        require_once('./vistas/head_fin.html');
    }

    //actualizar amigo finalmente
    function actualizar_amigo() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        require_once('clases/usuarios.php');
        $usu= new Usuario();
        $usu->modificar_amigo($_POST['nm'],$_POST['apll'] ,$_POST['fch'], $_SESSION["usu"], $_SESSION['amigo_id']);
        menu_amigos();
    }
    //Nuevo amigo 

    function nuevo_amigo() {
        //mandar a vista para añadir amigo
        pag('form_nuevo_amigo.php');

    }
    //insertar nuevo amigo
    function insertar_amigo() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        require_once('clases/usuarios.php');
        $usu= new Usuario();
        $usu->insert_amigo($_POST['nm'],$_POST['apll'] ,$_POST['fch'], $_SESSION["usu"]);
        menu_amigos();
    }

    //zona de juegos
    function menu_juegos() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if(isset($_SESSION['usu'])) {
            require_once('./clases/juegos.php');
            $jueg = new Juego();
            $arr_jueg =[];

            if (isset($_POST['buscar'])) {
                //trae una linea de texto $_POst['nm']
                $arr_jueg = $jueg->traer_juegos_match($_SESSION["usu"], $_POST['nm']);
            } else {
                //si no se ha hecho nunguna busqueda entonces se hace una de todos
                $arr_jueg = $jueg->traer_juegos_usu($_SESSION["usu"]);
            }
            require_once('./vistas/head.html');
            require_once('./vistas/header_registrado.html');
            require_once("./vistas/menu_juegos.php");
            require_once('./vistas/head_fin.html');
        }
    }
    //ir al form de modificart juego
    function mod_game() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION["jueg"] = $_GET["jueg"];
        require_once('./clases/juegos.php');
        $jueg = new Juego();
        //$titulo, $plataforma, $fecha_lanz, $imagen
        $juego = $jueg->traer_juego($_GET["jueg"]);

        require_once('./vistas/head.html');
            require_once('./vistas/header_registrado.html');
            require_once("./vistas/form_mod_juego.php");
            require_once('./vistas/head_fin.html');
    }

    //actualizar juego: Recoje datos de formulario y hace update en la base de datos
    function act_juego() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $imagen = $_FILES['img']["tmp_name"];
        require_once('./clases/juegos.php');
        $jueg = new Juego();
        //array con los juegos
        $jueg->modificar_juego($_SESSION["jueg"], $_POST["nm"], $_POST['plat'], $_POST['fch'], $imagen);
        menu_juegos();
    }

    //añadir juego

    function anadir_juego() {
        pag('form_anadir_juego.html');
    }
    function insert_juego() {
        if (!(isset($_SESSION["usu"])))session_start();
        $imagen = $_FILES['img']["tmp_name"];
        require_once('./clases/juegos.php');
        $jueg = new Juego();
        $jueg->insertar_juego($_SESSION["usu"], $_POST["nm"], $_POST['plat'], $_POST['fch'], $imagen);
        menu_juegos();
    }

    //prestamos 
    function menu_prestamos() {
        if (!(isset($_SESSION["usu"])))session_start();
        require_once('clases/usuarios.php');
        $usuario = new Usuario();
        //$nom_usu, $tit_jueg, $nom_amig , $fech_prest, $estado
        if (isset($_POST['buscar'])) {
            $arr_prestamo = $usuario->traer_prestamos_match($_SESSION["usu"], $_POST['nm']);
            
        } else {
            $arr_prestamo = $usuario->traer_prestamos($_SESSION["usu"]);
        }
        require_once('./vistas/head.html');
        require_once('./vistas/header_registrado.html');
        require_once('./vistas/menu_prestamo.php');
        require_once('./vistas/head_fin.html');
    }
    //nuevo prestamo
    function nuevo_prest() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        require_once('./clases/usuarios.php');
        $usua= new Usuario();

        $jueg = $usua->traer_juegos_usu($_SESSION["usu"]);
        $amig = $usua->traer_amigos($_SESSION["usu"]);
        require_once('./vistas/head.html');
        require_once('./vistas/header_registrado.html');
        require_once('.\vistas\form_prestamo.php');
        require_once('./vistas/head_fin.html');
    }
    //insertar nuevo prestamo
    function insertar_prest() {
        //$usu, $amig, $jueg
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        require_once('clases/usuarios.php');
        $usu= new Usuario();
        if ((isset($_POST['jueg']) && !(is_null($_POST['jueg'])))) {
        $usu->insert_prestamo($_SESSION["usu"],$_POST['amig'], $_POST['jueg'] );
        }
        //cuando ya se hace la incersion va al menu
        menu_prestamos();
    }

    //entregar juego

    function entregar_jueg() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        require_once('clases/usuarios.php');
        $usu= new Usuario();
        $usu->entregar_juego($_SESSION["usu"], $_GET['jueg']);

        menu_prestamos();
    }

    //formulario de inicio
    function inicio(){
        require_once('./vistas/head.html');
        require_once('./vistas/header.html');
        require_once('./vistas/inicio.html');
        require_once('./vistas/head_fin.html');
    }

    function pag($pag, $header =''){
        require_once('./vistas/head.html');
        require_once('./vistas/header_registrado.html');
        require_once('./vistas/'.$pag);
        require_once('./vistas/head_fin.html');
    };

    //si no hay ninguna variable se vuelve al formulario de inicio
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (isset($_REQUEST['action'])) {
        $action = $_REQUEST['action'];
        $action();
    }else if (isset($_COOKIE["cookUsu"]) || isset($_SESSION["usu"])) {
        //si existe una sesion o una cookie con el usuario va a menu registrado
        if (isset($_COOKIE["cookUsu"])) {
            require_once('clases/sesiones.php');
            iniciar_sesion($_COOKIE["cookUsu"]);
        }
        
        if ($_SESSION["usu"] == 8) {
            pag('menu_admin.php');
        } else {
            pag("menu.php");
        }
    } else{
        inicio();
    }

?>