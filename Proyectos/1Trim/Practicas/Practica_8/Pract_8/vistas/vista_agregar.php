<h2>Agregar nuevo usuario</h2>
<form action="index.php" method="post" enctype="multipart/form-data">
    <p>
        <label for="nombre">Nombre:</label><br/>
        <input type="text" name="nombre" id="nombre" placeholder="Nombre..." value="<?php if(isset($_POST["nombre"])) echo $_POST["nombre"];?>"/>
        <?php
        if(isset($_POST["btnContAgregar"]) && $error_nombre)
        {
            echo "<span class='error'>* Campo vacío *</span>";
        }
        ?>
    </p>
    <p>
        <label for="usuario">Usuario:</label><br/>
        <input type="text" name="usuario" id="usuario" placeholder="Usuario..."  value="<?php if(isset($_POST["usuario"])) echo $_POST["usuario"];?>"/>
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
        <label for="clave">Contraseña:</label><br/>
        <input type="password" name="clave" id="clave" value="" placeholder="Contraseña..." />
        <?php
        if(isset($_POST["btnContAgregar"]) && $error_clave)
        {
            echo "<span class='error'>* Campo vacío *</span>";
        }
        ?>
    </p>
    <p>
        <label for="email">DNI:</label><br/>
        <input type="text" name="dni" id="dni" placeholder="DNI: 12345678Z" value="<?php if(isset($_POST["dni"])) echo $_POST["dni"];?>"/>
        <?php
            if(isset($_POST["btnContAgregar"])&& $error_dni)
            {
                if($_POST["dni"]=="")
                    echo "<span class='error'> * Campo Vacío *</span>";
                elseif(!dni_bien_escrito($_POST["dni"]))
                    echo "<span class='error'> * DNI no está bien escrito *</span>";
                elseif(! dni_valido($_POST["dni"]))
                    echo "<span class='error'> * DNI no válido *</span>";
                else
                    echo "<span class='error'> * DNI repetido *</span>";
            }
               
            ?>
    </p>
    <p>
        <label>Sexo:</label><br/>
        <input type="radio" name="sexo" <?php if(!isset($_POST["sexo"]) || $_POST["sexo"]=="hombre") echo "checked";?> value="hombre" id="hombre"> <label for="hombre"> Hombre</label><br/>
        <input type="radio" name="sexo" <?php if(isset($_POST["sexo"]) && $_POST["sexo"]=="mujer") echo "checked";?> value="mujer" id="mujer"> <label for="mujer"> Mujer</label><br/>
    </p>
    <p>
        <label for="foto">Incluir mi foto (Archivo imagen con extensión, Máx. 500KB): </label>
        <input type="file" name="foto" accept="image/*"/>
        <?php
            if(isset($_POST["btnContAgregar"]) && $error_foto)
            {
                
                if($_FILES["foto"]["error"])
                    echo "<span class='error'>* No se ha subido el archivo seleccionado al servidor *</span>";
                elseif(!tiene_extension($_FILES["foto"]["name"]))
                    echo "<span class='error'>* Has seleccionado un fichero sin extensión *</span>";
                elseif(!getimagesize($_FILES["foto"]["tmp_name"]))
                    echo "<span class='error'>* No has seleccionado un fichero imagen *</span>";
                else
                    echo "<span class='error'>* El fichero seleccionado es mayor de 500KB *</span>";
            }
            ?>
    </p>
    <p>
        <button type="submit" name="btnContAgregar">Guardar cambios</button> 
        <button type="submit">Atrás</button>
    </p>    
</form>