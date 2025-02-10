<div class="container">
    <div class="my-5">
    <h1 class="text-center my-5">Añadir Prestamo</h1>
    </div>
<form action="index.php?action=insertar_prest" method="post">
    <label class="form-label" for="amig">Amigo</label>
    <select class="form-select" name="amig">
        <?php
            foreach ($amig as $key => $value) {
                echo '<option value="'.$value[0].'">'.$value[1].'</option>';
            }
        ?>
    </select>
    <br>
    <label class="form-label" for="jueg">Juego</label>
    <select class="form-select" name="jueg">
        <?php
            foreach ($jueg as $key => $value) {
                echo '<option value="'.$value[1].'">'.$value[0].'</option>';
            }
        ?>
    </select>
    <br>
    <input class="btn btn-primary" type="submit">
</form>
</div>

