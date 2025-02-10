<h1 class="text-center"><span class="text-primary">M</span>odificar a <?php echo  $amigos[0]?></h1>
<div class="container">
<form action="index.php?action=actualizar_<?php if ($_SESSION['usu']==8){echo'contacto';}else{echo 'amigo';}?>" method="post">
    <label class="form-label" for="nm" >Nuevo Nombre</label><br>
    <input class="form-control" type="text" name="nm" value="<?php echo $amigos[0]?>">
    <br><label class="form-label" for="apll">Nuevo Apellido</label><br>
    <input class="form-control" type="text" name="apll" value="<?php echo $amigos[1]?>">
    <br>
    <label class="form-label" for="fch">Nueva Fecha de nacimiento</label><br>
    <!-- se comprueba con el min y max la fechas limites -->
    <input class="form-control" type="date" name="fch" value="<?php echo $amigos[2]?>" min="<?php echo (getdate()["year"])-60; ?>-01-01" max="<?php echo (getdate()["year"])-7; ?>-01-01">
    <br>
    <?php
        if ($_SESSION['usu']==8){
            echo '<label class="form-label" for="fch">Nuevo dueño</label><br>';
            echo '<select name="nusu">';
            
            foreach ($amigos_list as $key => $value) {
                $dueno="";
                if ( $value[1] == $amigos[3]) {
                    $dueno = "selected";
                } 
                echo '<option value="'.$value[1].'" '.$dueno.'>'.$value[0].'</option>';
            }
            
            echo'</select> <br><br>';
        }
    ?>
    <input class="btn btn-primary" type="submit">
</form>
</div>