const DIR_API="http://localhost/2-DAW/2-DAW/Proyectos/2Trim/Servicios_Web/Actividad5/servicios_rest_protect";

$(function(){
    if (time_out()) {
        montarVista(localStorage.getItem("usuario"), localStorage.getItem("tipo"))
    } else {
        mostarLogin()
    }
})

function mostarLogin(){
    localStorage.clear();

    let html_login = "<h1>Login Ajax</h1>"
    html_login += "<form  onsubmit='event.preventDefault(); login();'>"
    html_login += "<label for='usuario'>Usuario: </label><br/><input type='text' id='usuario' /> <span class='error' id='usuario_error'></span><br>"
    html_login += "<label for='clave'>Clave: </label><br/><input type='password' id='clave' /><br>"
    html_login += "<p class='error' id='error'></p>"
    html_login += "<button>Login</button>"
    html_login += "</form>"

    $("#respuesta").html(html_login)

    console.log("Mostrando login")
}

function login(){
    let usuario = $("#usuario").val();
    let clave = $("#clave").val();

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
                $("#error").html("<p class='error'>" + data.error + "</p>");
            } else if (data.mensaje) {
                $("#usuario_error").html("Usuario o clave incorrecto");
            }else {
                localStorage.setItem("usuario", data["usuario"]["usuario"])
                localStorage.setItem("tipo", data["usuario"]["tipo"])
                localStorage.setItem("ultima_accion", Date.now())
                location.reload()
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

function time_out() {
    let usuario = localStorage.getItem("usuario")
    let ultima_accion = Number(localStorage.getItem("ultima_accion"))

    if (!usuario || (Date.now() - ultima_accion > 5 * 60 * 1000)) {
        localStorage.clear()
        return false
    }
    localStorage.setItem("ultima_accion", Date.now())
    return true
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
