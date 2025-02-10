<h1 class="text-center"><span class="text-primary">U</span>suarios</h1>

<div class="container">
<form class="d-flex my-5" action="index.php?action=menu_admin_usuarios" method="post">
        <input class="form-control me-2" name="nm" type="search" placeholder="Amigo" aria-label="Search">
        <input class="btn btn-outline-success" name="buscar" value="Buscar" type="submit"></input>
</form>
<table class="table">
    <tr>
        <th>Id</th>
        <th>Nombre</th>
        <th>contraseña</th>
        <th></th>
    </tr>
    <?php
    foreach ($usuarios as $key => $value) {
        $long= strlen($value[2]);
        $cnt = str_repeat("*", $long);
        echo '<tr>
                <td>'.$value[1].'</td>
                <td>'.$value[0].'</td>
                <td>'.$cnt.'</td>
                <td><a href="index.php?action=mod_usu&usu='.$value[1].'">Modificar</a></td>
            </tr>';
    }

    ?>

    
</table>
<a href="index.php?action=nuevo_usuario">Añadir nuevo Usuario</a>
</div>