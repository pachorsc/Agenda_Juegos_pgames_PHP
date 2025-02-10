
<section class="list_jue">
    <div class="container">
        <div class="my-5">
            <h1 class="text-center"><span class="text-primary">L</span>ista de <span class="text-primary">J</span>uegos</h1>
        </div>
        <div class="container">
            <form class="d-flex my-5" action="index.php?action=menu_juegos" method="post">
                <input class="form-control me-2" name="nm" type="search" placeholder="Amigo" aria-label="Search">
                <input class="btn btn-outline-success" name="buscar" value="Buscar" type="submit"></input>
            </form>
        </div>
    <table class="table table-hover">
        <tr>
            <th>Juego</th>
            <th>Titulo</th>
            <th>plataforma</th>
            <th>Año de lanzamiento</th>
            <th></th>
        </tr>
        <?php
        echo "Tienes un total de ".count($arr_jueg)." juegos";

        //imagen titulo plataforma año 
        foreach ($arr_jueg as $key => $value) {
            $plat="Todas";
            if ($value[1] == 1) {
                $plat = "PC";
            } else if ($value[1] == 2) {
                $plat = "Consola";

            }
                echo'<tr>
                        <td class="text-center"><img class="img-fluid w-75" style="max-height:200px; max-width:300px" src="'.$value[2].'" alt=""></td>
                        <td>'.$value[0].'</td>
                        <td>'.$plat.'</td>
                        <td>'.$value[3].'</td>
                        <td><a href="index.php?action=mod_game&&jueg='.$value[4].'">Modificar</a></td>                        
                    </tr>';
            }

        ?>
    </table>
    </div>
</section>

        