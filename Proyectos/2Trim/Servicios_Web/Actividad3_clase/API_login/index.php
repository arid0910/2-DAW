<?php

require __DIR__ . '/Slim/autoload.php';

require "src/functions_cts.php";

$app = new \Slim\App;

$app->post('/login', function($request){
    //Dos parametros por abajo
    $usuario = $request->getParam("usuario");
    $clave = $request->getParam("clave");

    echo json_encode(login($usuario, $clave));
});



$app->run();
