<html>
    <head>
        <title>Ejericico 11</title>
    </head>
    <body>
        <?php
           class Persona {
                private $nombre;
                private $edad;
            public function __construct($nombre,$edad)
            {
                $this->nombre = $nombre;
                $this->edad = $edad;
            }
            public function setNombre($nombre) {
                $this->nombre = $nombre;
            }
            public function setEdad($edad) {
                $this->edad = $edad;
            }
            public function getNombre() {
                return $this->nombre;
            }
            public function getEdad() {
                return $this->edad;
            }
           }
           class Empleado extends Persona {
                private $sueldo;
            public function __construct($nombre,$edad,$sueldo) {
            parent::__construct($nombre,$edad);
                $this->sueldo = $sueldo;
            }
            public function getSueldo() {
                return $this->sueldo;
            }
            public function setSueldo($sueldo) {
                $this->sueldo = $sueldo;
            }
           }
           $p1 = new Persona("Mariano",21);
           $e1 = new Empleado("Tiziano",20,20000);
           echo "Nombre de la Persona: ".$p1->getNombre();
           echo "<br>";
           echo "Edad de la Persona: ".$p1->getEdad();
           echo "<br>";
           echo "Nombre del Empleado: ".$e1->getNombre();
           echo "<br>";
           echo "Edad del Empleado: ".$e1->getEdad();
           echo "<br>";
           echo "Sueldo del Empleado: ".$e1->getSueldo();
        ?>
    </body>
</html>