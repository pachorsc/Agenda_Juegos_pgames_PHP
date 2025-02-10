<div class="container">
<form action="index.php?action=insertar_amigo" method="post">
    <label class="form-label" for="nm" >Nombre</label><br>
    <input class="form-control" type="text" name="nm" required>
    <br><label class="form-label" for="apll">Apellido</label><br>
    <input class="form-control" type="text" name="apll" required>
    <br>
    <label class="form-label" for="fch">Fecha de nacimiento</label><br>
    <input class="form-control" type="date" name="fch" required min="<?php echo (getdate()["year"])-60; ?>-01-01" max="<?php echo (getdate()["year"])-7; ?>-01-01">
    <br>
    <input class="btn btn-primary" type="submit">
</form>
</div>