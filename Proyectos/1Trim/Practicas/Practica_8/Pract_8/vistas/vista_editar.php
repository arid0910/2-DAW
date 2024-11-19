<?php
if(isset($_POST["btnEditar"]))
{
    if(isset($detalles_usuario))
    {
        $nombre=$detalles_usuario["nombre"];
        $usuario=$detalles_usuario["usuario"];
        $dni=$detalles_usuario["dni"];
        $sexo=$detalles_usuario["sexo"];
        $foto_bd=$detalles_usuario["foto"];
    }
    else
        die("<p>El usuario ya no se encuentra registrado en la BD</p></body></html>");
}
else
{
    $id_usuario=$_POST["btnContEditar"];
    $nombre=$_POST["nombre"];
    $usuario=$_POST["usuario"];
    $email=$_POST["dni"];
    $sexo=$_POST["sexo"];
    $foto_bd=$_POST["foto_bd"];
}
?>

<h2>Editando al usuario <?php echo $id_usuario;?></h2>
<form action="index.php" method="post" enctype="multipart/form-data">
    <p>
        <label for="nombre">Nombre:</label><br/>
        <input type="text" name="nombre" id="nombre" placeholder="Nombre..." value="<?php echo $nombre;?>"/>
        <?php
        if(isset($_POST["btnContEditar"]) && $error_nombre)
        {
            echo "<span class='error'>* Campo vacío *</span>";
        }
        ?>
    </p>
    <p>
        <label for="usuario">Usuario:</label><br/>
        <input type="text" name="usuario" id="usuario" placeholder="Usuario..."  value="<?php echo $usuario;?>"/>
        <?php
        if(isset($_POST["btnContEditar"]) && $error_usuario)
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
        <input type="password" name="clave" id="clave" value="" placeholder="Teclee nueva contraseña" />
       
    </p>
    <p>
        <label for="email">DNI:</label><br/>
        <input type="text" name="dni" id="dni" placeholder="DNI: 12345678Z" value="<?php echo $dni;?>"/>
        <?php
            if(isset($_POST["btnContEditar"])&& $error_dni)
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
        <input type="radio" name="sexo" <?php if($sexo=="hombre") echo "checked";?> value="hombre" id="hombre"> <label for="hombre"> Hombre</label><br/>
        <input type="radio" name="sexo" <?php if($sexo=="mujer") echo "checked";?> value="mujer" id="mujer"> <label for="mujer"> Mujer</label><br/>
    </p>
    <p>
        <label for="foto">Incluir mi foto (Archivo imagen con extensión, Máx. 500KB): </label>
        <input type="file" name="foto" accept="image/*"/>
        <?php
            if(isset($_POST["btnContEditar"]) && $error_foto)
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
        <input type="hidden" name="foto_bd" value="<?php echo $foto_bd;?>"/>
        <button type="submit" name="btnContEditar" value="<?php echo $id_usuario;?>">Guardar cambios</button> 
        <button type="submit">Atrás</button>
    </p>    
</form>
