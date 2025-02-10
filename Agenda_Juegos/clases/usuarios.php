<?php
require_once('../cred.php');
    class Usuario {
        private $bd;
        private $id;
        private $usuario;
        private $contrasena;

        public function __construct() {
            $this->bd = new mysqli('localhost', USU_CONN, PSW_CONN, 'agenda_juego');
            $this->id=0;
            $this->usuario='';
            $this->contrasena='';
        }
        //se comprueba el usuario con un usu y cont
        function cmp_usu($usu, $cnt) {
            $existe = -1;
            $sen = "SELECT count(*) from usuarios where usuario = ? and contrasena = ?";
            $cons= $this->bd->prepare($sen);
            $cons->bind_param('ss',$usu, $cnt);
            
            $cons->execute();
            $cons->bind_result($existe);
            
            $cons->fetch();
            

            //devolvemos la cantidad de columnas que devuelve (1-0)
            return $existe;
        }

        function traer_id_usu($usu) {
            $sen = "SELECT id from usuarios where usuario = ?";
            $cons= $this->bd->prepare($sen);
            $cons->bind_param('s',$usu);
            
            $cons->execute();
            $cons->bind_result($id);
            
            $cons->fetch();
            

            //devolvemos el id
            return $id;
        }
        //traer nombre e id
        function traer_nombre_id_usu() {
            $sen = "SELECT usuario, id from usuarios where id !=8";
            $cons= $this->bd->prepare($sen);
            $cons->execute();
            $cons->bind_result($usuario, $id);

            $amigos = [];

            while ($cons->fetch()) {
                $amigos []= [$usuario, $id];
            }
            //devolvemos el array de amigos
            return $amigos;
        }
        function traer_amigo_match($id) {
            $sen= "SELECT `nombre`, `apellido`, `fecha_nac`, usuario FROM `amigos` WHERE amigo_id = ?";
            $cons= $this->bd->prepare($sen);
            $cons->bind_param("i",$id);

            $cons->execute();
            $cons->bind_result($nom, $apll, $fch ,$usuario);

            $amigo = [];

            while ($cons->fetch()) {
                $amigo = [$nom, $apll, $fch, $usuario];
            }

            //devolvemos el array de amigos
            return $amigo;
        }
        

        //traer nombre, id y contraseña
        function traer_nombre_id_cont() {
            $sen = "SELECT usuario, id , contrasena from usuarios where id !=8";
            $cons= $this->bd->prepare($sen);
            $cons->execute();
            $cons->bind_result($usuario, $id, $cnt);

            $amigos = [];

            while ($cons->fetch()) {
                $amigos []= [$usuario, $id, $cnt];
            }
            //devolvemos el array de amigos
            return $amigos;
        }

        function traer_usuario($id) {
            $sen = "SELECT usuario, id , contrasena, fech_nac from usuarios where id = ?";
            $cons= $this->bd->prepare($sen);
            $cons->bind_param("i",$id);

            $cons->execute();
            $cons->bind_result($usuario, $id, $cnt, $fch);

            $amigo;

            while ($cons->fetch()) {
                $amigo = [$usuario, $id, $cnt, $fch] ;
            }
            //devolvemos el array de amigos
            return $amigo;
        }

        //traer nombre, id y contraseña match
        function traer_match_nombre_id_cont($cadena) {
            $sen = "SELECT usuario, id, contrasena from usuarios where id !=8 and usuario like ?";
            $cons= $this->bd->prepare($sen);
            $cadena .= '%';
            $cons->bind_param('s', $cadena);
            $cons->execute();
            $cons->bind_result($usuario, $id, $cnt);

            $amigos = [];

            while ($cons->fetch()) {
                $amigos []= [$usuario, $id, $cnt];
            }
            //devolvemos el array de amigos
            return $amigos;
        }

        //insertar Usuario Nuevo
        function insert_usuario($nom, $cnt, $fch) {
            $sen = "INSERT INTO `usuarios`( `usuario`, `contrasena`, `fech_nac`) VALUES (?,?,?)";
            $cons= $this->bd->prepare($sen);
            $cons->bind_param("sss",$nom, $cnt, $fch);
            $cons->execute();
        }

        //update usuario
        function update_usuario($nom, $cnt, $fch, $id) {
            $sen = "UPDATE `usuarios` SET `usuario`=?,`contrasena`=?,`fech_nac`=? WHERE id =?";
            $cons= $this->bd->prepare($sen);
            $cons->bind_param("sssi",$nom, $cnt, $fch, $id);
            $cons->execute();
        }

        //traer amigos
        function traer_amigos($usu) {
            $sen = "SELECT  amigo_id, nombre, apellido, fecha_nac from amigos where usuario = ?";
            $cons= $this->bd->prepare($sen);
            $cons->bind_param('i',$usu);
            
            $cons->execute();
            $cons->bind_result($amigo_id, $nombre,$apellido, $fecha_nac );

            $amigos = [];

            while ($cons->fetch()) {
                $amigos []= [$amigo_id,$nombre, $apellido,$fecha_nac];
            }
            //devolvemos el array de amigos
            return $amigos;
        }
        //traer todo contactos 
        function traer_contactos() {
            $sen = "SELECT  amigos.usuario ,amigos.amigo_id, amigos.nombre, amigos.apellido, amigos.fecha_nac , usuarios.usuario from amigos,usuarios where amigos.usuario = usuarios.id";

            $cons= $this->bd->prepare($sen);
            
            $cons->execute();
            $cons->bind_result($id_usuario,$amigo_id,$nombre, $apellido,$fecha_nac, $nom_usuario);

            $amigos = [];

            while ($cons->fetch()) {
                $amigos []= [$id_usuario,$amigo_id,$nombre, $apellido,$fecha_nac, $nom_usuario];
            }
            //devolvemos el array de amigos
            return $amigos;
        }
        function traer_contactos_match($cadena) {
            $sen = "SELECT  amigos.usuario ,amigos.amigo_id, amigos.nombre, amigos.apellido, amigos.fecha_nac , usuarios.usuario from amigos,usuarios where amigos.usuario = usuarios.id and ( amigos.nombre like ? or usuarios.usuario like ?)";
            $cons= $this->bd->prepare($sen);
            $cadena .= '%';
            $cons->bind_param('ss', $cadena, $cadena);
            $cons->execute();
            $cons->bind_result($id_usuario,$amigo_id,$nombre, $apellido,$fecha_nac, $nom_usuario);

            $amigos = [];

            while ($cons->fetch()) {
                $amigos []= [$id_usuario,$amigo_id,$nombre, $apellido,$fecha_nac, $nom_usuario];
            }

            //devolvemos el array de amigos
            return $amigos;
        }

        //insertar contacto

        function insert_cont($nom, $apll, $fecha, $dueno) {
            $sen = "INSERT INTO `amigos`(`usuario`, `nombre`, `apellido`, `fecha_nac`) VALUES (?,?,?,?)";
            $cons= $this->bd->prepare($sen);
            $cons->bind_param('isss', $dueno, $nom, $apll, $fecha);
            $cons->execute();
        }

        //traer amigos filtrados 

        function traer_amigos_match($usuario, $cadena) {
            $sen = "SELECT  amigo_id, nombre, apellido, fecha_nac from amigos where usuario = ? and nombre like ?";
            $cons= $this->bd->prepare($sen);
            $cadena .= '%';
            $cons->bind_param('is',$usuario, $cadena);
            $cons->execute();
            $cons->bind_result($amigo_id, $nombre,$apellido, $fecha_nac );

            $amigos = [];

            while ($cons->fetch()) {
                $amigos []= [$amigo_id,$nombre, $apellido,$fecha_nac];
            }

            //devolvemos el array de amigos
            return $amigos;
        }

        //modificar amigo

        function modificar_amigo($nm, $apll, $fch, $id_usu, $id_amig) {
            $sen = "UPDATE `amigos` SET `nombre`= ?,`apellido`= ? ,`fecha_nac`= ? WHERE usuario = ? and amigo_id =?";
            $cons= $this->bd->prepare($sen);
            $cons->bind_param('sssii',$nm,$apll,$fch,$id_usu,$id_amig);
            
            $cons->execute();
        }

        function modificar_contacto($nm, $apll, $fch, $id_usu_n, $id_amig, $id_usu_ant) {
            $sen = "UPDATE `amigos` SET `usuario`= ? ,`nombre`= ?,`apellido`= ? ,`fecha_nac`= ? WHERE usuario = ? and amigo_id =?";
            $cons= $this->bd->prepare($sen);
            $cons->bind_param('isssii',$id_usu_n, $nm, $apll, $fch, $id_usu_ant,$id_amig);
            
            $cons->execute();
        }

        //insertar amigo
        function insert_amigo($nm, $apll, $fch, $usu) {
            $sen = "INSERT INTO `amigos`(`usuario`, `nombre`, `apellido`, `fecha_nac`) VALUES (?,?,?,?)";
            $cons= $this->bd->prepare($sen);
            $cons->bind_param('isss',$usu,$nm,$apll,$fch);
            
            $cons->execute();
        }

        //traer los prestamos para mostrar en tabla 
        function traer_prestamos($usu) {
            $sen = "SELECT  usuarios.usuario, juegos.titulo, amigos.nombre, prestamo.fecha, prestamo.estado , juegos.juego_id from usuarios, juegos, amigos, prestamo where usuarios.id = prestamo.usuario and juegos.juego_id = prestamo.juego and amigos.amigo_id = prestamo.amigo and prestamo.usuario = ? order by prestamo.fecha";
            $cons= $this->bd->prepare($sen);
            $cons->bind_param('i',$usu);
            
            $cons->execute();
            $cons->bind_result($nom_usu, $tit_jueg, $nom_amig , $fech_prest, $estado,$juego_id );

            $prest = [];

            while ($cons->fetch()) {
                $prest []= [$nom_usu, $tit_jueg, $nom_amig , $fech_prest, $estado, $juego_id];
            }
            //devolvemos el array de amigos
            return $prest;
        }

        //traer prestamos que coincidan con el nombre
        function traer_prestamos_match($usu, $cadena) {
            $sen = "SELECT  usuarios.usuario, juegos.titulo, amigos.nombre, prestamo.fecha, prestamo.estado , juegos.juego_id from usuarios, juegos, amigos, prestamo where usuarios.id = prestamo.usuario and juegos.juego_id = prestamo.juego and amigos.amigo_id = prestamo.amigo and prestamo.usuario = ? and (juegos.titulo like ? or amigos.nombre like ?)";
            $cons= $this->bd->prepare($sen);
            $cadena .= '%';
            $cons->bind_param('iss',$usu, $cadena, $cadena);
            
            $cons->execute();
            $cons->bind_result($nom_usu, $tit_jueg, $nom_amig , $fech_prest, $estado,$juego_id );

            $prest = [];

            while ($cons->fetch()) {
                $prest []= [$nom_usu, $tit_jueg, $nom_amig , $fech_prest, $estado, $juego_id];
            }
            //devolvemos el array de amigos
            return $prest;
        }

        //traer juegos del usuario

        function traer_juegos_usu($usu) {
            $sen = "SELECT titulo ,juego_id FROM juegos WHERE juego_id NOT IN (SELECT juego FROM prestamo WHERE estado = 1) AND usuario = ?";

            $cons= $this->bd->prepare($sen);
            $cons->bind_param('i',$usu);
            
            $cons->execute();
            $cons->bind_result($tit_jueg, $id_jueg );

            $jueg = [];

            while ($cons->fetch()) {
                $jueg []= [$tit_jueg, $id_jueg];
            }
            //devolvemos el array de amigos
            return $jueg;
        }

        //insertar prestamos
        function insert_prestamo($usu, $amig, $jueg) {
                $sen = "INSERT INTO `prestamo`(`usuario`, `amigo`, `juego`, `estado`) VALUES (?,?,?,1)";
                $cons= $this->bd->prepare($sen);
                $cons->bind_param('iii',$usu,$amig,$jueg);
                
                $cons->execute();
                
        }

        //entregar juego
        function entregar_Juego($usu, $jueg) {
            $sen = "UPDATE prestamo set estado = 0 where usuario = ? and juego = ?";
            $cons= $this->bd->prepare($sen);
            $cons->bind_param('ii',$usu,$jueg);
            
            $cons->execute();
        }



    }

?>