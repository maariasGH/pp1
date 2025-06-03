<html>
    <head>
        <title>Ejericico 12</title>
    </head>
    <body>
        <?php
            class Tabla {
                private $celdas;

                public function __construct() {
                    $this->celdas = array();
                }   
                public function add(Celda $c) {
                    array_push($this->celdas,$c);
                }
                public function mostrarCeldas() {
                    echo "<table>";
                    echo "<table border = 1>";
                    foreach ($this->celdas as $c) {
                        echo "<tr>";
                        echo "<td>";    
                        echo "Celda Numero ".$c->getNumero().":";
                        echo "</td>";
                        echo "<td>";
                        echo $c->getTexto();
                        echo "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                }             
            }
            class Celda {
                private $nro_celda;
                private $texto_celda;

                public function __construct() {
                }
                public function setNumero($numero) {
                    $this->nro_celda=$numero;
                }
                public function setTexto($texto) {
                    $this->texto_celda=$texto;
                }
                public function getNumero() {
                    return $this->nro_celda;
                }
                public function getTexto() {
                    return $this->texto_celda;
                }
            }
            $t = new Tabla();
            for ($i=0;$i<10;$i++) {
                $c = new Celda();
                $c->setNumero($i+1);
                $c->setTexto("Texto Celda ".$i+1);
                $t->add($c);
            }
            $t->mostrarCeldas();
        ?>
    </body>
</html>