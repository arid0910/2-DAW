<?php
echo "<h1>Recogida de Datos</h1>";
echo "<p><strong>Nombre: </strong>".$_POST["nombre"]."</p>";

echo "<p><strong>Apellidos: </strong>".$_POST["apellidos"]."</p>";

echo "<p><strong>Contraseña: </strong>".$_POST["clave"]."</p>";

echo "<p><strong>DNI: </strong>".$_POST["dni"]."</p>";

echo "<p><strong>Sexo: </strong>";
if(isset($_POST["sexo"]))
{
    echo $_POST["sexo"];
}
echo "</p>";

if (isset($_POST["btnEnviar"]) && !$error_foto && $_FILES["foto"]["name"] != "") {
    echo "<h3>Información de imagen subida</h3>";
    $num_unico = md5(uniqid(uniqid(), true)); //genera un numero unico
    $ext = tiene_extension($_FILES["foto"]["name"]);
    $nom_imagen = "img_".$num_unico.".".$ext;

    //Para mover archivos
    //@ no ver errores
    @$var = move_uploaded_file($_FILES["foto"]["tmp_name"], "images/".$nom_imagen);

    if (!$var) {
        echo "<p>No se a podido mover a la carpeta destino</p>";
    } else {
        echo "<p><strong>Nombre original: </strong>".$_FILES["foto"]["name"]."</p>";
        echo "<p><strong>Tipo: </strong>".$_FILES["foto"]["type"]."</p>";
        echo "<p><strong>Tamaño: </strong>".$_FILES["foto"]["size"]."</p>";
        echo "<p><strong>Archivo subido temporalmente en: </strong>".$_FILES["foto"]["tmp_name"]."</p>";
        echo "<p><img src='images/".$nom_imagen."' alt='Imagen Subida' tittle='Imagen Subida'</p>";
    }
}

echo "<p><strong>Nacido: </strong>".$_POST["nacido"]."</p>";

echo "<p><strong>Comentarios: </strong>".$_POST["comentarios"]."</p>";

echo "<p><strong>Subcripción: </strong>";

if(isset($_POST["subcripcion"]))
{
    echo "Sí"; 
}
else
{
    echo "No";
}
echo "</p>";
?>