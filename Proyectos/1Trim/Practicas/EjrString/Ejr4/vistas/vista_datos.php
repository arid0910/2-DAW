<div id="verde">
    <h2>Romanos a árabes  - Resultado</h2>
    <?php
        $resultado = 0;

        for ($i=0; $i < $txt1_l; $i++) { 
            $resultado += VALORES[$txt1_m[$i]];
        }


        echo "<p>El número romano <strong>".$txt1_m."</strong> es en árabe: <strong>".$resultado."</strong></p>"
    
    ?>
</div>  