<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teoria PDO</title>
</head>

<body>
    <h1>Teoria PDO</h1>
    <?php
        const SERVIDOR_BD = "localhost";
        const USUARIO_BD = "jose";
        const CLAVE_BD = "josefa";
        const NOMBRE_BD = "bd_foro";

        try {
            $conexion =new PDO("mysql:host=".SERVIDOR_BD.";dbname=".NOMBRE_BD."",USUARIO_BD,CLAVE_BD,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
        } catch (PDOException $e) {
            die(error_page("Ter_PDO", "<p>No se ha podido conectar a la BD: " . $e->getMessage() . "</p>"));
        }

        echo "<h2>Conectado</h2>";

        $usuario = "masantos";
        $clave = md5("123456");

        try {
            $consulta = "select * from usuarios where usuario = ? and clave = ?";
            $sentencia=$conexion->prepare($consulta);
            $sentencia->execute([$usuario, $clave]);
        } catch (PDOException $e) {
            $sentencia=null;
            $conexion=null;
            die(error_page("Ter_PDO", "<p>No se ha podido conectar a la BD: " . $e->getMessage() . "</p>"));
        }

        if ($sentencia->rowCount()<=0) {
            echo "<p>No hay usuarios en la BD</p>";
        }else{
            $tupla=$sentencia->fetch(PDO::FETCH_ASSOC);
            echo "<p>El nombre del usuario conectado es: ".$tupla["nombre"]."</p>";
        }

        //Cerrar conexión
        $conexion=null;
    ?>
</body>

</html>