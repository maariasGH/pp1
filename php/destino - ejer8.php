<html>
    <head>
        <title>Ejericico 8</title>
    </head>
    <body>
        <?php
           function informarMayor($p1,$p2) {
            if ($p1>$p2) {
                echo $p1." Es Mayor a ".$p2;
            } else {
                echo $p2." Es Mayor a ".$p1;
            }
           }
           informarMayor(10,5);
           echo "<br>";
           informarMayor($_GET["n1"],$_GET["n2"]);
        ?>
    </body>
</html>