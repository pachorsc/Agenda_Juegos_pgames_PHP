<div class="container">
    <div class="my-4">
        <h1><span class="text-primary">M</span>odificar <span class="text-primary">U</span>suario</h1>
    </div>
    <form action="index.php?action=update_usuario" method="post">
        <label for="nm">Nuevo nombre</label>
        <br>
        <input type="text" name="nm" value="<?php echo $usuario[0];?>">
        <br>
        <label for="fch">Fecha de nacimiento</label>
        <br>
        <input type="date" name="fch" value="<?php echo $usuario[3];?>" min="<?php echo (getdate()["year"])-60; ?>-01-01" max="<?php echo (getdate()["year"])-7; ?>-01-01">
        <br>
        <label for="cnt">Nueva Contraseña</label>
        <br>
        <input type="password" name="cnt" value="<?php echo $usuario[2];?>">
        <br>
        <input type="submit">
    </form>
</div>