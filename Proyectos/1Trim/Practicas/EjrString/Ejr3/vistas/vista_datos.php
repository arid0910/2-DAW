<div id="verde">
    <h2>Frases palíndromas - Resultado</h2>
    <?php
        $txt1_m = strtoupper($sin_esp);
        
        $i = 0;
        $j = $l_txt1-1;
        $resultado = true;

        while($i < $j){
            if($txt1_m[$i] != $txt1_m[$j]){
                $resultado = false;
                break;
            } 
            $i++; $j--;
        } 

        if($resultado){
            echo "<p>La frase ".$txt1." es una frase palíndroma</p>";
        } else {
            echo "<p>La frase ".$txt1." no una frase palíndroma</p>";
        }
    
    ?>
</div> 