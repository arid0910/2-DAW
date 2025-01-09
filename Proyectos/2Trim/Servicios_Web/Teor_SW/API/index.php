<?php

require __DIR__ . '/Slim/autoload.php';

$app= new \Slim\App;

$app->get('/saludo',function(){

    $respuesta["mensaje"]="Hola que tal?";
    echo json_encode($respuesta);
});

$app->get('/saludo/{nombre}',function($request){
    $nombre=$request->getAttribute("nombre");
    $respuesta["mensaje"]="Hola que tal, ".$nombre."?";
    echo json_encode($respuesta);
});

$app->post('/saludo',function($request){

    $nombre=$request->getParam("nombre");
    $respuesta["mensaje"]="Hola que tal, ".$nombre."?";
    echo json_encode($respuesta);

});

$app->run();

?>