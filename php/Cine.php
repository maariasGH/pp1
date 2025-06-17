<?php
    class Cine {
       private $salas = array();

       public function __construct()
       {
       }
       public function addSala(Sala $s) {
            array_push($this->salas,$s);
       }
       public function vender($cant,$nro) {
            $this->salas[$nro-1]->ocuparButacas($cant);
       }
       public function mostrarOcupacion() {
            echo "<br>";
            echo "Sala 1: ".$this->salas[0]->getButacasOcupadas()." Butacas Ocupadas";
            echo "<br>";
            echo "Sala 2: ".$this->salas[1]->getButacasOcupadas()." Butacas Ocupadas";
            echo "<br>";
            echo "Sala 3: ".$this->salas[2]->getButacasOcupadas()." Butacas Ocupadas";
       }
    }
?>