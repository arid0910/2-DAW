const DIR_API2="http://localhost/2DAW/Proyectos/2Trim/Servicios_Web/Actividad1/servicios_rest";

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
        }else{
            let html_tabla_productos="<table>";
            html_tabla_productos+="<tr><th>COD</th><th>Nombre Corto</th><th>PVP (€)</th><th><button class='enlace' onclick=''>Producto+</button></th></tr>";
            $.each(data.productos,function(key,tupla){
                html_tabla_productos+="<tr>";
                html_tabla_productos += "<td><button class='enlace' onclick='obtener_producto(\"" + tupla["cod"] + "\")'>" + tupla["cod"] + "</button></td>";
                html_tabla_productos+="<td>"+tupla["nombre_corto"]+"</td>";
                html_tabla_productos+="<td>"+tupla["PVP"]+"</td>";
                html_tabla_productos+="<td><button class='enlace' onclick=''>Editar</button> - <button class='enlace' onclick=''>Borrar</button></td>";
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
function obtener_producto(producto)
{
    $.ajax({
        url:DIR_API2+"/producto/" + producto,
        dataType:"json",
        type:"GET"
    })
    .done(function(data){
        if(data.error)
        {
            $("#info").html(data.error);
        }else{
            let html_detalles_producto="<div>";
            html_detalles_producto += "<h2>Detalles del producto"+data.producto["cod"]+"</h2>";
            if(data.producto["nombre"] == null){
                html_detalles_producto += "<p><strong>Nombre: </strong></p>";
            } else {
                html_detalles_producto += "<p><strong>Nombre: </strong>"+data.producto["nombre"]+"</p>";
            }
            html_detalles_producto += "<p><strong>Nombre Corto: </strong>"+data.producto["nombre_corto"]+"</p>";
            html_detalles_producto += "<p><strong>Descripción: </strong>"+data.producto["descripcion"]+"</p>";
            html_detalles_producto += "<p><strong>PVP: </strong>"+data.producto["PVP"]+"</p>";
            html_detalles_producto += "<p><strong>Familia: </strong>"+data.producto["familia"]+"</p>";
            html_detalles_producto += "<p><button onclick='volver()'>Volver</button></p>";

            $("#info").html(html_detalles_producto);
        }
    })
    .fail(function(a,b){
        $("#info").html(error_ajax_jquery(a,b)); 
    });
}

function volver(){
    $("#info").html(""); 
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

