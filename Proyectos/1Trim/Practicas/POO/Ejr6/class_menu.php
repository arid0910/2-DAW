<?php
    class Menu{
        private $enlaces=array();

        public function cargar($url, $nombre){
            $this->enlaces[$nombre] = $url;
        }

        public function vertical(){
            echo "<p>";
            foreach ($this->enlaces as $key => $value) {
                echo "<a href=".$value.">".$key."</a><br/>";
            }   
            echo "</p>";
        }

        public function horizontal(){
            $imprimir="";
            foreach ($this->enlaces as $key => $value) {
                $imprimir.= "<a href=".$value.">".$key."</a> - ";
            }   
            echo "<p>".substr($imprimir,0,-2)."</p>";
        }
    }
?>