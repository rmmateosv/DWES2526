<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Mi primera página en php</h1>
    <?php
        echo '<h2>Hola Mundo</h2>';
    ?>
    <table>
        <tr>
            <th>Fecha</th>
            <th>Hora</th>
        </tr>
        <?php
            //Mostrar día en una celda de la tabla
            echo '<tr><td>'.date('d/m/Y').'</td>';
            //Mostrar hora en una celdad de la tabla
            echo '<td>'.date('H:i:s').'</td></tr>';
        ?>
        <tr>
            <td><?php echo date('d/m/Y');?></td>
            <td><?php echo date('H:i:s');?></td>
        </tr>
    </table>
</body>
</html>