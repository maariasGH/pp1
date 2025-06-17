<?php
    class Sala {
        private $nro;
        private $cantButacas;
        private $butacasOcupadas;

        public function __construct($cantButacas,$nro) {
            $this->cantButacas=$cantButacas;
            $this->nro=$nro;
        }
        public function ocuparButacas($cantidad) {
            if (($this->butacasOcupadas+$cantidad)>$this->cantButacas) {
                throw new Exception("La capacidad Maxima de la Sala fue rebasada");
            } else {
                $this->butacasOcupadas=$this->butacasOcupadas+$cantidad;
                echo "<br>";
                echo "La Venta de ".$cantidad." Butacas en la Sala ".$this->nro." Fue Exitosa";
                echo "<br>";
            }
        }
        public function getButacasOcupadas() {
            return $this->butacasOcupadas;
        }
    }
?>
