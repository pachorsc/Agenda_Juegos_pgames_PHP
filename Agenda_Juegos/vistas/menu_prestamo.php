<section class="list_jue">
    <div class="container">
        <div class="my-5">
            <h1 clas="text-center"><span class="text-primary">L</span>ista de <span class="text-primary">P</span>restamos</h1>
        </div>
        <form class="d-flex my-5" action="index.php?action=menu_prestamos" method="post">
            <input class="form-control me-2" name="nm" type="search" placeholder="Amigo / juego" aria-label="Search">
            <input class="btn btn-outline-success" name="buscar" value="Buscar" type="submit"></input>
        </form>

    <table class="table table-hover">
        <tr>
            <th>Usuario</th>
            <th>Juego</th>
            <th>Amigo</th>
            <th>Fecha</th>
            <th>Estado</th>
            <th></th>
        </tr>
        <?php
        echo "Tienes un total de ".count($arr_prestamo)." Prestamos";

        //imagen titulo plataforma año 
        foreach ($arr_prestamo as $key => $value) {
             $estado = "Entregado";
            if ($value[4] ==1) $estado = "Pendiente";
                echo'<tr>
                        <td>'.$value[0].'</td>
                        <td>'.$value[1].'</td>
                        <td>'.$value[2].'</td>
                        <td>'.$value[3].'</td> 
                        <td>'.$estado.'</td>';


                        if ($value[4] ==1) {
                            echo '<td><a href="index.php?action=entregar_jueg&&jueg='.$value[5].'">Modificar</a></td>';
                        } else echo'<td></td>';


                       echo '</tr>';
            }
        ?>
    </table>
    <div class="row">
        <a href="index.php?action=nuevo_prest">Añadir nuevo prestamo</a>
    </div>
    </div>
    
</section>