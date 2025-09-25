<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $n = $_GET['nombre']; //Recuperar de la url la variable nombre
        $e = $_GET['edad']; //Recuperar de la url la variable edad
    ?>
    <h1>Nombre: <?php echo $n?></h1>
    <h1>Edad: <?php echo $e?></h1>
</body>
</html>