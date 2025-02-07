<?php
echo "<h3>Listado de los usuarios</h3>";
echo "<table>";
echo "<tr>";
echo "<th>#</th><th>Foto</th><th>Nombre</th><th><form action='index.php' method='post'><button type='submit' name='btnAgregar' class='enlace'>Usuario+</button></form></th>";
echo "</tr>";
while($tupla_datos_usuario=mysqli_fetch_assoc($result_datos_usuarios))
{
    echo "<tr>";
    echo "<td>".$tupla_datos_usuario["id_usuario"]."</td>";
    if($tupla_datos_usuario["foto"]==NOMBRE_IMAGEN_DEFECTO_BD)
        echo "<td><img src='Img/".$tupla_datos_usuario["foto"]."' alt='Foto' title='Foto'/></td>";
    else
        echo "<td><form action='index.php' method='post'><input type='hidden' name='foto_bd' value='".$tupla_datos_usuario["foto"]."'/><button class='enlace' name='btnBorrarFoto' value='".$tupla_datos_usuario["id_usuario"]."' type='submit' ><img src='Img/".$tupla_datos_usuario["foto"]."' alt='Foto' title='Pulse para borrar foto'/></button></form></td>";
    echo "<td>";
    echo "<form action='index.php' method='post'><button title='Pulse para ver detalles' class='enlace' name='btnDetalles' value='".$tupla_datos_usuario["id_usuario"]."' type='submit' >".$tupla_datos_usuario["nombre"]."</button></form>";
    echo "</td>";
    echo "<td><form action='index.php' method='post'><input name='id_usuario' type='hidden' value='".$tupla_datos_usuario["id_usuario"]."'/><button class='enlace' type='submit' name='btnBorrar'>Borrar</button> - <button class='enlace' type='submit' name='btnEditar'>Editar</button></form></td>";
    echo "</tr>";
}
echo "</table>";
?>