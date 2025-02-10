<?php

if(isset($_POST["btnEditar"]))
{
    $_SESSION["mensaje_accion"]="El libro con referencia ".$_POST["referencia"]." se ha editado con éxito";
    header("location:gest_libros.php");
    exit;
}

if(isset($_POST["btnBorrar"]))
{
    $_SESSION["mensaje_accion"]="El libro con referencia ".$_POST["referencia"]." se ha borrado con éxito";
    header("location:gest_libros.php");
    exit;
}

if(isset($_POST["btnAgregar"]))
{
    $error_referencia=$_POST["referencia"]=="" || !is_numeric($_POST["referencia"])|| $_POST["referencia"]<=0;
    if(!$error_referencia)
    {
        $error_referencia=repetido($conexion, "libros","referencia", $_POST["referencia"]);
        if(is_string($error_referencia))
        {
            session_destroy();
            $conexion=null;
            die(error_page("Examen 2 PDO","<p>No se ha podido conectar a la BD: ".$e->getMessage()."</p>"));
        }
    }
    $error_titulo=$_POST["titulo"]=="";
    $error_autor=$_POST["autor"]=="";
    $error_descripcion=$_POST["descripcion"]=="";
    $error_precio= $_POST["precio"]=="" || !is_numeric($_POST["precio"])|| $_POST["precio"]<=0;
    $error_portada=$_FILES["portada"]["name"]!="" && ($_FILES["portada"]["error"] ||!extension($_FILES["portada"]["name"]) || !getimagesize($_FILES["portada"]["tmp_name"]) || $_FILES["portada"]["size"]>500*1024 );
    
    $error_form=$error_referencia || $error_titulo || $error_autor || $error_descripcion ||$error_precio || $error_portada;

    if(!$error_form)
    {

        try{
            $consulta="insert into libros (referencia, titulo, autor, descripcion, precio) values (?,?,?,?,?)";
            $sentencia=$conexion->prepare($consulta);
            $sentencia->execute([$_POST["referencia"],$_POST["titulo"],$_POST["autor"],$_POST["descripcion"],$_POST["precio"]]);
            $sentencia=null;
        }
        catch(PDOException $e){
            session_destroy();
            $sentencia=null;
            $conexion=null;
            die(error_page("Examen 2 PDO","<p>No se ha podido conectar a la BD: ".$e->getMessage()."</p>"));
        }
        $_SESSION["mensaje_accion"]="Libro agregado con éxito";

        if($_FILES["portada"]["name"]!="")
        {
            $extension=".".extension($_FILES["portada"]["name"]);
            $nombre_portada="img".$_POST["referencia"].$extension;
            @$var=move_uploaded_file($_FILES["portada"]["tmp_name"],"../Images/".$nombre_portada);
            if($var)
            {
                try{
                    $consulta="update libros set portada=? where referencia=?";
                    $sentencia=$conexion->prepare($consulta);
                    $sentencia->execute([$nombre_portada,$_POST["referencia"]]);
                    $sentencia=null;
                }
                catch(PDOException $e){
                    unlink("../Images/".$nombre_portada);
                    $_SESSION["mensaje_accion"]="Libro agregado con éxito pero con la imagen por defecto por un error en la consulta de actualización en la BD.";
                }
            }
            else
                $_SESSION["mensaje_accion"]="Libro agregado con éxito pero con la imagen por defecto por no poder mover la imagen subida a la carpeta destino.";

        }
        $conexion=null;
        header("location:gest_libros.php");
        exit;
    }
}


try{
    $consulta="select * from libros";
    $sentencia=$conexion->prepare($consulta);
    $sentencia->execute();
    $libros=$sentencia->fetchAll(PDO::FETCH_ASSOC);
    $sentencia=null;
}
catch(PDOException $e){
    $sentencia=null;
    $conexion=null;
    session_destroy();
    die(error_page("Examen 2 PDO","<p>No se ha podido realizar la consulta: ".$e->getMessage()."</p>"));
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen 2 PDO</title>
    <style>
        .enlinea{display:inline}
        .enlace{background:none;border:none;color:blue;text-decoration: underline;cursor: pointer;}
        table, th, td{border:1px solid black}
        table{width:70%; margin:0 auto; text-align: center; border-collapse: collapse;}
        th{background-color: #CCC;}
        .mensaje{font-size:1.25em;color:blue}
        .error{color:red}
    </style>
</head>
<body>
    <h1>Libreria</h1>
    <div>
        Bienvenido <strong><?php echo $datos_lector_log["lector"];?></strong> - <form class="enlinea" action="../index.php" method="post"><button class="enlace" type="submit" name="btnCerrarSesion">Salir</button></form>
    </div>
    <?php
    if(isset($_SESSION["mensaje_accion"]))
    {
        echo "<p class='mensaje'>".$_SESSION["mensaje_accion"]."</p>";
        unset($_SESSION["mensaje_accion"]);
    }
    ?>
    <h2>Listado de los libros</h2>
    <?php
    echo "<table>";
    echo "<tr><th>Ref</th><th>Título</th><th>Acción</th></tr>";
    foreach($libros as $tupla)
    {
        echo "<tr>";
        echo "<td>".$tupla["referencia"]."</td>";
        echo "<td>".$tupla["titulo"]."</td>";
        echo "<td>";
        echo "<form action='gest_libros.php' method='post'>";
        echo "<input type='hidden' value='".$tupla["referencia"]."' name='referencia'/>";
        echo "<button class='enlace' type='submit' name='btnBorrar'>Borrar</button> - <button class='enlace' type='submit' name='btnEditar'>Editar</button>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
    ?>
    <h2>Agregar un libro</h2>
    <form action="gest_libros.php" method="post" enctype="multipart/form-data">
        <p>
            <label for="referencia">Referencia:</label>
            <input type="text" name="referencia" value="<?php if(isset($_POST["referencia"])) echo $_POST["referencia"];?>" id="referencia"/>
            <?php
            if(isset($_POST["btnAgregar"])&& $error_referencia)
            {
                if($_POST["referencia"]=="")
                    echo "<span class='error'>* Campo Vacío *</span>";
                elseif(!is_numeric($_POST["referencia"])|| $_POST["referencia"]<=0)
                    echo "<span class='error'>* No has tecleado un número positivo mayor que cero *</span>";
                else
                    echo "<span class='error'>* Referencia repetida *</span>";
            }
            ?>
        </p>    
        <p>
            <label for="titulo">Título:</label>
            <input type="text" name="titulo" value="<?php if(isset($_POST["titulo"])) echo $_POST["titulo"];?>" id="titulo"/>
            <?php
                if(isset($_POST["btnAgregar"])&& $error_titulo)
         
                    echo "<span class='error'>* Campo Vacío *</span>";
            ?>
        </p>
        <p>
            <label for="autor">Autor:</label>
            <input type="text" name="autor" value="<?php if(isset($_POST["autor"])) echo $_POST["autor"];?>" id="autor"/>
            <?php
                if(isset($_POST["btnAgregar"])&& $error_autor)
         
                    echo "<span class='error'>* Campo Vacío *</span>";
            ?>
        </p>
        <p>
            <label for="descripcion">Descripción:</label>
            <textarea name="descripcion" id="descripcion"><?php if(isset($_POST["descripcion"])) echo $_POST["descripcion"];?></textarea>
            <?php
                if(isset($_POST["btnAgregar"])&& $error_descripcion)
         
                    echo "<span class='error'>* Campo Vacío *</span>";
            ?>
        </p>
        <p>
            <label for="precio">Precio:</label>
            <input type="text" name="precio" value="<?php if(isset($_POST["precio"])) echo $_POST["precio"];?>" id="precio"/>
            <?php
            if(isset($_POST["btnAgregar"])&& $error_precio)
            {
                if($_POST["precio"]=="")
                    echo "<span class='error'>* Campo Vacío *</span>";
                else
                    echo "<span class='error'>* El precio debe ser mayor que cero *</span>";
            }
            ?>
        </p>
        <p>
            <label for="portada">Portada:</label>
            <input type="file" name="portada" id="portada" accept="image/*"/>
            <?php
                if(isset($_POST["btnAgregar"])&& $error_portada)
                {
                    if($_FILES["portada"]["error"])
                        echo "<span class='error'>* Error en la subida del fichero al Servidor *</span>";
                    elseif(!extension($_FILES["portada"]["name"]))
                        echo "<span class='error'>* El archivo seleccionado no tiene extensión *</span>";
                    elseif( !getimagesize($_FILES["portada"]["tmp_name"]))
                        echo "<span class='error'>* El archivo seleccionado no es un archivo imagen *</span>";
                    else
                        echo "<span class='error'>* El archivo seleccionado supera los 500KB *</span>";
                }
            ?>
        </p>
        <p>
            
            <input type="submit" name="btnAgregar" value="Agregar"/>
        </p> 
    </form>
</body>
</html>