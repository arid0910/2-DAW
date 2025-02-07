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