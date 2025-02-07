<?php
try {
    $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD . "", USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
} catch (PDOException $e) {
    die(error_page("Ter_PDO", "<p>No se ha podido conectar a la BD: " . $e->getMessage() . "</p>"));
}

// Me he conectado y ahora hago la consulta
try {
    $consulta = "select * from usuarios where usuario = ? and clave = ?";
    $result_select=$conexion->prepare($consulta);
    $result_select->execute([$_SESSION["usuario"], $_SESSION["clave"]]);
} catch (PDOException $e) {
    $result_select=null;
    $conexion=null;
    die(error_page("Ter_PDO", "<p>No se ha podido hacer la consulta: " . $e->getMessage() . "</p>"));
}


if ($result_select->rowCount() <= 0) {
    $result_select=null;
    session_unset();
    $_SESSION["mensaje_seguridad"] = "Usted ya no se encuentra registrado en la BD";
    header("Location:" . $salto);
    exit;
} else {
    $datos_usuario_log = $result_select->fetch(PDO::FETCH_ASSOC);

    $result_select=null;
}

// He pasado el control de baneo
//Ahora controlo el tiempo de inactividad

if (time() - $_SESSION["ultm_accion"] > INACTIVIDAD * 60) {
    session_unset();
    $_SESSION["mensaje_seguridad"] = "Su tiempo de sesión ha expirado. Por favor, vuelva a loguearse";
    header("Location:" . $salto);
    exit;
}

$_SESSION["ultm_accion"] = time();
