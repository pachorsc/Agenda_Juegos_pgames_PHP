<?php
require_once('../cred.php');
    class Juego {
        private $bd;

        public function __construct() {
            $this->bd = new mysqli('localhost', USU_CONN, PSW_CONN, 'agenda_juego');
        }
        //traer juegos
        function traer_juegos_usu($usuario) {
            $sen = "SELECT juego_id, titulo, plataforma, imagen, fech_lanz  from juegos where usuario = ?";
            $cons= $this->bd->prepare($sen);
            $cons->bind_param('i',$usuario);
            
            $cons->execute();
            $cons->bind_result($id, $nom, $plat, $img, $salida);
            $jueg=[];
            //metemos los juegos del usuario en un array
            while ($cons->fetch()) {
                $fech_arr = explode('-',$salida);
                $jueg [] =[$nom, $plat, $img, $fech_arr[0],$id];
            }

            //devolvemos el id
            return $jueg ;
        }

        function traer_juego($id) {
            $sen = "SELECT titulo, plataforma, fech_lanz, imagen from juegos where juego_id = ?";
            $cons= $this->bd->prepare($sen);
            $cons->bind_param('i',$id);
            
            $cons->execute();
            $cons->bind_result($titulo, $plataforma, $fecha_lanz, $imagen);
            $jueg;
            //metemos los juegos del usuario en un array
            while ($cons->fetch()) {
                $jueg =[$titulo, $plataforma, $fecha_lanz, $imagen];
            }

            return $jueg;
        }

        //traer juegos filtrados por nombre
        function traer_juegos_match($usuario, $cadena) {
            $sen = "SELECT juego_id, titulo, plataforma, imagen, fech_lanz  from juegos where usuario = ? and titulo like ?";
            $cons= $this->bd->prepare($sen);
            $cadena .= '%';
            $cons->bind_param('is',$usuario, $cadena);
            
            $cons->execute();
            $cons->bind_result($id, $nom, $plat, $img, $salida);
            $jueg=[];
            //metemos los juegos del usuario en un array
            while ($cons->fetch()) {
                $fech_arr = explode('-',$salida);
                $jueg [] =[$nom, $plat, $img, $fech_arr[0],$id];
            }

            return $jueg;
        }

        function modificar_juego($id_juego, $titulo, $plataforma, $fech, $img) {
            $destino = "img_juegos/".$titulo;
            $origen = $img;
            move_uploaded_file($origen, $destino);

            $sen = "UPDATE `juegos` SET `titulo`= ?,`imagen`= ?,`plataforma`= ?,`fech_lanz`= ? WHERE juego_id = ?";
            $cons= $this->bd->prepare($sen);
            $cons->bind_param('ssisi',$titulo, $destino, $plataforma, $fech,$id_juego);
            
            $cons->execute();
        }

        //insertar juego 
        function insertar_juego($usu, $titulo, $plataforma, $fech, $img) {
            $destino = "img_juegos/".$titulo;
            $origen = $img;
            move_uploaded_file($origen, $destino);

            $sen = "INSERT INTO `juegos`(`usuario`, `titulo`, `plataforma`, `imagen`, `fech_lanz`) VALUES (?,?,?,?,?)";
            $cons= $this->bd->prepare($sen);
            $cons->bind_param('isiss',$usu, $titulo, $plataforma, $destino, $fech);
            
            $cons->execute();
        }

    }

?>