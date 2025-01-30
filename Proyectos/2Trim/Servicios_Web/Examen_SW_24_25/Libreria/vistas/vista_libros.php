<?php
$url = DIR_SERV . "/obtenerLibros";
$respuesta = consumir_servicios_REST($url, "GET");
$json_respuesta = json_decode($respuesta, true);

if (!$json_respuesta) {
    session_destroy();
    die(error_page("Gestión Libros", "<h1>Librería</h1><p>Error consumiendo el servicio Rest: <strong>" . $url . "</strong></p>"));
}

if (isset($json_respuesta["error"])) {
    session_destroy();
    die(error_page("Gestión Libros", "<h1>Librería</h1><p>" . $json_respuesta["error"] . "</p>"));
}

echo "<h2>Lista de libros</h2>";

echo "<ul>";
    foreach ($json_respuesta["libros"] as $libro) {
        echo "<li><span><img src='images/".$libro["portada"]."' alt='Portada de libro'><span>".$libro["titulo"]."-".$libro["precio"]."</span><span></li>";
    }
echo "</ul>";
?>
