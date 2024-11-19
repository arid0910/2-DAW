<?php
echo "<h2>Borrado del usuario con id:".$id_usuario."</h2>";

if(isset($detalles_usuario))
{
    echo "<form action='index.php' method='post'>";
    echo "<input type='hidden' name='foto_bd' value='".$detalles_usuario["foto"]."'/>";
    echo "<p>¿ Estás seguro que deseas borrar a <strong>".$detalles_usuario["nombre"]."</strong> ?</p>";
    echo "<p><button type='submit' value='".$id_usuario."' name='btnContBorrar'>Continuar</button> <button>Cancelar</button></p>";
    echo "</form>";
}
else
    echo "<p>El usuario ya no se encuentra registrado en la BD</p>";

?>