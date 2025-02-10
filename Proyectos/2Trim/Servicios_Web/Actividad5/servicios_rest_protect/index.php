<?php

require __DIR__ . '/Slim/autoload.php';

require "src/funciones_servicios.php";

$app= new \Slim\App;

$app->get('/logueado',function(){

    $test=validateToken();
    if(is_array($test))
    {
        echo json_encode($test);
    }
    else
        echo json_encode(array("no_auth"=>"No tienes permiso para usar el servicio"));  
});

$app->get('/usuarios',function(){
    $test=validateToken();
    if(is_array($test))
    {
        if(isset($test["usuario"]) )
        {
            if($test["usuario"]["tipo"]=="admin")
                echo json_encode(obtener_usuarios());
            else
                echo json_encode(array("no_auth"=>"No tienes permiso para usar el servicio")); 

        }
        else
        {
            echo json_encode($test);
        }    
    }
    else
        echo json_encode(array("no_auth"=>"No tienes permiso para usar el servicio"));  

    
});

$app->get('/usuario/{id_usuario}',function($request){
    $test=validateToken();
    if(is_array($test))
    {
        if(isset($test["usuario"]) )
        {
            if($test["usuario"]["tipo"]=="admin")
                echo json_encode(obtener_usuario($request->getAttribute('id_usuario')));
            else
                echo json_encode(array("no_auth"=>"No tienes permiso para usar el servicio")); 

        }
        else
        {
            echo json_encode($test);
        }    
    }
    else
        echo json_encode(array("no_auth"=>"No tienes permiso para usar el servicio"));  

    
});

$app->post('/crearUsuario',function($request){
    $test=validateToken();
    if(is_array($test))
    {
        if(isset($test["usuario"]) )
        {
            if($test["usuario"]["tipo"]=="admin")
            {
                $datos_insert[]=$request->getParam("nombre");
                $datos_insert[]=$request->getParam("usuario");
                $datos_insert[]=$request->getParam("clave");
                $datos_insert[]=$request->getParam("email");
            
                echo json_encode(insertar_usuario($datos_insert));
            }
            else
                echo json_encode(array("no_auth"=>"No tienes permiso para usar el servicio")); 

        }
        else
        {
            echo json_encode($test);
        }    
    }
    else
        echo json_encode(array("no_auth"=>"No tienes permiso para usar el servicio"));  


    
});


$app->post('/login',function($request){
    
    $datos_login[]=$request->getParam("usuario");
    $datos_login[]=$request->getParam("clave");


    echo json_encode(login($datos_login));
});


$app->put('/actualizarUsuario/{id_usuario}',function($request){

    $test=validateToken();
    if(is_array($test))
    {
        if(isset($test["usuario"]) )
        {
            if($test["usuario"]["tipo"]=="admin")
            {
                $datos_actualizar[]=$request->getParam("nombre");
                $datos_actualizar[]=$request->getParam("usuario");
                $datos_actualizar[]=$request->getParam("clave");
                $datos_actualizar[]=$request->getParam("email");
                $datos_actualizar[]=$request->getAttribute("id_usuario");

                echo json_encode(actualizar_usuario($datos_actualizar));
            }
            else
                echo json_encode(array("no_auth"=>"No tienes permiso para usar el servicio")); 

        }
        else
        {
            echo json_encode($test);
        }    
    }
    else
        echo json_encode(array("no_auth"=>"No tienes permiso para usar el servicio"));  


    
});

$app->put('/actualizarUsuarioSinClave/{id_usuario}',function($request){

    $test=validateToken();
    if(is_array($test))
    {
        if(isset($test["usuario"]) )
        {
            if($test["usuario"]["tipo"]=="admin")
            {
                $datos_actualizar[]=$request->getParam("nombre");
                $datos_actualizar[]=$request->getParam("usuario");
                $datos_actualizar[]=$request->getParam("email");
                $datos_actualizar[]=$request->getAttribute("id_usuario");

                echo json_encode(actualizar_usuario_sin_clave($datos_actualizar));
            }
            else
                echo json_encode(array("no_auth"=>"No tienes permiso para usar el servicio")); 

        }
        else
        {
            echo json_encode($test);
        }    
    }
    else
        echo json_encode(array("no_auth"=>"No tienes permiso para usar el servicio"));  


    
});

$app->delete('/borrarUsuario/{id_usuario}',function($request){

    $test=validateToken();
    if(is_array($test))
    {
        if(isset($test["usuario"]) )
        {
            if($test["usuario"]["tipo"]=="admin")
            {
                echo json_encode(borrar_usuario($request->getAttribute("id_usuario")));
            }
            else
                echo json_encode(array("no_auth"=>"No tienes permiso para usar el servicio")); 
        }
        else
        {
            echo json_encode($test);
        }    
    }
    else
        echo json_encode(array("no_auth"=>"No tienes permiso para usar el servicio"));  



   
});

$app->get('/repetido/{tabla}/{columna}/{valor}',function($request){


    $test=validateToken();
    if(is_array($test))
    {
        if(isset($test["usuario"]) )
        {
            if($test["usuario"]["tipo"]=="admin")
            {
                echo json_encode(repetido_insertando($request->getAttribute("tabla"),$request->getAttribute("columna"),$request->getAttribute("valor")));
            }
            else
                echo json_encode(array("no_auth"=>"No tienes permiso para usar el servicio")); 
        }
        else
        {
            echo json_encode($test);
        }    
    }
    else
        echo json_encode(array("no_auth"=>"No tienes permiso para usar el servicio")); 



    
});

$app->get('/repetido/{tabla}/{columna}/{valor}/{columna_id}/{valor_id}',function($request){


    $test=validateToken();
    if(is_array($test))
    {
        if(isset($test["usuario"]) )
        {
            if($test["usuario"]["tipo"]=="admin")
            {
                echo json_encode(repetido_editando($request->getAttribute("tabla"),$request->getAttribute("columna"),$request->getAttribute("valor"),$request->getAttribute("columna_id"),$request->getAttribute("valor_id")));
            }
            else
                echo json_encode(array("no_auth"=>"No tienes permiso para usar el servicio")); 
        }
        else
        {
            echo json_encode($test);
        }    
    }
    else
        echo json_encode(array("no_auth"=>"No tienes permiso para usar el servicio"));



});

$app->run();

?>