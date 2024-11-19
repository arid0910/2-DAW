<?php
echo "<h2>Detalles del usuario con id:".$id_usuario."</h2>";

if(isset($detalles_usuario))
{
    echo "<p><strong>Nombre: </strong>".$detalles_usuario["nombre"]."</p>";
    echo "<p><strong>Usuario: </strong>".$detalles_usuario["usuario"]."</p>";
    echo "<p><strong>Clave: </strong></p>";
    echo "<p><strong>DNI: </strong>".$detalles_usuario["dni"]."</p>";
    echo "<p><strong>Sexo: </strong>".$detalles_usuario["sexo"]."</p>";
    echo "<p><img src='Img/".$detalles_usuario["foto"]."' alt='Foto' title='Foto'/></p>";
    echo "<form action='index.php' method='post'><button>Atrás</button></form>";
}
else
    echo "<p>El usuario ya no se encuentra registrado en la BD</p>";
?>