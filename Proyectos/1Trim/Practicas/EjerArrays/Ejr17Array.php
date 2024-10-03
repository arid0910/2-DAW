<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 17</title>
</head>
<body>
    <?php
        $familia["Los Simpson"] = [
            "padre" => "Homer",
            "madre" => "Marge",
            "hijos" => [
                "hijo1" => "Bart",
                "hijo2" => "Lisa",
                "hijo3" => "Maggie"
            ]
        ];

        $familia["Los Griffin"] = [
            "padre" => "Peter",
            "madre" => "Lois",
            "hijos" => [
                "hijo1" => "Chris",
                "hijo2" => "Meg",
                "hijo3" => "Stewie"
            ]
        ];

        echo "<ul>";
        foreach($familia as $key=>$value) {
            echo "<li>".$key."</li>";
            echo "<ul>";
            foreach($value as $key2=>$value2) {
                if (!is_array($value2)) {
                    echo "<li>".$key2.": ".$value2."</li>";
                } else {
                    echo "<li>".$key2.": "."</li>";
                    echo "<ul>";
                    foreach($value2 as $key3=>$value3) {
                        echo "<li>".$key3.": ".$value3."</li>";
                    }
                    echo "</ul>";
                }
            }
            echo "</ul>";
        }
        echo "</ul>";
    ?>
</body>
</html>