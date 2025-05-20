<html>
    <head>
        <title>Ejericico 6</title>
    </head>
    <body>
        <?php
            $numeros = array (1,2,3,4,5,6,7,8,9,10);
            $x= "x";
            echo '<table border=1>';
            echo '<td>';
            echo $x;
            echo '</td>';
            for ($t=0;$t<10;$t++){
                echo '<td>';
                echo $numeros[$t];
                echo '</td>'; 
            }
            for ($i=0;$i<10;$i++) {
                echo '<tr>';
                echo '<td>';
                echo $numeros[$i];
                echo '</td>';
                for ($c=0;$c<10;$c++) {
                    echo '<td>';
                    echo $numeros[$i]*($c+1);
                    echo '</td>';
                }
                echo '</tr>';
            }
            echo '</table>';
        ?>
    </body>
</html>