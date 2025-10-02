<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Matricula de dal alumnos</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <fieldset>
            <legend>Datos del Alumno</legend>
            <label for="nombre">Nombre</label><br>
            <input type="text" name="nombre" id="nombre"><br>
            <label>Sexo</label><br>
            <label for="Hombre">Hombre</label>
            <input type="radio" name="sexo" id="Hombre" value="H">
            <label for="Mujer">Mujer</label>
            <input type="radio" name="sexo" id="Mujer" value="M" checked="checked"><br>
            <label for="foto">Foto</label><br>
            <input type="file" name="foto" id="foto"><br>
        </fieldset>
        <fieldset>
            <legend>Datos Matrícula</legend>
            <label for="fecha">Fecha Incorporación</label><br>
            <input type="date" name="fecha" id="fecha">
            <input type="time" name="hora" id="hora"><br>
            <label for="ciclo">Ciclo</label><br>
            <select name="ciclo" id="ciclo">
                <option value="Sistemas Microinformáticos y Redes">SMR</option>
                <option value="Desarrollo de Aplicaciones Web" selected="selected">DAW</option>
                <option value="Desarrollo de Aplicaciones Multiplataforma">DAM</option>
                <option value="Administración de Sistemas Informáticos en Red">ASIR</option>
            </select><br>
            <label for="asig">Asignaturas</label>
            <select name="asig[]" id="asig" multiple="multiple">
                <option>PRO</option>
                <option>LM</option>
                <option>BD</option>
                <option>DWES</option>
                <option>DWEC</option>
                <option>DAW</option>
            </select><br>
            <label for="beca">Becas</label><br>
            <label for="libros">Libros</label>
            <input type="checkbox" name="beca[]" id="libros" value="Libros">
            <label for="transp">Transporte</label>
            <input type="checkbox" name="beca[]" id="transp" value="Transporte">
            <label for="aloj">Alojamiento</label>
            <input type="checkbox" name="beca[]" id="aloj" value="Alojamiento"><br>
            <label for="observ">Observaciones</label>
            <textarea name="observacion" id="observ"></textarea>
        </fieldset>

        <input type="submit" value="Enviar" name="enviar">
        <input type="reset" value="Limpiar" name="limpiar">
        <button type="submit" name=enviar2><img src="img/bEnviar.png" alt="Enviar" height="16px"></button>
    </form>
    <?php
    //Comprobar si se ha pulsado en enviar
    if(isset($_POST['enviar']) || isset($_POST['enviar2'])){
        //Crear tabla para mostrar datos
    ?>
    <table border="1">
        <tr>
            <td>
                Campo del formulario
            </td>
            <td>
                Valor
            </td>
        </tr>
        <?php
        //Recuperar el nombre si se ha rellenado
        if(!empty($_POST['nombre'])){
            echo '<tr><td>Nombre</td>';
            echo '<td>'.$_POST['nombre'].'</td></tr>';
        }
        //Subir foto al servidor y mostrar
        if(isset($_FILES['foto'])){
            //Subir fichreo a carpeta img
            if(move_uploaded_file($_FILES['foto']['tmp_name'],'img/'.$_FILES['foto']['name'])){
                //Mostrar en la tabla
               echo '<tr><td>Foto</td>';
               echo '<td><img src="img/'.$_FILES['foto']['name'].'" height="30px"></td></tr>'; 
            }
        }
        //Recuperar el sexo si se ha rellenado
        if(!empty($_POST['sexo'])){
            echo '<tr><td>Sexo</td>';
            echo '<td>'.$_POST['sexo'].'</td></tr>';
        }
        //Recuperar la fecha si se ha rellenado
        if(!empty($_POST['fecha'])){
            echo '<tr><td>Fecha</td>';
            echo '<td>'.$_POST['fecha'].'</td></tr>';
        }
        //Recuperar la fecha si se ha rellenado
        if(!empty($_POST['hora'])){
            echo '<tr><td>Hora</td>';
            echo '<td>'.$_POST['hora'].'</td></tr>';
        }
        //Recuperar el ciclo si se ha rellenado
        if(!empty($_POST['ciclo'])){
            echo '<tr><td>Ciclo</td>';
            echo '<td>'.$_POST['ciclo'].'</td></tr>';
        }
        //Recuperar asignaturas si se ha rellenado
        if(isset($_POST['asig'])){
            echo '<tr><td>Asignaturas</td>';
            echo '<td>';
            //Recorremos el array para mostrar todas las asignaturas
            foreach($_POST['asig'] as $a){
                echo $a.' ';
            }
            echo '</td></tr>';
        }
        //Recuperar becas si se ha rellenado
        if(isset($_POST['beca'])){
            echo '<tr><td>Becas</td>';
            echo '<td>';
            //Recorremos el array para mostrar todas las asignaturas
            foreach($_POST['beca'] as $b){
                echo $b.' ';
            }
            echo '</td></tr>';
        }
        //Recuperar observaciones
        if(!empty($_POST['observacion'])){
            echo '<tr><td>Observaciones</td>';
            echo '<td>'.$_POST['observacion'].'</td></tr>';
        }
        ?>
    </table>
    <?php
    }
    ?>
</body>
</html>