<?php

const SERVIDOR_BD = "localhost";
const USUARIO_BD = "jose";
const CLAVE_BD = "josefa";
const NOMBRE_BD = "bd_tienda";

function obtener_productos(){
    //Conexión a la BD
    try {
        $conexion =new PDO("mysql:host=".SERVIDOR_BD.";dbname=".NOMBRE_BD."",USUARIO_BD,CLAVE_BD,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        //No se puede hacer die asique terminamos con un array de error
        $repuesta["error"] = "No se ha podido conectar a la BD: ".$e->getMessage();
        return $repuesta;
    }

    //Hacemos la consulta
    try {
        $consulta = "select * from producto";
        $sentencia=$conexion->prepare($consulta);
        $sentencia->execute();
    } catch (PDOException $e) {
        $sentencia=null;
        $conexion=null;
        $repuesta["error"] = "No se ha podido hacer la consulta a la BD: ".$e->getMessage();
        return $repuesta;
    }

    //Obtenemos todas las tuplas de productos
    $repuesta["productos"] = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    $sentencia = null;
    $conexion = null;

    return $repuesta;
}

function obtener_producto($cod){
    //Conexión a la BD
    try {
        $conexion =new PDO("mysql:host=".SERVIDOR_BD.";dbname=".NOMBRE_BD."",USUARIO_BD,CLAVE_BD,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        //No se puede hacer die asique terminamos con un array de error
        $repuesta["error"] = "No se ha podido conectar a la BD: ".$e->getMessage();
        return $repuesta;
    }

    //Hacemos la consulta
    try {
        $consulta = "select * from producto where cod=?";
        $sentencia=$conexion->prepare($consulta);
        $sentencia->execute([$cod]);
    } catch (PDOException $e) {
        $sentencia=null;
        $conexion=null;
        $repuesta["error"] = "No se ha podido hacer la consulta a la BD: ".$e->getMessage();
        return $repuesta;
    }

    //Si existe generamos json diferentes
    if($sentencia->rowCount() <= 0){
        $repuesta["mensaje"] = "El producto con codigo '".$cod."' no se encuentra eb la BD";
    }else{
        $repuesta["productos"] = $sentencia->fetch(PDO::FETCH_ASSOC);
    }

    $sentencia = null;
    $conexion = null;

    return $repuesta;
}

?>