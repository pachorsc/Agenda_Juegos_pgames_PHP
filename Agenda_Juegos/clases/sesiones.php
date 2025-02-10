<?php
    function iniciar_sesion($id){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION["usu"]=$id;
        
    }
?>