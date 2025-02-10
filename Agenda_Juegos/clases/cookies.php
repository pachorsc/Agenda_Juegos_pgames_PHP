<?php
    function mant_sesion($id_usu) {
        //creamos la cookie por 1 mes
        setcookie("cookUsu", $id_usu, time()+(86.400*30));
    }

    function  quitar_sesion(){
        setcookie("cookUsu", "", time()-100);
    }

?>