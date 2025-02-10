function obtener_productos() {
    $.ajax({
        url: DIR_API + "/productos",
        dataType: "json",
        type: "GET",
        headers: { Authorization: "Bearer " + localStorage.token }
    })
        .done(function (data) {
            if (data.error) {
                $("#errores").html(data.error);
                $("#principal").html("");
            }
            else if (data.no_auth) {
                localStorage.clear();
                cargar_vista_login("El tiempo de sesión de la API ha expirado.");
            }
            else if (data.mensaje_baneo) {
                localStorage.clear();
                cargar_vista_login("Usted ya no se encuentra registrado en la BD");
            }
            else {
                let html_tabla_productos = "<table class='txt_centrado centrado'>";
                html_tabla_productos += "<tr><th>COD</th><th>Nombre Corto</th><th>PVP (€)</th><th><button class='enlace' onclick='montar_vista_agregar()'>Productos+</button></th></tr>";
                $.each(data.productos, function (key, tupla) {
                    html_tabla_productos += "<tr>";
                    html_tabla_productos += "<td><button class='enlace' onclick='obtener_detalles(\"" + tupla["cod"] + "\")'>" + tupla["cod"] + "</button></td>";
                    html_tabla_productos += "<td>" + tupla["nombre_corto"] + "</td>";
                    html_tabla_productos += "<td>" + tupla["PVP"] + "</td>";
                    html_tabla_productos += "<td><button class='enlace' onclick='montar_vista_borrar(\"" + tupla["cod"] + "\")'>Borrar</button> - <button class='enlace' onclick='montar_vista_editar(\"" + tupla["cod"] + "\")'>Editar</button></td>";
                    html_tabla_productos += "</tr>";
                });
                html_tabla_productos += "</table>";
                $("#productos").html(html_tabla_productos);
            }
        })
        .fail(function (a, b) {
            $("#errores").html(error_ajax_jquery(a, b));
            $("#principal").html("");
        });

}

function obtener_detalles(cod) {
    if (((new Date() / 1000) - localStorage.ultm_accion) < MINUTOS * 60) {
        localStorage.setItem("ultm_accion", (new Date() / 1000));
        $.ajax({
            url: DIR_API + "/producto/" + cod,
            dataType: "json",
            type: "GET",
            headers: { Authorization: "Bearer " + localStorage.token }
        })
            .done(function (data) {
                if (data.error) {
                    $("#errores").html(data.error);
                    $("#respuestas").html("");
                    $("#productos").html("");
                }
                else if (data.mensaje) {
                    let html_detalle_producto = "<h2>Detalles del Producto " + cod + "</h2>";
                    html_detalle_producto += "<p>El producto ya no se encuentra en la BD</p>";
                    $("#respuestas").html(html_detalle_producto);
                    obtener_productos();
                }
                else if (data.no_auth) {
                    localStorage.clear();
                    cargar_vista_login("El tiempo de sesión de la API ha expirado.");
                }
                else if (data.mensaje_baneo) {
                    localStorage.clear();
                    cargar_vista_login("Usted ya no se encuentra registrado en la BD");
                }
                else {
                    let html_detalle_producto = "<h2>Detalles del Producto " + data.producto["cod"] + "</h2>";
                    html_detalle_producto += "<p>";
                    if (data.producto["nombre"])
                        html_detalle_producto += "<strong>Nombre: </strong>" + data.producto["nombre"] + "<br>";
                    else
                        html_detalle_producto += "<strong>Nombre: </strong><br>";

                    html_detalle_producto += "<strong>Nombre corto: </strong>" + data.producto["nombre_corto"] + "<br>";
                    html_detalle_producto += "<strong>Descripción: </strong>" + data.producto["descripcion"] + "<br>";
                    html_detalle_producto += "<strong>PVP: </strong>" + data.producto["PVP"] + " €<br>";
                    html_detalle_producto += "<strong>Familia: </strong>" + data.producto["nombre_familia"] + "<br>";
                    html_detalle_producto += "</p>";
                    html_detalle_producto += "<p><button onclick='borrar_respuestas()'>Volver</button></p>";
                    $("#respuestas").html(html_detalle_producto);
                }
            })
            .fail(function (a, b) {
                $("#errores").html(error_ajax_jquery(a, b));
                $("#respuestas").html("");
                $("#productos").html("");
            });
    }
    else {
        localStorage.clear();
        cargar_vista_login("Su tiempo de sesión ha expirado");
    }
}

function borrar_producto(cod) {
    if (((new Date() / 1000) - localStorage.ultm_accion) < MINUTOS * 60) {
        localStorage.setItem("ultm_accion", (new Date() / 1000));
        $.ajax({
            url: DIR_API + "/producto/borrar/" + cod,
            dataType: "json",
            type: "DELETE"
        })
            .done(function (data) {
                if (data.error) {
                    $("#errores").html(data.error);
                    $("#respuestas").html("");
                    $("#productos").html("");
                }
                else if (data.no_auth) {
                    localStorage.clear();
                    cargar_vista_login("El tiempo de sesión de la API ha expirado.");
                }
                else if (data.mensaje_baneo) {
                    localStorage.clear();
                    cargar_vista_login("Usted ya no se encuentra registrado en la BD");
                }
                else {
                    $("#respuestas").html("<p class='txt_centrado mensaje'>¡¡ Producto borrado con éxito !!</p>");
                    obtener_productos();
                }
            })
            .fail(function (a, b) {
                $("#errores").html(error_ajax_jquery(a, b));
                $("#respuestas").html("");
                $("#productos").html("");
            });
    }
    else {
        localStorage.clear();
        cargar_vista_login("Su tiempo de sesión ha expirado");
    }
}

function montar_vista_borrar(cod) {
    if (((new Date() / 1000) - localStorage.ultm_accion) < MINUTOS * 60) {
        localStorage.setItem("ultm_accion", (new Date() / 1000));

        let html_vista_borrar = "<p class='txt_centrado'>Se dispone usted a borrar el producto: <strong>" + cod + "</strong></p>";
        html_vista_borrar += "<p class='txt_centrado'>¿Estás seguro?</p>";
        html_vista_borrar += "<p class='txt_centrado'><button onclick='borrar_respuestas()'>Cancelar</button> <button onclick='borrar_producto(\"" + cod + "\")'>Continuar</button></p>";
        $("#respuestas").html(html_vista_borrar);
    }
    else {
        localStorage.clear();
        cargar_vista_login("Su tiempo de sesión ha expirado");
    }
}

function borrar_respuestas() {
    $("#respuestas").html("");
}