
<h2>Agregando un nuevo usuario</h2>
<form action="index.php" method="post">
    <p>
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" value="<?php if(isset($_POST["nombre"])) echo $_POST["nombre"];?>"/>
        <?php
        if(isset($_POST["btnContAgregar"]) && $error_nombre)
        {
            echo "<span class='error'>* Campo vacío *</span>";
        }
        ?>
    </p>
    <p>
        <label for="usuario">Usuario:</label>
        <input type="text" name="usuario" id="usuario" value="<?php if(isset($_POST["usuario"])) echo $_POST["usuario"];?>"/>
        <?php
        if(isset($_POST["btnContAgregar"]) && $error_usuario)
        {
            if($_POST["usuario"]=="")
                echo "<span class='error'>* Campo vacío *</span>";
            else
                echo "<span class='error'>* Usuario repetido *</span>";
        }
        ?>
    </p>  
    <p>
        <label for="clave">Contraseña:</label>
        <input type="password" name="clave" id="clave" value=""/>
        <?php
        if(isset($_POST["btnContAgregar"]) && $error_clave)
        {
            echo "<span class='error'>* Campo vacío *</span>";
        }
        ?>
    </p>
    <p>
        <label for="email">Email:</label>
        <input type="text" name="email" id="email" value="<?php if(isset($_POST["email"])) echo $_POST["email"];?>"/>
        <?php
        if(isset($_POST["btnContAgregar"]) && $error_email)
        {
            if($_POST["email"]=="")
                echo "<span class='error'>* Campo vacío *</span>";
            elseif(!filter_var($_POST["email"],FILTER_VALIDATE_EMAIL))
                echo "<span class='error'>* Email sintácticamente incorrecto *</span>";
            else
                echo "<span class='error'>* Email repetido *</span>";
        }
        ?>
    </p>
    <p>
        <button type="submit" name="btnContAgregar">Continuar</button> 
        <button type="submit">Atrás</button>
    </p>    
</form>