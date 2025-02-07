const DIR_API1="http://localhost/Proyectos/Curso24_25/Teor_SW/API";
const DIR_API2="http://localhost/Proyectos/Curso24_25/Servicios_Web/Actividad1/servicios_rest";

$(function(){
    obtener_productos();
});



function obtener_productos()
{
    $.ajax({
        url:DIR_API2+"/productos",
        dataType:"json",
        type:"GET"
    })
    .done(function(data){
        if(data.error)
        {
            $("#respuesta").html(data.error);
        }
        else
        {
            let html_tabla_productos="<table>";
            html_tabla_productos+="<tr><th>COD</th><th>Nombre Corto</th><th>PVP (€)</th></tr>";
            $.each(data.productos,function(key,tupla){
                html_tabla_productos+="<tr>";
                html_tabla_productos+="<td>"+tupla["cod"]+"</td>";
                html_tabla_productos+="<td>"+tupla["nombre_corto"]+"</td>";
                html_tabla_productos+="<td>"+tupla["PVP"]+"</td>";
                html_tabla_productos+="</tr>";
            });
            html_tabla_productos+="</table>";
            $("#respuesta").html(html_tabla_productos);
        }
    })
    .fail(function(a,b){
        $("#respuesta").html(error_ajax_jquery(a,b)); 
    });
}


function llamada_get1()
{
    $.ajax({
        url:DIR_API1+"/saludo",
        dataType:"json",
        type:"GET"
    })
    .done(function(data){
        $("#respuesta").html(data.mensaje);
    })
    .fail(function(a,b){
        $("#respuesta").html(error_ajax_jquery(a,b)); 
    });

}


function llamada_get2()
{
    let nombre_envio="María José";
    $.ajax({
        url:DIR_API1+"/saludo/"+nombre_envio,
        dataType:"json",
        type:"GET"
    })
    .done(function(data){
        $("#respuesta").html(data.mensaje);
    })
    .fail(function(a,b){
        $("#respuesta").html(error_ajax_jquery(a,b)); 
    });

}

function llamada_post()
{
    let nombre_envio="María José";
    $.ajax({
        url:DIR_API1+"/saludo",
        dataType:"json",
        type:"POST",
        data:{"name":nombre_envio}
    })
    .done(function(data){
        $("#respuesta").html(data.mensaje);
    })
    .fail(function(a,b){
        $("#respuesta").html(error_ajax_jquery(a,b)); 
    });

}

function llamada_delete()
{
    let id="9";
    $.ajax({
        url:DIR_API1+"/borrar_saludo/"+id,
        dataType:"json",
        type:"DELETE"
    })
    .done(function(data){
        $("#respuesta").html(data.mensaje);
    })
    .fail(function(a,b){
        $("#respuesta").html(error_ajax_jquery(a,b)); 
    });

}

function llamada_put()
{
    let id="9";
    let nuevo_nombre="Juan José";
    $.ajax({
        url:DIR_API1+"/actualizar_saludo/"+id,
        dataType:"json",
        type:"PUT",
        data:{"name":nuevo_nombre}
    })
    .done(function(data){
        $("#respuesta").html(data.mensaje);
    })
    .fail(function(a,b){
        $("#respuesta").html(error_ajax_jquery(a,b)); 
    });

}

function error_ajax_jquery( jqXHR, textStatus) 
{
    var respuesta;
    if (jqXHR.status === 0) {
  
      respuesta='Not connect: Verify Network.';
  
    } else if (jqXHR.status == 404) {
  
      respuesta='Requested page not found [404]';
  
    } else if (jqXHR.status == 500) {
  
      respuesta='Internal Server Error [500].';
  
    } else if (textStatus === 'parsererror') {
  
      respuesta='Requested JSON parse failed.';
  
    } else if (textStatus === 'timeout') {
  
      respuesta='Time out error.';
  
    } else if (textStatus === 'abort') {
  
      respuesta='Ajax request aborted.';
  
    } else {
  
      respuesta='Uncaught Error: ' + jqXHR.responseText;
  
    }
    return respuesta;
}

