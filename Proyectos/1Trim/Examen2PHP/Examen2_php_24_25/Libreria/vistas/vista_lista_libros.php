 <!-- Muestra los libros de la bd -->
 <h2>Lista de libros</h2>
    <?php 
        try {
            $consulta = "select * from `libros`";
            $select_datos_libro = mysqli_query($conexion,$consulta);
        } catch (Exception $e) {
            session_destroy();
            die(error_page("Examen PHP 2", "Error al conectar a la BD: ".$e.""));
        }
        echo "<div id='contenedor'>";
            while($tupla_libros=mysqli_fetch_assoc($select_datos_libro)){
                echo "<div class='itemCont'>";
                    echo "<img src='Images/".$tupla_libros["portada"]."' alt='Portada'>";
                    echo "<p>".$tupla_libros["titulo"]." - ".$tupla_libros["precio"]."</p>";
                echo "</div>";
            }
        echo "<div>";
    ?>