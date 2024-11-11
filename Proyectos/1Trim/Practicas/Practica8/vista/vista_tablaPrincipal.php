<table>
        <tr>
            <th>#</th>
            <th>Foto</th>
            <th>Nombre</th>
            <th>
                <form action='index.php' method='post'>
                    <span>Usuario<button class='enlace' type='submit' name='btnAgregar'>+</button></span>
                </form>
            </th>
        </tr>
        <?php
        while( $tupla = mysqli_fetch_assoc($datos_usuarios)){
            echo "<tr>";
                echo "<td>".$tupla["id_usuario"]."</td>";
                echo "<td><img src='Img/".$tupla["foto"]."' alt='Foto default'></td>";
                echo "<td>";
                    echo "<form action='index.php' method='post'>
                            <button class='enlace' type='submit' name='btnDetalles' value='".$tupla["id_usuario"]."'>".$tupla["nombre"]."</button>
                        </form>";
              echo "</td>";
                echo "<td>";
                    echo "<form action='index.php' method='post'>
                            <button class='enlace' type='submit' name='btnBorrar' value='".$tupla["id_usuario"]."'>Borrar</button>
                            <span> - </span>
                            <button class='enlace' type='submit' name='btnEditar' value='".$tupla["id_usuario"]."'>Editar</button>
                        </form>";
                echo "</td>";
            echo "</tr>";
        }
        mysqli_free_result($datos_usuarios);
        ?>
</table>