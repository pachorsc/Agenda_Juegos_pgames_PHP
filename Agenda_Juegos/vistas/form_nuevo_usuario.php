<div class="container">
    <h1 class="text-center">Nuevo Usuario</h1>
    <form action="index.php?action=insertar_usuario" method="post">
        <label for="nm">Nombre de Usuario</label>
        <br>
        <input class="form-control" type="text" name="nm" required>
        <br>
        <label for="cnt">Contraseña</label>
        <br>
        <input class="form-control" name="cnt" type="password" required>
        <br>
        <label for="fch">Fecha de nacimineto</label>
        <br>
        <input class="form-control" name="fch" type="date" required min="<?php echo (getdate()["year"])-60; ?>-01-01" max="<?php echo (getdate()["year"])-7; ?>-01-01">
        <br>
        <input class="btn btn-primary" type="submit" value="Insertar">
    </form>
</div>