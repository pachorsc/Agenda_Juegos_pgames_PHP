<section class="list_jue">
    <div class="container">
        <div class="my-5">
            <h1 clas="text-center"><span class="text-primary">L</span>ista de <?php
                        if (!(isset($_SESSION["usu"]))) session_start();
                        if ($_SESSION["usu"]==8) {
                            echo "Contactos";
                        } else echo '<span class="text-primary">A</span>migos';
            ?></h1>
        </div>

        <form class="d-flex my-5" action="index.php?action=menu_amigos" method="post">
            <input class="form-control me-2" name="nm" type="search" placeholder="Amigo" aria-label="Search">
            <input class="btn btn-outline-success" name="buscar" value="Buscar" type="submit"></input>
        </form>

    <table class="table table-hover">
        <tr>
            <th>NOMBRE</th>
            <th>APELLIDO</th>
            <th>FECHA NACIMIENTO</th>
                <?php
                    if (!(isset($_SESSION["usu"]))) session_start();
                    if ($_SESSION["usu"]==8) {
                        echo "<th>Dueño</th>";
                    }
                ?>
            <th></th>
        </tr>
        <?php
        echo "Tienes un total de ".count($amigos)." amigos";

        //imagen titulo plataforma año 
        if ($_SESSION["usu"]==8) {
            foreach ($amigos as $key => $value) {
                echo'<tr>
                        <td>'.$value[2].'</td>
                        <td>'.$value[3].'</td>
                        <td>'.$value[4].'</td>
                        <td>'.$value[5].'</td>
                        <td><a href="index.php?action=modcont&amigo='.$value[1].'&nm='.$value[2].'&usu='.$value[0].'">Modificar </a></td>                        
                    </tr>';
            }
        } else {
            foreach ($amigos as $key => $value) {
                    echo'<tr>
                            <td>'.$value[1].'</td>
                            <td>'.$value[2].'</td>
                            <td>'.$value[3].'</td>
                            <td><a href="index.php?action=modamig&amigo='.$value[0].'&nm='.$value[1].'">Modificar </a></td>                        
                        </tr>';
                }
        }
        ?>
    </table>
    <div class="row">
        <a href="index.php?action=<?php if ($_SESSION["usu"]==8) echo 'nuevo_contacto';else echo 'nuevo_amigo' ?>"><?php if ($_SESSION["usu"]==8) echo 'Añadir nuevo Contacto';else echo 'Añadir nuevo amigo' ?></a> 
            
            
            
    </div>
    </div>
</section>