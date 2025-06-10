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
                        echo "Celda Numero ".$c->getNumero().": ".$c->getTexto();;
                        echo "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                }             
            }
        ?>
    </body>
</html>