<?php
echo "<h2>Detalles del usuario ".$_POST["btnDetalles"]."</h2>";
if(mysqli_num_rows($detalle_usuario)>0)
{
    $tupla_detalles=mysqli_fetch_assoc($detalle_usuario);
    echo "<p>";
    echo "<strong>Nombre: </strong>".$tupla_detalles["nombre"]."<br/>";
    echo "<strong>Usuario: </strong>".$tupla_detalles["usuario"]."<br/>";
    echo "<strong>Clave: </strong><br/>";
    echo "<strong>Email: </strong>".$tupla_detalles["email"]."<br/>";
    echo "</p>";
}
else
{
    echo "<p>El usuario ya no se encuentra registrado en la BD</p>";
}
mysqli_free_result($detalle_usuario);
?>