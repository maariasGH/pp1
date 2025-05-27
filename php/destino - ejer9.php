<html>
    <head>
        <title>Ejericico 9</title>
    </head>
    <body>
        <?php
           echo "Los Valores ingresados en el formulario son:";
           echo "<br>";
           echo "Nombre: ".$_GET["nombre"];
           echo "<br>";
           echo "Apellido: ".$_GET["apellido"];
           echo "<br>";
           if ($_GET["sexo"]=="on") {
            echo "Sexo: NB";
           } else {
            echo "Sexo: ".$_GET["sexo"];
           }  
           echo "<br>";
           echo "Estado Civil: ".$_GET["ecivil"];
           echo "<br>";
           if (isset($_GET["deseo"])) {
            echo "Recibir Información: Si";
           } else {
            echo "Recibir Información: No";
           }
           echo "<br>";  
           if (isset($_GET["acepto"])) {
            echo "Acepto Condiciones: Si";
           } else {
            echo "Acepto Condiciones: No";
           }
        ?>
    </body>
</html>