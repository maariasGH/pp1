<html>
    <head> 
        <title>Ejercicio 1 PHP</title> 
    </head>
    <body>
        <?php
            include ("Cine.php");
            include ("Sala.php");

            $ci = new Cine();
            $s1 = new Sala(50,1);
            $s2 = new Sala(30,2);
            $s3 = new Sala(40,3);
            $ci->addSala($s1);
            $ci->addSala($s2);
            $ci->addSala($s3);
            for ($x=0;$x<100;$x++) {
                echo "Venta Nro ".($x+1);
                $ci->vender(rand(1,2),rand(1,3));
            }
            $ci->mostrarOcupacion();
        ?>
    </body>
</html> 