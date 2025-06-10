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
             try {
                if (($this->butacasOcupadas+$cantidad)>$this->cantButacas) {
                    throw new Exception("La capacidad Maxima de la Sala fue rebasada");
                } else {
                    $this->butacasOcupadas=$this->butacasOcupadas+$cantidad;
                    echo "<br>";
                    echo "La Venta de ".$cantidad." Butacas en la Sala ".$this->nro." Fue Exitosa";
                    echo "<br>";
                }
            } catch (Exception $e) {
                echo "<br>";
                echo "No hay suficientes lugares disponibles en La Sala ".$this->nro;
                echo "<br>";
                echo "El numero de Butacas En la Sala es de: ".$this->cantButacas;
                echo "<br>";
                echo "La cantidad de Butacas que se intentó vender fue de ".$cantidad." y la Cantidad de Butacas Ocupadas es de ".$this->butacasOcupadas;
                echo "<br>";
            } 
        }
        public function getButacasOcupadas() {
            return $this->butacasOcupadas;
        }
    }
?>
