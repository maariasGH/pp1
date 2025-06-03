<html>
    <head>
        <title>Ejericico 12</title>
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
            public function mostrarCaracteristicas() {
                echo "Caracteristicas de La Persona: <br>";
                echo "Nombre: ";
                echo $this->nombre."<br>";
                echo "Edad: ";
                echo $this->edad."<br>";
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
            public function mostrarCaracteristicas() {
                parent::mostrarCaracteristicas();
                echo "Caracteristicas de Empleado <br>";
                echo "Sueldo: ";
                echo $this->sueldo."<br>";
            }
           }
           $p1 = new Persona("Mariano",21);
           $e1 = new Empleado("Tiziano",20,20000);
           echo $p1->mostrarCaracteristicas();
           echo $e1->mostrarCaracteristicas();
        ?>
    </body>
</html>