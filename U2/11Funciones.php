<?php
//Función que devuelve un texto si tipo es conc
//o la suma de dos nº si tipo es suma
//Si no, devuelve falso
function suma_concatena($dato1,$dato2,$tipo){
    if($tipo=='suma'){
        //Comproar que los datos son números
        if(is_numeric($dato1) and is_numeric($dato2)){
            return $dato1+$dato2;
        }            
        else {
            return false;
        }
    }
    elseif($tipo=='conc'){
        return $dato1.$dato2;
    }
    else{
        return false;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="get">
        Dato 1
        <input type="text" name="d1">
        Dato 2
        <input type="text" name="d2">
        <select name="tipo">
            <option>Selecciona tipo de operación</option>
            <option value="suma">Suma</option>
            <option value="conc">Concatenación</option>
        </select>
        <input type="submit" name="enviar" value="Enviar">
    </form>
    <h2>Resultado</h2>
    <?php
        //Comprobar si hemos dado a enviar
    ?>
</body>
</html>