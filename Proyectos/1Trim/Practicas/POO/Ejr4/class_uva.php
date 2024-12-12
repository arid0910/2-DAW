<?php
    require "class_fruta.php";

    class Uva extends Fruta{
        private $tieneSemilla;

        public function __construct($color_nuevo, $tamanyo_nuevo, $tieneSemi){
            parent::__construct($color_nuevo, $tamanyo_nuevo, $tieneSemi);
            $this->tieneSemilla=$tieneSemi;
        }

        public function tieneSemilla(){
            return $this->tieneSemilla;
        }
    }

   
?>