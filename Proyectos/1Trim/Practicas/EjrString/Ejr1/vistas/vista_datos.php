<div id="verde">
    <h2>Ripios - Resultado</h2>
    <?php
        $txt1_m = strtoupper($txt1);
        $txt2_m = strtoupper($txt2);

        $respuesta = "no riman.";

        if($txt1_m[$l_txt1-1] == $txt2_m[$l_txt2-1] && $txt1_m[$l_txt1-2] == $txt2_m[$l_txt2-2]){
            $respuesta = "riman un poco";
            if($txt1_m[$l_txt1-3] == $txt2_m[$l_txt2-3]){
                $respuesta = "riman";
            }
        }

        echo "<p>".$txt1. " y " .$txt2. " " .$respuesta."</p>";
    ?>
</div>