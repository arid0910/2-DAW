<?php
    const SERVIDOR_BD = "localhost";
    const USUARIO_BD = "jose";
    const PASSWORD_BD = "josefa";
    const NOMBRE_BD = "bd_foro";

    function error_page($title, $body){
        return '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>'.$title.'</title>
        </head>
        <body>'.
            $body
        .'</body>
        </html>';

    }

    //Conexion
    try {
        @$conexion = mysqli_connect(hostname: SERVIDOR_BD, username: USUARIO_BD, password: PASSWORD_BD, database: NOMBRE_BD);
        mysqli_set_charset($conexion, "utf8");
    } catch (Exception $e) {
        die(error_page("Primer Crud", "<p>No se a podido conectar a la BD: ".$e->getMessage()));
    }

    //Detalles usuario
    if(isset($_POST["btnDetalles"])){
        try {
            $consulta = "select * from usuarios where id_usuario='".$_POST["btnDetalles"]."'";
            $detalle_usuario = mysqli_query($conexion, $consulta);
        } catch (Exception $e) {
            mysqli_close($conexion);
            die(error_page("Primer Crud", "<p>No se a podido realizar la consulta: ".$e->getMessage()));
        }
    }

    //Borrar usuario
    if(isset($_POST["btnBorrar"])){
        try {
            $consulta = "select * from usuarios where id_usuario='".$_POST["btnBorrar"]."'";
            $borrar_usuario = mysqli_query($conexion, $consulta);
        } catch (Exception $e) {
            mysqli_close($conexion);
            die(error_page("Primer Crud", "<p>No se a podido realizar la consulta: ".$e->getMessage()));
        }
    }

    //Consulta
    try {
        $consulta = "select * from usuarios";
        $datos_usuarios = mysqli_query($conexion, $consulta);
    } catch (Exception $e) {
        mysqli_close($conexion);
        die(error_page("Primer Crud", "<p>No se a podido realizar la consulta: ".$e->getMessage()));
    }

    mysqli_close($conexion);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Primer CRUD</title>
    <style>
        table, td, tr, th {
            border: 1px solid black;
            padding: 1em;
        }

        table{
            border-collapse: collapse;
            text-align: center;
        }

        .enlace{
            border: none;
            background: none;
            color: blue;
            text-decoration: underline;
            cursor: pointer;
        }

        .noBack{
            background: none;
            border: none;
        }
    </style>
</head>
<body>
    <h1>Listado de los usuarios</h1>
    <?php
        echo "<table>";
            echo "<tr>
                <th>Nombre Usuario</th>
                <th>Borrar</th>
                <th>Editar</th>
            </tr>";
            while($tupla=mysqli_fetch_assoc($datos_usuarios)){
            echo "<tr>";
                echo "<td>
                <form action='crud1.php' method='post'>
                <button type='submit' class='enlace' name='btnDetalles' value='".$tupla["id_usuario"]."'>".$tupla["nombre"]."</button>
                </form>
                </td>";
                echo "<td>
                <form action='crud1.php' method='post'>
                    <button class='noBack' type='submit' name='btnBorrar' value='".$tupla["id_usuario"]."'>
                        <img src='images/delete.png' title='borrar usuario' alt='borrar usuario' width='50px'> 
                    </button>
                </form></td>";
                echo "<td>
                <form action='crud1.php' method='post'>
                    <button class='noBack' type='submit' name='btnEditar'>
                        <img src='images/lapiz.png' title='editar usuario' alt='editar usuario' width='50px'> 
                    </button>
                </form></td>";
            echo "</tr>";
            }

        echo "</table>";
        mysqli_free_result($datos_usuarios);

        if(isset($_POST["btnDetalles"])){

            echo "<h2>Detalles del usuario".$_POST["btnDetalles"]."</h2>";

            if(mysqli_num_rows($detalle_usuario) > 0){
                $tupla_detalles = mysqli_fetch_assoc($detalle_usuario);

                echo "<p><strong>Nombre: </strong>".$tupla_detalles["nombre"]."</p>";
                echo "<p><strong>Usuario: </strong>".$tupla_detalles["usuario"]."</p>";
                echo "<p><strong>Clave: </strong><br></p>";
                echo "<p><strong>Email: </strong>".$tupla_detalles["email"]."</p>";
            } else {
                echo "<p>El usuario ya no existe en la BD</p>";
            }
            
            mysqli_free_result($detalle_usuario);
        }

        if(isset($_POST["btnBorrar"])){
            if(mysqli_num_rows($borrar_usuario) > 0){
                $tupla_borrar = mysqli_fetch_assoc($borrar_usuario);
                echo "<p>Se dispone usted a borrar el usuario <strong>".$tupla_borrar["nombre"]."</strong></p>";
                echo "<form action='crud1.php' method='post'>";
                    echo "<button type='submit' name='btnConfi'>Confirmar</button>";
                    echo "<button type='submit' name='btnAtras'>Atras</button>";
                echo "</form>";

                if(isset($_POST["btnConfi"])){
                    $consulta = "delete from usuarios where id_usuario = ".$_POST["btnBorrar"]."";
                    $datos_usuarios = mysqli_query($conexion, $consulta);
                }

            } else {
                echo "<p>El usuario ya no existe en la BD</p>";
            }
            mysqli_free_result($borrar_usuario);
        }
    ?>

</body>
</html>