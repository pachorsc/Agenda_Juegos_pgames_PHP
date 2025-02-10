<div class="container">
    <div class="my-5">
        <h1 class="text-center"><span class="text-primary">C</span>ambiando <?php echo  $juego[0]?></h1>
    </div>
    <form action="index.php?action=act_juego" method="post" enctype="multipart/form-data">
        <label class="form-label" for="nm" >Nombre</label><br>
        <input class="form-control" type="text" name="nm" value="<?php echo  $juego[0]?>">
        <br><label class="form-label" for="plat">plataforma</label><br>
        <select name="plat">
            <option value="1" value="<?php if ($juego[1]==1) {echo "selected";}?>">PC</option>
            <option value="2" <?php if ($juego[1]==2) {echo "selected";}?>>Consola</option>
            <option value="3" <?php if ($juego[1]==3) {echo "selected";}?>>Ambas</option>
        </select>
        <br>
        <label class="form-label" for="fch">Fecha de Lanzamiento</label><br>
        <input class="form-control" type="date" name="fch" value="<?php echo  $juego[2]?>" min="<?php echo (getdate()["year"])-60; ?>-01-01" max="<?php echo getdate()["year"];?>-12-30">
        <br>
        <label class="form-label" for="img">Imagen</label><br>
        <input class="form-control" type="file" name="img" value="<?php echo  $juego[3]?>">
        <br>
        <input class="btn btn-primary" type="submit">
    </form>
</div>