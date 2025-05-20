<html>
    <head>
        <title>Ejericico 4</title>
    </head>
    <body>
        <?php
           $c1 = "Comer Verduras";
           $c2 = "Es Realmente Sano";
           $c3 = $c1." ".$c2;
            echo $c3;
            echo '<br>';
            echo 'La Posicion de la palabra Verduras es: '.strpos($c3, "Verduras");
        ?>
    </body>
</html>