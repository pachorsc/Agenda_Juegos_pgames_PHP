<div class="container">
    <div class="my-5">
        <h1><span class="text-primary">N</span>uevo <span class="text-primary">C</span>ontacto</h1>
    </div>
<form action="index.php?action=insertar_contacto" method="post">
    <label class="form-label" for="nm" >Nombre</label><br>
    <input class="form-control" type="text" name="nm" required>
    <br><label class="form-label" for="apll">Apellido</label><br>
    <input class="form-control" type="text" name="apll" required>
    <br>
    <label class="form-label" for="fch">Fecha de nacimiento</label><br>
    <input class="form-control" type="date" name="fch" required min="<?php echo (getdate()["year"])-60; ?>-01-01" max="<?php echo (getdate()["year"])-7; ?>-01-01">
    <br>
    <?php
        echo '<label class="form-label" for="fch">Nuevo dueño</label><br>';
        echo '<select name="nusu">';
        
        foreach ($amigos as $key => $value) {
            echo '<option value='.$value[1].'>'.$value[0].'</option>';
        }
        
        echo'</select> <br><br>';

    ?>
    <input class="btn btn-primary" type="submit">
</form>
</div>