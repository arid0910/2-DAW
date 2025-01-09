<?php

require __DIR__ . '/Slim/autoload.php';

require "src/funciones_cts.php";

$app = new \Slim\App;

//A
$app->get('/productos', function(){
    echo json_encode(obtener_productos());
});

//B
$app->get("/producto/{cod}", function($request){
    $cod = $request->getAttribute("cod");
    echo json_encode(obtener_producto($cod));
});

//C
$app->post("/producto/insertar", function(){
    
});

$app->run();
