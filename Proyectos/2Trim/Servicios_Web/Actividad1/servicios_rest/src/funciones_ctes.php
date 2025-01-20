<?php
define("SERVIDOR_BD","localhost");
define("USUARIO_BD","jose");
define("CLAVE_BD","josefa");
define("NOMBRE_BD","bd_tienda");

function obtener_productos()
{
    try{
        $conexion=new PDO("mysql:host=".SERVIDOR_BD.";dbname=".NOMBRE_BD,USUARIO_BD,CLAVE_BD,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    }
    catch(PDOException $e)
    {
        $respuesta["error"]="No he podido conectarse a la base de batos: ".$e->getMessage();
        return $respuesta;
    }

    try{
        $consulta="select * from producto";
        $sentencia=$conexion->prepare($consulta);
        $sentencia->execute();

    }
    catch(PDOException $e)
    {
        $sentencia=null;
        $conexion=null;
        $respuesta["error"]="No he podido realizarse la consulta: ".$e->getMessage();
        return $respuesta;
    }

    $respuesta["productos"]=$sentencia->fetchAll(PDO::FETCH_ASSOC);
    $sentencia=null;
    $conexion=null;
    return $respuesta;
}

function obtener_producto($cod)
{
    try{
        $conexion=new PDO("mysql:host=".SERVIDOR_BD.";dbname=".NOMBRE_BD,USUARIO_BD,CLAVE_BD,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    }
    catch(PDOException $e)
    {
        $respuesta["error"]="No he podido conectarse a la base de batos: ".$e->getMessage();
        return $respuesta;
    }
    try{
        $consulta="select producto.*, familia.nombre as nombre_familia from producto, familia where producto.familia=familia.cod and producto.cod=?";
        $sentencia=$conexion->prepare($consulta);
        $sentencia->execute([$cod]);

    }
    catch(PDOException $e)
    {
        $sentencia=null;
        $conexion=null;
        $respuesta["error"]="No he podido realizarse la consulta: ".$e->getMessage();
        return $respuesta;
    }
    if($sentencia->rowCount()<=0)
        $respuesta["mensaje"]="El producto con cod: ".$cod." no se encuentra en la BD";
    else
        $respuesta["producto"]=$sentencia->fetch(PDO::FETCH_ASSOC);

    $sentencia=null;
    $conexion=null;
    return $respuesta;
}


function insertar_producto($datos)
{
    try{
        $conexion=new PDO("mysql:host=".SERVIDOR_BD.";dbname=".NOMBRE_BD,USUARIO_BD,CLAVE_BD,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    }
    catch(PDOException $e)
    {
        $respuesta["error"]="No he podido conectarse a la base de batos: ".$e->getMessage();
        return $respuesta;
    }
    try{
        $consulta="insert into producto (cod, nombre, nombre_corto,descripcion,PVP, familia) values (?,?,?,?,?,?)";
        $sentencia=$conexion->prepare($consulta);
        $sentencia->execute($datos);

    }
    catch(PDOException $e)
    {
        $sentencia=null;
        $conexion=null;
        $respuesta["error"]="No he podido realizarse la consulta: ".$e->getMessage();
        return $respuesta;
    }
   
    $respuesta["mensaje"]="El producto con cod: ".$datos[0]." se ha insertado correctamente";
   

    $sentencia=null;
    $conexion=null;
    return $respuesta;
}

function actualizar_producto($datos)
{
    try{
        $conexion=new PDO("mysql:host=".SERVIDOR_BD.";dbname=".NOMBRE_BD,USUARIO_BD,CLAVE_BD,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    }
    catch(PDOException $e)
    {
        $respuesta["error"]="No he podido conectarse a la base de batos: ".$e->getMessage();
        return $respuesta;
    }
    try{
        $consulta="update producto set nombre=?, nombre_corto=?, descripcion=?, PVP=?, familia=? where cod=?";
        $sentencia=$conexion->prepare($consulta);
        $sentencia->execute($datos);

    }
    catch(PDOException $e)
    {
        $sentencia=null;
        $conexion=null;
        $respuesta["error"]="No he podido realizarse la consulta: ".$e->getMessage();
        return $respuesta;
    }
   
    $respuesta["mensaje"]="El producto con cod: ".end($datos)." se ha actualizado correctamente";
   

    $sentencia=null;
    $conexion=null;
    return $respuesta;
}


function borrar_producto($cod)
{
    try{
        $conexion=new PDO("mysql:host=".SERVIDOR_BD.";dbname=".NOMBRE_BD,USUARIO_BD,CLAVE_BD,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    }
    catch(PDOException $e)
    {
        $respuesta["error"]="No he podido conectarse a la base de batos: ".$e->getMessage();
        return $respuesta;
    }
    try{
        $consulta="delete from producto where cod=?";
        $sentencia=$conexion->prepare($consulta);
        $sentencia->execute([$cod]);

    }
    catch(PDOException $e)
    {
        $sentencia=null;
        $conexion=null;
        $respuesta["error"]="No he podido realizarse la consulta: ".$e->getMessage();
        return $respuesta;
    }
    
    $respuesta["mensaje"]="El producto con cod: ".$cod." se ha borrado de la BD";
   
    $sentencia=null;
    $conexion=null;
    return $respuesta;
}

function obtener_familias()
{
    try{
        $conexion=new PDO("mysql:host=".SERVIDOR_BD.";dbname=".NOMBRE_BD,USUARIO_BD,CLAVE_BD,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    }
    catch(PDOException $e)
    {
        $respuesta["error"]="No he podido conectarse a la base de batos: ".$e->getMessage();
        return $respuesta;
    }

    try{
        $consulta="select * from familia";
        $sentencia=$conexion->prepare($consulta);
        $sentencia->execute();

    }
    catch(PDOException $e)
    {
        $sentencia=null;
        $conexion=null;
        $respuesta["error"]="No he podido realizarse la consulta: ".$e->getMessage();
        return $respuesta;
    }

    $respuesta["familias"]=$sentencia->fetchAll(PDO::FETCH_ASSOC);
    $sentencia=null;
    $conexion=null;
    return $respuesta;
}

function repetido_insertando($tabla,$columna,$valor)
{
    try{
        $conexion=new PDO("mysql:host=".SERVIDOR_BD.";dbname=".NOMBRE_BD,USUARIO_BD,CLAVE_BD,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    }
    catch(PDOException $e)
    {
        $respuesta["error"]="No he podido conectarse a la base de batos: ".$e->getMessage();
        return $respuesta;
    }

    try{
        $consulta="select ".$columna." from ".$tabla." where ".$columna."=?" ;
        $sentencia=$conexion->prepare($consulta);
        $sentencia->execute([$valor]);

    }
    catch(PDOException $e)
    {
        $sentencia=null;
        $conexion=null;
        $respuesta["error"]="No he podido realizarse la consulta: ".$e->getMessage();
        return $respuesta;
    }

    $respuesta["repetido"]=$sentencia->rowCount()>0;
        
    
    $sentencia=null;
    $conexion=null;
    return $respuesta;
}

function repetido_editando($tabla,$columna,$valor,$columna_id,$valor_id)
{
    try{
        $conexion=new PDO("mysql:host=".SERVIDOR_BD.";dbname=".NOMBRE_BD,USUARIO_BD,CLAVE_BD,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    }
    catch(PDOException $e)
    {
        $respuesta["error"]="No he podido conectarse a la base de batos: ".$e->getMessage();
        return $respuesta;
    }

    try{
        $consulta="select ".$columna." from ".$tabla." where ".$columna."=? and ".$columna_id."<>?" ;
        $sentencia=$conexion->prepare($consulta);
        $sentencia->execute([$valor,$valor_id]);

    }
    catch(PDOException $e)
    {
        $sentencia=null;
        $conexion=null;
        $respuesta["error"]="No he podido realizarse la consulta: ".$e->getMessage();
        return $respuesta;
    }

    $respuesta["repetido"]=$sentencia->rowCount()>0;
        
    
    $sentencia=null;
    $conexion=null;
    return $respuesta;
}

function login($usuario,$clave)
{
    try{
        $conexion=new PDO("mysql:host=".SERVIDOR_BD.";dbname=".NOMBRE_BD,USUARIO_BD,CLAVE_BD,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    }
    catch(PDOException $e)
    {
        $respuesta["error"]="No he podido conectarse a la base de batos: ".$e->getMessage();
        return $respuesta;
    }

    try{
        $consulta="select * from usuarios where usuario=? and clave=?";
        $sentencia=$conexion->prepare($consulta);
        $sentencia->execute([$usuario,$clave]);

    }
    catch(PDOException $e)
    {
        $sentencia=null;
        $conexion=null;
        $respuesta["error"]="No he podido realizarse la consulta: ".$e->getMessage();
        return $respuesta;
    }

    if($sentencia->rowCount()>0)
        $respuesta["usuario"]=$sentencia->fetch(PDO::FETCH_ASSOC);
    else
        $respuesta["mensanje"]="El usuario no se encuentra registrado en la BD";

    $sentencia=null;
    $conexion=null;
    return $respuesta;
}
?>