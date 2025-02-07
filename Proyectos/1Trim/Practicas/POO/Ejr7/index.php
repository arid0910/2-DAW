<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actividad POO</title>
</head>

<body>
    <h1>Actividad POO</h1>
    <?php
    require 'clase_films.php';

    $matrix_1 = new Film("Matrix", 1999, "Lana y Lilly Wachowski", false, 19.99, false);
    $matrix_2 = new Film("Matrix Reloaded", 2003, "Lana y Lilly Wachowski", true, 21.50, "01-06-2025");
    $matrix_3 = new Film("Matrix Revolutions", 2003, "Lana y Lilly Wachowski", true, 23.00, "20-11-2024");
    $matrix_4 = new Film("Matrix Resurrections", 2021, "Lana Wachowski", false, 26.75, false);

    $lista_films = [$matrix_1, $matrix_2, $matrix_3, $matrix_4];

    echo '<form action="index.php" method="post">';
    echo "<label for='seleccion_films'>Elige un film: </label>";
    echo "<select name='seleccion_films' id='seleccion_films'>";
    foreach ($lista_films as $film) {
        if (isset($_POST["verFilm"]) && $_POST["seleccion_films"] == $film->getTitulo()) {
            echo "<option selected value='" . $film->getTitulo() . "'>" . $film->getTitulo() . "</option>";
            $film_elegido = $film;
            break;
        } else {
            echo "<option value='" . $film->getTitulo() . "'>" . $film->getTitulo() . "</option>";
        }
    }
    echo "</select>";

    echo '<button type="submit" name="verFilm">Ver detalles</button>';
    echo "</form>";

    if (isset($film_elegido)) {
        $estadoAlquiler = $film_elegido->getAlquilada() ? "Sí" : "No";
        echo "<p>El film seleccionado es <strong>" . $_POST["seleccion_films"] . "</strong>, del año <strong>" . $film_elegido->getAnyo() . "</strong></p>";
        echo "<p>Dirigido por <strong>" . $film_elegido->getDirector() . "</strong>. <strong> " . $estadoAlquiler . " está alquilado</strong> con un precio de <strong>" . $film_elegido->getPrecio() . "€</strong></p>";

        if ($film_elegido->getAlquilada()) {
            echo "<p>Fecha de devolución estimada: <strong>" . $film_elegido->getFechaDevolucion() . "</strong></p>";
            $dias_pendientes = $film_elegido->calcularDias();
            if (is_string($dias_pendientes)) {
                echo "<p>" . $dias_pendientes . "</p>";
            } else {
                echo "<p>Faltan " . $dias_pendientes . " días para devolverlo.</p>";
            }
        }
    }
    ?>
</body>

</html