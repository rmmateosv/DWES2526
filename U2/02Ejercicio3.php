<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    //Declaramos una variable y la inicializamos con u nº aleatorio entre 0 y 10
    $numero = rand(0,10);
    echo '<p><b><u>Nota</u></b>:'.$numero.'</p>';
    echo '<p><b><u>Calificacion</u></b>:';
    if($numero<5){
        echo '<span style="color:red">Suspenso</span>';
    }
    elseif($numero==5){
        echo '<span style="color:green">Suficiente</span>';
    }
    elseif($numero==6){
        echo '<span style="color:green">Bien</span>';
    }
    elseif($numero==7 or $numero==8){
        echo '<span style="color:green">Notable</span>';
    }
     elseif($numero==9 or $numero==10){
        echo '<span style="color:green">Sobresaliente</span>';
    }
     
    echo '</p>';
    ?>
</body>
</html>