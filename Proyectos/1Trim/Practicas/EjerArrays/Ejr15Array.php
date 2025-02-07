<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <?php
        $numeros = array("a" => 3, "b" => 2, "c" => 8, 
        "d" => 123, "e" => 5, "f" => 1);

        asort($numeros);
  
        echo "<table>";
            echo "<tr>";
                echo "<th>Key</th>";
                echo "<th>Value</th>";
            echo "</tr>";
            foreach ($numeros as $key => $value) {
                echo "<tr>";  
                    echo "<td>".$key."</td>";    
                    echo "<td>".$value."</td>";  
                echo "</tr>";
            }
        echo "</table>";
    ?>
</body>
</html>