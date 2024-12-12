<?php
     class Empleados{
        private $nombre, $sueldo;

        public function __construct($nombre_nuevo, $sueldo_nuevo){
            $this->nombre = $nombre_nuevo;
            $this->sueldo = $sueldo_nuevo;
        }

        public function setNombre($nombre_nuevo){
            $this->nombre = $nombre_nuevo;
        }

        public function setSueldo($sueldo_nuevo){
            $this->sueldo = $sueldo_nuevo;
        }

        public function getNombre(){
            return $this->nombre;
        }

        public function getSueldo(){
            return $this->sueldo;
        }

        public function imprimir(){
            echo "<h3>Empleado</h3>";
            echo "<p><strong>Nombre: </strong>".$this->nombre."</p>";
            echo "<p><strong>Sueldo: </strong>".$this->sueldo."</p>";

            if($this->sueldo > 3000){
                echo "<p><strong>Impuestos: </strong>Paga</p>";
            }else{
                echo "<p><strong>Impuestos: </strong>No paga</p>";
            }
        }
    }
?>