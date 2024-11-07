<?php
 echo "<table>";
 echo "<tr><th>Nombre de Usuario</th><th>Borrar</th><th>Editar</th></tr>";
 while($tupla=mysqli_fetch_assoc($datos_usuarios))
 {
     echo "<tr>";
     echo "<td><form action='index.php' method='post'><button class='enlace' type='submit' name='btnDetalles' title='Ver Detalles' value='".$tupla["id_usuario"]."'>".$tupla["nombre"]."</button></form></td>";
     echo "<td><form action='index.php' method='post'><button class='btn_img' type='submit' value='".$tupla["id_usuario"]."' name='btnBorrar'><img src='images/borrar.png' title='Borrar Usuario' alt='Borrar Usuario'/></button></form></td>";
     echo "<td><form action='index.php' method='post'><button class='btn_img' type='submit' value='".$tupla["id_usuario"]."' name='btnEditar'><img src='images/editar.png' title='Editar Usuario' alt='Editar Usuario'/></button></form></td>";
     echo "</tr>";
 }
 echo "<tr><td colspan='3'><form action='index.php' method='post'><button class='enlace' type='submit' name='btnAgregar'>Agregar Usuario</button></form></td></tr>";
 echo "</table>";
 mysqli_free_result($datos_usuarios);
 ?>