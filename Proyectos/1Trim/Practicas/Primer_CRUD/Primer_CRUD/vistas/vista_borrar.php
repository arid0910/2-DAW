<?php
echo "<h2>Borrado del usuario ".$_POST["btnBorrar"]."</h2>";
if(mysqli_num_rows($detalle_usuario)>0)
{
    $tupla_detalles=mysqli_fetch_assoc($detalle_usuario);
    echo "<p>¿Estás seguro que quires borrar al usuario <strong>".$tupla_detalles["nombre"]."</strong>?</p>";
    echo "<form action='index.php' method='post'>";
    echo "<button type='submit' value='".$_POST["btnBorrar"]."' name='btnContBorrar'>Continuar</button> ";
    echo " <button type='submit'>Atrás</button>";
    echo "</form>";
}
else
{
    echo "<p>El usuario ya no se encuentra registrado en la BD</p>";
}
mysqli_free_result($detalle_usuario);
?>