<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- El formulario se envía a este mismo script php, ya que action está vacío -->
    <form action="" method="get">
        <label for="nombre">Nombre</label><br>
        <input type="text" placeholder="Introduce tu nombre" name="nombre" id="nombre"><br>
        <label for="edad">Edad</label><br>
        <input type="number" name="edad" id="edad"><br>
        <label for="estatura">Estatura</label><br>
        <input type="number" name="estatura" id="estatura" step="0.01" value="1.60"><br>
        <label for="curso">Curso</label><br>
        <select name="curso" id="curso">
            <option value="1º Desarrollo Web">1ºDAW</option>
            <option value="2º Desarrollo Web">2ºDAW</option>
        </select><br>
        <label for="color">Color Favorito</label><br>
        <input type="color" name="color" id="color" value="black"><br>
        <button type="submit" name="crearArray" value="crear">Crear Array</button>
    </form>

    <?php
    //Comprobar si se ha pulsdo en botón crear array
    if(isset($_GET['crearArray'])){
        //Crear un array escalar vacío para guadar los datos del formulario
        $datos = array();
        //Añadir el nombre
        $datos[]= $_GET['nombre'];
        //Añadir edad
        $datos[]= $_GET['edad'];
        //Añadir estatura
        $datos[]= $_GET['estatura'];
        //Añadir curso
        $datos[]= $_GET['curso'];
        //Añadir color
        $datos[]= $_GET['color'];
        //Añadir Centro
        $datos[]='IES AUGUSTÓBRIGA';
        //aÑADIR Cp
        $datos[]=10300;

        //Añadir al array 5 nºs aleatorios
        for($i=0;$i<5;$i++){
            $datos[]=rand();
        }

        //Añadir la posiíon con ínidice 100 y valor mi apellido
        $datos[100]='Mateos';
        //Introducir 2º apellido
        $datos[]='Vicente';

        //Mostrar el array con función var_dump
        echo '<p>Info del array $datos</p>';
        echo var_dump($datos);

        //Mostrar el array $datos en forma de tabla vertical
        //El color del texto debe ser el color elegido en el formulario

        echo '<h3>Tabla Vertical</h3>';
        echo '<table border="1" style="color:'.$_GET['color'].'">';
            echo '<tr><th>Índice</th><th>Valor</th></tr>';
            //Recorre array $datos con foreach
            foreach($datos as $indice=>$valor){
                echo '<tr><td>'.$indice."</td><td>$valor</td></tr>";
            }
        echo '</table>';
        ?>
        <h3>Tabla Horizontal</h3>
        <table border="1" style="color:<?php echo $_GET['color']?>">
            <tr>
                <!-- Pintar los índices del array -->
                <?php 
                foreach($datos as $i=>$v){
                    echo '<td>'.$i.'</td>';
                }
                ?>
            </tr>
            <tr>
                <!-- Pintar los valores del array -->
                 <?php 
                foreach($datos as $v){
                    echo '<td>'.$v.'</td>';
                }
                ?>
            </tr>
        </table>
    <?php
    }
    ?>
</body>
</html>