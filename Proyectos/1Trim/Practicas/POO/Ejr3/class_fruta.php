<?php
    class Fruta{
        private $color, $tamanyo;
        private static $n_fruta=0;

        public function __construct($color_nuevo, $tamanyo_nuevo){
            $this->color = $color_nuevo;
            $this->tamanyo = $tamanyo_nuevo;
            self::$n_fruta++;
        }

        public function __destruct(){
            self::$n_fruta--;
        }

        public static function cuantaFruta(){
            return self::$n_fruta;
        }

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

        private function imprimir(){
            echo "<h2>Info sobre mi fruta</h2>";
            echo "<h3>Pera</h3>";
            echo "<p><strong>Color:</strong> ".$this->color."</p>";
            echo "<p><strong>Tamaño:</strong> ".$this->tamanyo."</p>";
        }
    }
?> 