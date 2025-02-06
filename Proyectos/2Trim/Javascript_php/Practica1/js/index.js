const DIR_API="http://localhost/2DAW/Proyectos/2Trim/Servicios_Web/Actividad1/servicios_rest";

$(function(){
    obtener_productos();
});


function obtener_productos()
{
    $.ajax({
        url:DIR_API+"/productos",
        dataType:"json",
        type:"GET"
    })
    .done(function(data){
        if(data.error)
        {
            $("#errores").html(data.error);
            $("#respuestas").html("");
            $("#productos").html("");
        }
        else
        {
            let html_tabla_productos="<table class='txt_centrado centrado'>";
            html_tabla_productos+="<tr><th>COD</th><th>Nombre Corto</th><th>PVP (€)</th><th><button class='enlace' onclick='montar_vista_agregar()'>Productos+</button></th></tr>";
            $.each(data.productos,function(key,tupla){
                html_tabla_productos+="<tr>";
                html_tabla_productos+="<td><button class='enlace' onclick='obtener_detalles(\""+tupla["cod"]+"\")'>"+tupla["cod"]+"</button></td>";
                html_tabla_productos+="<td>"+tupla["nombre_corto"]+"</td>";
                html_tabla_productos+="<td>"+tupla["PVP"]+"</td>";
                html_tabla_productos+="<td><button class='enlace' onclick='montar_vista_borrar(\""+tupla["cod"]+"\")'>Borrar</button> - <button class='enlace' onclick='montar_vista_editar(\""+tupla["cod"]+"\")'>Editar</button></td>";
                html_tabla_productos+="</tr>";
            });
            html_tabla_productos+="</table>";
            $("#productos").html(html_tabla_productos);
        }
    })
    .fail(function(a,b){
        $("#errores").html(error_ajax_jquery(a,b)); 
        $("#respuestas").html("");
        $("#productos").html("");
    });
}

function montar_vista_borrar(cod)
{
    let html_vista_borrar="<p class='txt_centrado'>Se dispone usted a borrar el producto: <strong>"+cod+"</strong></p>";
    html_vista_borrar+="<p class='txt_centrado'>¿Estás seguro?</p>";
    html_vista_borrar+="<p class='txt_centrado'><button onclick='borrar_respuestas()'>Cancelar</button> <button onclick='borrar_producto(\""+cod+"\")'>Continuar</button></p>";
    $("#respuestas").html(html_vista_borrar);
}

function borrar_producto(cod)
{
    $.ajax({
        url:DIR_API+"/producto/borrar/"+cod,
        dataType:"json",
        type:"DELETE"
    })
    .done(function(data){
        if(data.error)
        {
            $("#errores").html(data.error);
            $("#respuestas").html("");
            $("#productos").html("");
        }
        else
        {
            $("#respuestas").html("<p class='txt_centrado mensaje'>¡¡ Producto borrado con éxito !!</p>");
            obtener_productos();
        }
    })
    .fail(function(a,b){
        $("#errores").html(error_ajax_jquery(a,b)); 
        $("#respuestas").html("");
        $("#productos").html("");
    });
}

function montar_vista_editar(cod)
{
    $.ajax({
        url:DIR_API+"/producto/"+cod,
        dataType:"json",
        type:"GET"
    })
    .done(function(data){
        if(data.error)
        {
            $("#errores").html(data.error);
            $("#respuestas").html("");
            $("#productos").html("");
        }
        else if(data.mensaje)
        {
            let html_detalle_producto="<h2>Editando el Producto "+cod+"</h2>";
            html_detalle_producto+="<p>El producto ya no se encuentra en la BD</p>";
            $("#respuestas").html(html_detalle_producto);
            obtener_productos();
        }
        else
        {
        ;
            $.ajax({
                url:DIR_API+"/familias",
                dataType:"json",
                type:"GET"
            })
            .done(function(data2){
                if(data2.error)
                {
                    $("#errores").html(data2.error);
                    $("#respuestas").html("");
                    $("#productos").html("");
                }
                else
                {
                    let html_form_editar="<h2>Editando el Producto "+cod+"</h2>";
                    html_form_editar+="<form onsubmit='event.preventDefault();validar_form_editar(\""+cod+"\")'>";
                    if(data.producto["nombre"])
                        html_form_editar+="<p><label for='nombre'>Nombre: </label><input type='text' id='nombre' value='"+data.producto["nombre"]+"'/>";
                    else
                        html_form_editar+="<p><label for='nombre'>Nombre: </label><input type='text' id='nombre' />";
                    html_form_editar+="<p><label for='nombre_corto'>Nombre Corto: </label><input type='text' id='nombre_corto' value='"+data.producto["nombre_corto"]+"' required/><span class='error' id='error_nombre_corto'></span></p>";
                    html_form_editar+="<p><label for='descripcion'>Descripción: </label><textarea id='descripcion' required>"+data.producto["descripcion"]+"</textarea></p>";
                    html_form_editar+="<p><label for='PVP'>PVP: </label><input type='number' id='PVP' min='0.01' step='0.01' value='"+data.producto["PVP"]+"' required/></p>";
                    html_form_editar+="<p><label for='familia'>Familias:</label>";
                    html_form_editar+="<select id='familia'>";
                    $.each(data2.familias,function(key,tupla){
                        if(tupla["cod"]==data.producto["familia"])
                            html_form_editar+="<option selected value='"+tupla["cod"]+"'>"+tupla["nombre"]+"</option>";
                        else
                            html_form_editar+="<option value='"+tupla["cod"]+"'>"+tupla["nombre"]+"</option>";
                    });
                    html_form_editar+="</select>";
                    html_form_editar+="<p><button onclick='event.preventDefault(); borrar_respuestas();'>Volver</button><button>Continuar</button></p>";
                    html_form_editar+="</form>";
                    $("#respuestas").html(html_form_editar);
                }
            })
            .fail(function(a,b){
                $("#errores").html(error_ajax_jquery(a,b)); 
                $("#respuestas").html("");
                $("#productos").html("");
            });
        }
    })
    .fail(function(a,b){
        $("#errores").html(error_ajax_jquery(a,b)); 
        $("#respuestas").html("");
        $("#productos").html("");
    });
}

function validar_form_editar(cod){
    $("#error_nombre_corto").html("");
    let nombre_corto=$('#nombre_corto').val();

    $.ajax({
        url:DIR_API+"/repetido/producto/nombre_corto/"+nombre_corto+"/cod/"+cod,
        dataType:"json",
        type:"GET"
    })
    .done(function(data){
        if(data.error)
        {
            $("#errores").html(data.error);
            $("#respuestas").html("");
            $("#productos").html("");
        }
        else if(data.repetido)
        {
            $("#error_nombre_corto").html(" Nombre corto repetido");
        }
        else
        {
            let nombre=$('#nombre').val();
            let descripcion=$('#descripcion').val();
            let PVP=$('#PVP').val();
            let familia=$('#familia').val();

            $.ajax({
                url:DIR_API+"/producto/actualizar/"+cod,
                dataType:"json",
                type:"PUT",
                data:{"nombre":nombre,"nombre_corto":nombre_corto,"descripcion":descripcion,"PVP":PVP,"familia":familia}
            })
            .done(function(data){
                if(data.error)
                {
                    $("#errores").html(data.error);
                    $("#respuestas").html("");
                    $("#productos").html("");
                }
                else
                {
                    $("#respuestas").html("<p class='txt_centrado mensaje'>"+data.mensaje+"</p>");
                    obtener_productos();
                }
            })
            .fail(function(a,b){
                $("#errores").html(error_ajax_jquery(a,b)); 
                $("#respuestas").html("");
                $("#productos").html("");
            });
        }
        
    })
    .fail(function(a,b){
        $("#errores").html(error_ajax_jquery(a,b)); 
        $("#respuestas").html("");
        $("#productos").html("");
    });
}

function montar_vista_agregar()
{
    $.ajax({
        url:DIR_API+"/familias",
        dataType:"json",
        type:"GET"
    })
    .done(function(data){
        if(data.error)
        {
            $("#errores").html(data.error);
            $("#respuestas").html("");
            $("#productos").html("");
        }
        else
        {
            let html_form_agregar="<h2>Creando un producto</h2>";
            html_form_agregar+="<form onsubmit='event.preventDefault();validar_form_agregar()'>";
            html_form_agregar+="<p><label for='cod'>Código: </label><input type='text' id='cod' required/><span class='error' id='error_cod'></span></p>";
            html_form_agregar+="<p><label for='nombre'>Nombre: </label><input type='text' id='nombre' />";
            html_form_agregar+="<p><label for='nombre_corto'>Nombre Corto: </label><input type='text' id='nombre_corto' required/><span class='error' id='error_nombre_corto'></span></p>";
            html_form_agregar+="<p><label for='descripcion'>Descripción: </label><textarea id='descripcion' required></textarea></p>";
            html_form_agregar+="<p><label for='PVP'>PVP: </label><input type='number' id='PVP' min='0.01' step='0.01' required/></p>";
            html_form_agregar+="<p><label for='familia'>Familias:</label>";
            html_form_agregar+="<select id='familia'>";
            $.each(data.familias,function(key,tupla){
                html_form_agregar+="<option value='"+tupla["cod"]+"'>"+tupla["nombre"]+"</option>";
            });
            html_form_agregar+="</select>";
            html_form_agregar+="<p><button onclick='event.preventDefault(); borrar_respuestas();'>Volver</button><button>Continuar</button></p>";
            html_form_agregar+="</form>";
            $("#respuestas").html(html_form_agregar);
        }
    })
    .fail(function(a,b){
        $("#errores").html(error_ajax_jquery(a,b)); 
        $("#respuestas").html("");
        $("#productos").html("");
    });
}

function validar_form_agregar()
{
    $("#error_cod").html("");
    $("#error_nombre_corto").html("");

    let cod=$('#cod').val();
    let nombre_corto=$('#nombre_corto').val();
    $.ajax({
        url:DIR_API+"/repetido/producto/cod/"+cod,
        dataType:"json",
        type:"GET"
    })
    .done(function(data){
        if(data.error)
        {
            $("#errores").html(data.error);
            $("#respuestas").html("");
            $("#productos").html("");
        }
        else if(data.repetido)
        {
            $("#error_cod").html(" Código repetido");
            $.ajax({
                url:DIR_API+"/repetido/producto/nombre_corto/"+nombre_corto,
                dataType:"json",
                type:"GET"
            })
            .done(function(data){
                if(data.error)
                {
                    $("#errores").html(data.error);
                    $("#respuestas").html("");
                    $("#productos").html("");
                }
                else if(data.repetido)
                {
                    
                    $("#error_nombre_corto").html(" Nombre corto repetido");
                }
                
            })
            .fail(function(a,b){
                $("#errores").html(error_ajax_jquery(a,b)); 
                $("#respuestas").html("");
                $("#productos").html("");
            });

        }
        else
        {
            $.ajax({
                url:DIR_API+"/repetido/producto/nombre_corto/"+nombre_corto,
                dataType:"json",
                type:"GET"
            })
            .done(function(data){
                if(data.error)
                {
                    $("#errores").html(data.error);
                    $("#respuestas").html("");
                    $("#productos").html("");
                }
                else if(data.repetido)
                {
                    $("#error_nombre_corto").html(" Nombre corto repetido");
                }
                else
                {
                    let nombre=$('#nombre').val();
                    let descripcion=$('#descripcion').val();
                    let PVP=$('#PVP').val();
                    let familia=$('#familia').val();

                    $.ajax({
                        url:DIR_API+"/producto/insertar",
                        dataType:"json",
                        type:"POST",
                        data:{"cod":cod,"nombre":nombre,"nombre_corto":nombre_corto,"descripcion":descripcion,"PVP":PVP,"familia":familia}
                    })
                    .done(function(data){
                        if(data.error)
                        {
                            $("#errores").html(data.error);
                            $("#respuestas").html("");
                            $("#productos").html("");
                        }
                        else
                        {
                            $("#respuestas").html("<p class='txt_centrado mensaje'>¡¡ Producto insertado con éxito !!</p>");
                            obtener_productos();
                        }
                    })
                    .fail(function(a,b){
                        $("#errores").html(error_ajax_jquery(a,b)); 
                        $("#respuestas").html("");
                        $("#productos").html("");
                    });


                }
                
            })
            .fail(function(a,b){
                $("#errores").html(error_ajax_jquery(a,b)); 
                $("#respuestas").html("");
                $("#productos").html("");
            });
        }
    })
    .fail(function(a,b){
        $("#errores").html(error_ajax_jquery(a,b)); 
        $("#respuestas").html("");
        $("#productos").html("");
    });

}

function obtener_detalles(cod)
{
    $.ajax({
        url:DIR_API+"/producto/"+cod,
        dataType:"json",
        type:"GET"
    })
    .done(function(data){
        if(data.error)
        {
            $("#errores").html(data.error);
            $("#respuestas").html("");
            $("#productos").html("");
        }
        else if(data.mensaje)
        {
            let html_detalle_producto="<h2>Detalles del Producto "+cod+"</h2>";
            html_detalle_producto+="<p>El producto ya no se encuentra en la BD</p>";
            $("#respuestas").html(html_detalle_producto);
            obtener_productos();
        }
        else
        {
            let html_detalle_producto="<h2>Detalles del Producto "+data.producto["cod"]+"</h2>";
            html_detalle_producto+="<p>";
            if(data.producto["nombre"])
                html_detalle_producto+="<strong>Nombre: </strong>"+data.producto["nombre"]+"<br>";
            else
                html_detalle_producto+="<strong>Nombre: </strong><br>";

            html_detalle_producto+="<strong>Nombre corto: </strong>"+data.producto["nombre_corto"]+"<br>";
            html_detalle_producto+="<strong>Descripción: </strong>"+data.producto["descripcion"]+"<br>";
            html_detalle_producto+="<strong>PVP: </strong>"+data.producto["PVP"]+" €<br>";
            html_detalle_producto+="<strong>Familia: </strong>"+data.producto["nombre_familia"]+"<br>";
            html_detalle_producto+="</p>";
            html_detalle_producto+="<p><button onclick='borrar_respuestas()'>Volver</button></p>";
            $("#respuestas").html(html_detalle_producto);
        }
    })
    .fail(function(a,b){
        $("#errores").html(error_ajax_jquery(a,b)); 
        $("#respuestas").html("");
        $("#productos").html("");
    });
}

function borrar_respuestas()
{
    $("#respuestas").html("");
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

