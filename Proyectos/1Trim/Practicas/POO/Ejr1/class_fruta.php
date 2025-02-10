<?php
    class Fruta{
        private $color, $tamanyo;

        public function setColor($color_nuevo){
            $this->color = $color_nuevo;
        }

        public function setTamanyo($tamanyo_nuevo){
            $this->tamanyo = $tamanyo_nuevo;
        }

        public function getColor(){
            return $this->color;
        }

        public function getTamanyo(){
            return $this->tamanyo;
        }
    }
?>