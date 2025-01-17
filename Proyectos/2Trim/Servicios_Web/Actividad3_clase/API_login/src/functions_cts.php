<?php

const SERVIDOR_BD = "localhost";
const USUARIO_BD = "jose";
const CLAVE_BD = "josefa";
const NOMBRE_BD = "bd_cv";

function login($usuario, $clave){
    //Conexión a la BD
    try {
        $conexion =new PDO("mysql:host=".SERVIDOR_BD.";dbname=".NOMBRE_BD."",USUARIO_BD,CLAVE_BD,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        //No se puede hacer die asique terminamos con un array de error
        $repuesta["error"] = "No se ha podido conectar a la BD: ".$e->getMessage();
        return $repuesta;
    }

    try {
        $consulta = "select * from usuarios where usuario = ? and clave = ?";
        $sentencia=$conexion->prepare($consulta);
        $sentencia->execute([$usuario, $clave]);
    } catch (PDOException $e) {
        $sentencia=null;
        $conexion=null;
        $repuesta["error"] = "No se ha podido hacer la consulta a la BD: ".$e->getMessage();
        return $repuesta;
    }

    if($sentencia->rowCount() > 0){
        $repuesta["mensaje"] = $sentencia->fetch(PDO::FETCH_ASSOC);
    } else {
        $repuesta["mensaje"] = "El usuario no se encuentra en la BD";
    }

    

    $sentencia = null;
    $conexion = null;

    return $repuesta;
}

?>