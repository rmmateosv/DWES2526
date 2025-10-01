<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 12</title>
</head>
<body>
    <?php
    // Creo el array vacío
    $datos = array();
    // Añado a las posiciones los datos del enunciado
    $datos[0] = 2345.65;
    $datos[1] = "Carlos";
    $datos[2] = 34;
    // Creo un array asociativo para esta posición para añadir el nombre y la edad
    $datos[3] = array("Nombre" => "María", "Edad" => 19);
    $datos[5] = array();
    $datos[5]["Nombre"]="María";
    $datos[5]["Edad"]=19;
    $aux = array();
    $aux["Nombre"]="María";
    $aux["Edad"]=19;
    $datos[6]=$aux;
    $aux[4] = true;

    // Recorro el array y muestro los valores y sus tipos
    foreach ($datos as $clave => $valor) {
        echo "Posición $clave: " . gettype($valor) . " - Valor: ";
        if (is_array($valor)) {
            echo "=> ";
            foreach ($valor as $clave2 => $valor2) {
                echo "$clave2 : $valor2 ";
            }
        } else {
            echo $valor;
        }
        echo "<br>";
    }
    ?>
</body>
</html>



