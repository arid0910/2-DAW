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
        $consulta = "select producto.*, familia.nombre as nombre_familia from producto, familia where producto.familia=familia.cod and producto.cod=?";
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

function insertar_producto($datos){
    //Conexión a la BD
    try {
        $conexion =new PDO("mysql:host=".SERVIDOR_BD.";dbname=".NOMBRE_BD."",USUARIO_BD,CLAVE_BD,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        //No se puede hacer die asique terminamos con un array de error
        $repuesta["error"] = "No se ha podido conectar a la BD: ".$e->getMessage();
        return $repuesta;
    }

    try {
        $consulta = "insert into producto(cod, nombre, nombre_corto, descripcion, PVP, familia) values ('?','?','?','?','?','?')";
        $sentencia=$conexion->prepare($consulta);
        $sentencia->execute($datos);
    } catch (PDOException $e) {
        $sentencia=null;
        $conexion=null;
        $repuesta["error"] = "No se ha podido hacer la consulta a la BD: ".$e->getMessage();
        return $repuesta;
    }

    $repuesta["mensaje"] = "El producto con codigo '".$datos[0]."' se a insertado corectamente";

    $sentencia = null;
    $conexion = null;

    return $repuesta;
}

function actualizar_producto($datos){
    //Conexión a la BD
    try {
        $conexion =new PDO("mysql:host=".SERVIDOR_BD.";dbname=".NOMBRE_BD."",USUARIO_BD,CLAVE_BD,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        //No se puede hacer die asique terminamos con un array de error
        $repuesta["error"] = "No se ha podido conectar a la BD: ".$e->getMessage();
        return $repuesta;
    }

    try {
        $consulta = "update producto set nombre='?',nombre_corto='?',descripcion='?',PVP='?',familia='?' where cod = '?'";
        $sentencia=$conexion->prepare($consulta);
        $sentencia->execute($datos);
    } catch (PDOException $e) {
        $sentencia=null;
        $conexion=null;
        $repuesta["error"] = "No se ha podido hacer la consulta a la BD: ".$e->getMessage();
        return $repuesta;
    }

    $repuesta["mensaje"] = "El producto con codigo '".end($datos)."' se a actualizado corectamente";

    $sentencia = null;
    $conexion = null;

    return $repuesta;
}

function borrar_producto($cod){
    //Conexión a la BD
    try {
        $conexion =new PDO("mysql:host=".SERVIDOR_BD.";dbname=".NOMBRE_BD."",USUARIO_BD,CLAVE_BD,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        //No se puede hacer die asique terminamos con un array de error
        $repuesta["error"] = "No se ha podido conectar a la BD: ".$e->getMessage();
        return $repuesta;
    }
    
    try {
        $consulta = "delete from producto where cod = ?";
        $sentencia=$conexion->prepare($consulta);
        $sentencia->execute([$cod]);
    } catch (PDOException $e) {
        $sentencia=null;
        $conexion=null;
        $repuesta["error"] = "No se ha podido hacer la consulta a la BD: ".$e->getMessage();
        return $repuesta;
    }

    $repuesta["mensaje"] = "El producto con codigo '".$cod."' se a borrado corectamente";

    $sentencia = null;
    $conexion = null;

    return $repuesta;
}

function obtener_familias(){
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
        $consulta = "select * from familia";
        $sentencia=$conexion->prepare($consulta);
        $sentencia->execute();
    } catch (PDOException $e) {
        $sentencia=null;
        $conexion=null;
        $repuesta["error"] = "No se ha podido hacer la consulta a la BD: ".$e->getMessage();
        return $repuesta;
    }

    //Obtenemos todas las tuplas de productos
    $repuesta["familia"] = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    $sentencia = null;
    $conexion = null;

    return $repuesta;
}

function repetido_insertando($tabla, $columna, $valor){
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
        $consulta = "select ".$columna." from ".$tabla." where ".$columna."=?";
        $sentencia=$conexion->prepare($consulta);
        $sentencia->execute([$valor]);
    } catch (PDOException $e) {
        $sentencia=null;
        $conexion=null;
        $repuesta["error"] = "No se ha podido hacer la consulta a la BD: ".$e->getMessage();
        return $repuesta;
    }

    $repuesta["repetido"]=$sentencia->rowCount()>0;
       
    $sentencia = null;
    $conexion = null;

    return $repuesta;
}

function repetido_editando($tabla, $columna, $valor, $columna_id, $valor_id){
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
        $consulta = "select ".$columna." from ".$tabla." where ".$columna."=? and ".$columna_id."<>?";
        $sentencia=$conexion->prepare($consulta);
        $sentencia->execute([$valor,$valor_id]);
    } catch (PDOException $e) {
        $sentencia=null;
        $conexion=null;
        $repuesta["error"] = "No se ha podido hacer la consulta a la BD: ".$e->getMessage();
        return $repuesta;
    }

    $repuesta["repetido"]=$sentencia->rowCount()>0;
       
    $sentencia = null;
    $conexion = null;

    return $repuesta;
}
?>