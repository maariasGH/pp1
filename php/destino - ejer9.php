<html>
    <head>
        <title>Ejericico 9</title>
    </head>
    <body>
        <?php
           echo "Los Valores ingresados en el formulario son:";
           echo "<br>";
           try {
                if (isset($_GET["nombre"])) {
                   if ($_GET["nombre"]!="") {
                    echo "Nombre: ".$_GET["nombre"];
                   } else {
                    throw new Exception("El Nombre Esta Vacio");
                   }
                }
           } catch (Exception $e) {
                echo "El Nombre esta vacio";
           }
           
           echo "<br>";
           try {
               if (isset($_GET["apellido"])) {
                    if ($_GET["apellido"]!="") {
                        echo "Apellido: ".$_GET["apellido"];
                    } else {
                        throw new Exception("El Apellido Esta Vacio");
                    }
                }
           } catch (Exception $e) {
                echo "El Apellido esta vacio";
           }
           
           
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