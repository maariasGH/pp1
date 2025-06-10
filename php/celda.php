<html>
    <head>
        <title>Ejericico 12</title>
    </head>
    <body>
        <?php
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
        ?>
    </body>
</html>