<html>
    <head>
        <title>Ejericico 7</title>
    </head>
    <body>
        <?php
           function volumenCilindro($radio,$altura) {
            $PI=3.1416;
            return $PI*($radio*$radio)*$altura." cm3";
           }
           echo volumenCilindro(20,50);
        ?>
    </body>
</html>