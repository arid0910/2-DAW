const DIR_API="http://localhost/2DAW/Proyectos/2Trim/Servicios_Web/Actividad5/servicios_rest_protect";

$(function(){
        mostarLogin()
})

function mostarLogin(){
    localStorage.clear();

    let html_login = "<h1>Login Ajax</h1>"
    html_login += "<form  onsubmit='event.preventDefault(); login();'>"
    html_login += "<label for='usuario'>Usuario: </label><br/><input type='text' id='usuario' /><br>"
    html_login += "<label for='clave'>Clave: </label><br/><input type='password' id='clave' /><br>"
    html_login += "<p class='error' id='error'></p>"
    html_login += "<button>Login</button>"
    html_login += "</form>"

    $("#respuesta").html(html_login)
}

function login(){
    let usuario = $("#usuario").val();
    let clave = md5($("#clave").val());

    if(usuario === "" || clave === ""){
        $("#error").html("Usuario y clave son obligatorios");
        return;
    }

    $("#error").html("");

    $.ajax({
        url: DIR_API + "/login",
        dataType: "json",
        type: "POST",
        data: {'usuario': usuario, 'clave': clave},
    })
        .done(function(data) {
            if (data.error) {
                $("#errores").html("<p class='error'>" + data.error + "</p>");
            } else if (data.mensaje) {
                $("#errores").html("Usuario o clave incorrecto");
            }else {

            }
        })
        .fail(function (a, b) {
            $("#error").html(error_ajax_jquery(a, b));
        });
}

function montarVista(usuario, tipo) {
    let mensaje_login
    mensaje_login = "<h3>Bienvenido " + usuario + "</h3>"
    mensaje_login += "<p>Tipo: " + tipo + "</p>"
    mensaje_login += "<button onclick='volver()'>Volver</button>"
    $("#respuesta").html(mensaje_login)
}

function volver(){
    localStorage.clear();
    mostarLogin();
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
