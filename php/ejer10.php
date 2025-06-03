<html>
    <head>
        <title>Ejericico 10</title>
    </head>
    <body>
        <?php
           class Empleado {
                private $nombre;
                private $sueldo;
            public function __construct($nombre,$sueldo) {
                $this->nombre = $nombre;
                $this->sueldo = $sueldo;
            }
            public function getSueldo() {
                return $this->sueldo;
            }
            public function pagaImpuesto() {
                if ($this->sueldo>3000) {
                    echo "Debe pagar Impuestos";
                } else {
                    echo "No Debe pagar Impuestos";
                }
            }
           }
           $e1 = new Empleado("Mariano",3000);
           $e1->pagaImpuesto();
        ?>
    </body>
</html>