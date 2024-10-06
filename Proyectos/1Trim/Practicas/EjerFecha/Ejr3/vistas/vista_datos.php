<div id="verde">
    <h2>Romanos a árabes  - Resultado</h2>
    <?php
        $suma = 0;
        $num = (int)$txt1;
        $num_rom = "";

        while($num > 0){
            if($num > 1000){
                $num -= 1000;
                $num_rom .= "M";
            } else if($num > 500){
                $num -= 500;
                $num_rom .= "D";
            } else if ($num > 100){
                $num -= 100;
                $num_rom .= "C";
            } else if($num > 50){
                $num -= 50;
                $num_rom .= "L";
            } else if($num > 10){
                $num -= 10;
                $num_rom .= "X";
            } else if ($num > 5){
                $num -= 5;
                $num_rom .= "V";
            } else {
                $num -= 1;
                $num_rom .= "I";
            }
        }

        echo "<p>El número <strong>".$txt1."</strong> es en números romanos: <strong>".$num_rom."</strong></p>";
    ?>
</div>   