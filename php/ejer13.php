<html>
    <head>
        <title>Ejericico 12</title>
    </head>
    <body>
        <?php
            include ("tabla.php");
            include ("celda.php");

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