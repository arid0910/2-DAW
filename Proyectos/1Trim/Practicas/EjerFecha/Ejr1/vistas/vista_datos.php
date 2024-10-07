<div id="verde">
    <h2>FECHAS - RESPUESTA</h2>
    <?php
        $fec1_arr = explode("/", $_POST["fecha1"]);  
        $fec2_arr = explode("/", $_POST["fecha2"]);  
        
        $tiempo1= mktime(0,0,0,$fec1_arr[1], $fec1_arr[0], $fec1_arr[2]);
        $tiempo2= mktime(0,0,0,$fec2_arr[1], $fec2_arr[0], $fec2_arr[2]);

        $dif_seg = abs($tiempo1 - $tiempo2);
        $dif_dias = $dif_seg/(60*60*24);
        
        echo "<p>La diferencia de días entre las dos fechas introducidas es: " . floor($dif_dias) . "</p>";
    ?>
</div>   