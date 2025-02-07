<h1>Librería</h1>
<form action="index.php" method="post" enctype="multipart/form-data">
    <p>
        <label for="usuario">Usuario: </label>
        <input type="text" name="usuario" id="usuario" value="<?php if (isset($_POST["usuario"])) echo $_POST["usuario"] ?>">
        <?php
        if (isset($_POST["btnEntrar"]) && $error_usuario) {
            echo "<span class='error'>*Campo vacio*</span>";
        }
        ?>
    </p>

    <p>
        <label for="clave">Contraseña: </label>
        <input type="password" name="clave" id="clave">
        <?php
        if (isset($_POST["btnEntrar"]) && $error_clave) {
            echo "<span class='error'>*Campo vacio*</span>";
        }
        ?>
    </p>


    <p>
        <?php
        if (isset($_POST["btnEntrar"]) && !$usuario_valido && !$error_form) echo "<span class='error'>*Usuario o contraseña invalido*</span>"
        ?>
    </p>

    <button type="submit" name="btnEntrar">Entrar</button>
</form>