<h2>Borrar la foto del usuario <?php echo $_POST["btnBorrarFoto"];?></h2>
<p><img src="Img/<?php echo $_POST["foto_bd"];?>" alt="Foto" title="Foto"/></p>
<form action="index.php" method="post">
    <p>
        <input type="hidden" name="foto_bd" value="<?php echo $_POST["foto_bd"];?>"/>
        <button type="submit" name="btnContBorrarFoto" value="<?php echo $_POST["btnBorrarFoto"];?>">Continuar</button> 
        <button type="submit">Atrás</button>
    </p>
</form>
