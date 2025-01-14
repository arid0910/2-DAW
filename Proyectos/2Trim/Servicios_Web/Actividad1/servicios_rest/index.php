<?php

require __DIR__ . '/Slim/autoload.php';

require "src/funciones_cts.php";

$app = new \Slim\App;

//A
$app->get('/productos', function(){
    echo json_encode(obtener_productos());
});

//B
$app->get('/producto/{cod}', function($request){
    $cod = $request->getAttribute("cod");
    echo json_encode(obtener_producto($cod));
});

//C
$app->post('/producto/insertar', function($request){
    $datos[]=$request->getParam("cod");
    $datos[]=$request->getParam("nombre");
    $datos[]=$request->getParam("nombre_corto");
    $datos[]=$request->getParam("descripcion");
    $datos[]=$request->getParam("PVP");

    echo json_encode(insertar_producto($datos));
});

//D
$app->put('/producto/actualizar/{cod}',function($request){
    $datos[]=$request->getParam("nombre");
    $datos[]=$request->getParam("nombre_corto");
    $datos[]=$request->getParam("descripcion");
    $datos[]=$request->getParam("PVP");
    $datos[]=$request->getAttribute("cod");

    echo json_encode(actualizar_producto($datos));
});

//E
$app->delete('/producto/borrar/{cod}', function($request){
    $cod=$request->getAttribute("cod");

    echo json_encode(borrar_producto($cod));
});

//F 
$app->get('/familias',function(){
    echo json_encode(obtener_productos());
});

//G
$app->get('/repetido/{tabla}/{columna}/{valor}', function($request){
    $tabla=$request->getAttribute("tabla");
    $columna=$request->getAttribute("columna");
    $valor=$request->getAttribute("valor");

    echo json_encode(repetido_insertando($tabla, $columna, $valor));
});

//H
$app->get('/repetido/{tabla}/{columna}/{valor}/{columna_id}/{valor_id}', function($request){
    $tabla=$request->getAttribute("tabla");
    $columna=$request->getAttribute("columna");
    $valor=$request->getAttribute("valor");
    $columna_id=$request->getAttribute("columna_id");
    $valor_id=$request->getAttribute("valor_id");

    echo json_encode(repetido_editando($tabla, $columna, $valor, $columna_id, $valor_id));
});

$app->run();
