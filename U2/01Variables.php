<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $nombre='Rosa';
        $edad = 25;
        $altura = 1.54;
        $beca = true;
    ?>
    <table>
        <tr>
            <td>Variable</td>
            <td>Contenido</td>
            <td>Tipo</td>
        </tr>
        <tr>
            <td>Nombre</td>
            <td><?php echo $nombre;?></td>
            <td><?php echo gettype($nombre);?></td>
        </tr>
        <tr>
            <td>Edad</td>
            <td><?php echo $edad;?></td>
            <td><?php echo gettype($edad);?></td>
        </tr>
        <tr>
            <td>Altura</td>
            <td><?php echo $altura;?></td>
            <td><?php echo gettype($altura);?></td>
        </tr>
        <tr>
            <td>Beca</td>
            <td><?php echo $beca;?></td>
            <td><?php echo gettype($beca);?></td>
        </tr>
    </table>

    <?php
    echo '<h1>CONSTANTES PREDEFINIDAS</h1>';
    echo '<p>Versión de PHP'.PHP_VERSION.'</p>';
    echo '<p>Fin de línea'.PHP_EOL.'</p>';
    echo '<h1>CONSTANTES DE USUARIO</h1>';
    define('IVA',21.00);
    const MAYOR_EDAD = 18;
    echo '<p>IVA:' . IVA . '</p>';
    echo '<p>Mayor de edad:'.MAYOR_EDAD.'</p>';
    ?>
</body>
</html>