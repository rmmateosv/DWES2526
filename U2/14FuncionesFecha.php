<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        echo '<h1>Hoy es '.date('d/m/Y H:i:s').'</h1>';
        echo '<h1>Hoy es '.date('l, d \d\e F \d\e Y').'</h1>';

        $instanteActual = time();
        echo '<h1>Numéro de segundos desde 1/1/1970 hasta ahora '.$instanteActual.'</h1>';
        echo '<h1>Ahora '.date('d/m/Y H:i:s',$instanteActual).'</h1>';
        echo '<h1>Ayer '.date('d/m/Y H:i:s',$instanteActual-24*60*60).'</h1>';   
        echo '<h1>Hace un año '.date('d/m/Y H:i:s',$instanteActual-365*24*60*60).'</h1>';   

        echo '<h1>Yo nací un'. date('l, d/m/Y',strtotime('2000-04-06')).'</h1>';
    ?>
</body>
</html>