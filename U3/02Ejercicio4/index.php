<?php 
require_once 'controlador.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <h2>Calendario de Eventos</h2>
        <table>
            <tr>
                <td>Fecha</td>
                <td>Hora</td>
                <td>Asunto</td>
                <td>Acción</td>
            </tr>
            <!-- REcuperar los datos de la cookie y mostrarlos -->
             <?php
             if(isset($_COOKIE['datos'])){
                foreach($_COOKIE['datos'] as $evento){
                    echo '<tr>';
                    echo '<td>'.$evento->getFecha().'</td>';
                    echo '<td>'.$evento->getHora().'</td>';
                    echo '<td>'.$evento->getAsunto().'</td>';
                    echo '<td><button type="submit" name="borrar">Borrar</button></td>';
                    echo '</tr>';
                }
             }
             ?>
        </table>
    </form>
</body>
</html>