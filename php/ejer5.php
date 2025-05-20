<html>
    <head>
        <title>Ejericico 5</title>
    </head>
    <body>
        <?php
           $i = 0;
           echo 'Numeros con While:';
           echo '<br>';
           while ($i!=10) {
            $i++;
            echo $i;
            echo '<br>';
           }
           echo 'Numeros con For:';
           echo '<br>';
           for ($i=1;$i!=11;$i++) {
            echo $i;
            echo '<br>';
           }
        ?>
    </body>
</html>