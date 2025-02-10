<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplicación Web (uso de API)</title>
</head>
<body>
    <h1>Aplicación para usar/probar mi primera API</h1>
    <?php
    function consumir_servicios_REST($url,$metodo,$datos=null)
    {
        $llamada=curl_init();
        curl_setopt($llamada,CURLOPT_URL,$url);
        curl_setopt($llamada,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($llamada,CURLOPT_CUSTOMREQUEST,$metodo);
        if(isset($datos))
            curl_setopt($llamada,CURLOPT_POSTFIELDS,http_build_query($datos));
        $respuesta=curl_exec($llamada);
        curl_close($llamada);
        return $respuesta;
    }

    define("DIR_SERV","http://localhost/Proyectos/Curso24_25/Teor_SW/API");
   
    $url=DIR_SERV."/saludo";
    $respuesta=consumir_servicios_REST($url,"GET");
    $obj=json_decode($respuesta);
    if(!$obj)
        die("<p>Error consumiendo el servicio: ".$url."<p></body></html>");

    echo "<p>El mensaje recibido tras llamar al servicio web: <strong>'".$url."'</strong> ha sido: ".$obj->mensaje."</p>";


    $url=DIR_SERV."/saludo/".urlencode("María del Carmen");
    $respuesta=consumir_servicios_REST($url,"GET");
    $obj=json_decode($respuesta);
    if(!$obj)
        die("<p>Error consumiendo el servicio: ".$url."<p></body></html>");

    echo "<p>El mensaje recibido tras llamar al servicio web: <strong>'".$url."'</strong> ha sido: ".$obj->mensaje."</p>";


    $url=DIR_SERV."/saludo";
    $datos_env["nombre"]="María del Carmen";
    $respuesta=consumir_servicios_REST($url,"POST",$datos_env);
    $obj=json_decode($respuesta);
    if(!$obj)
        die("<p>Error consumiendo el servicio: ".$url."<p></body></html>");

    echo "<p>El mensaje recibido tras llamar al servicio web: <strong>'".$url."'</strong> ha sido: ".$obj->mensaje."</p>";
    ?>
</body>
</html>