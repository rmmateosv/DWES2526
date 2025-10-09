<?php
function recordarInput($campo)
{
    return (!empty($_POST[$campo]) ? $_POST[$campo] : '');
}
function recordarRadioSelect($campo, $valor, $opocionPorDefecto, $atributo)
{
    if ($opocionPorDefecto) {
        return (!isset($_POST[$campo]) || $_POST[$campo] == $valor ? $atributo : '');
    } else {
        return (isset($_POST[$campo]) && $_POST[$campo] == $valor ? $atributo : '');
    }
}
function rellenarMultipleCheck($campo, $valor, $atributo)
{
    return (isset($_POST[$campo]) && in_array($valor, $_POST[$campo]) ? $atributo : '');
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
    <h1>Matricula de dal alumnos</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <fieldset>
            <legend>Datos del Alumno</legend>
            <label for="nombre">Nombre</label><br>
            <input type="text" name="nombre" id="nombre" value="<?php echo recordarInput('nombre') ?>"><br>
            <label>Sexo</label><br>
            <label for="Hombre">Hombre</label>
            <input type="radio" name="sexo" id="Hombre" value="H" <?php
                                                                    echo recordarRadioSelect('sexo', 'H', false, 'checked') ?>>
            <label for="Mujer">Mujer</label>
            <input type="radio" name="sexo" id="Mujer" value="M" <?php
                                                                    echo recordarRadioSelect('sexo', 'M', true, 'checked') ?>><br>
            <label for="foto">Foto</label><br>
            <input type="file" name="foto" id="foto"><br>
        </fieldset>
        <fieldset>
            <legend>Datos Matrícula</legend>
            <label for="fecha">Fecha Incorporación</label><br>
            <input type="date" name="fecha" id="fecha" value="<?php
                                                                echo (isset($_POST['fecha']) ? $_POST['fecha'] : date('Y-m-d'));
                                                                ?>">
            <input type="time" name="hora" id="hora" value="<?php
                                                            echo (isset($_POST['hora']) ? $_POST['hora'] : date('H:i'));
                                                            ?>"><br>
            <label for="ciclo">Ciclo</label><br>
            <select name="ciclo" id="ciclo">
                <option value="Sistemas Microinformáticos y Redes" <?php
                                                                    echo recordarRadioSelect('ciclo', 'Sistemas Microinformáticos y Redes', false, 'selected') ?>>SMR</option>
                <option value="Desarrollo de Aplicaciones Web" <?php
                                                                echo recordarRadioSelect('ciclo', 'Desarrollo de Aplicaciones Web', true, 'selected') ?>>DAW</option>
                <option value="Desarrollo de Aplicaciones Multiplataforma" <?php
                                                                            echo recordarRadioSelect('ciclo', 'Desarrollo de Aplicaciones Multiplataforma', false, 'selected') ?>>DAM</option>
                <option value="Administración de Sistemas Informáticos en Red" <?php
                                                                                echo recordarRadioSelect('ciclo', 'Administración de Sistemas Informáticos en Red', false, 'selected') ?>>ASIR</option>
            </select><br>
            <label for="asig">Asignaturas</label>
            <select name="asig[]" id="asig" multiple="multiple">
                <option <?php echo rellenarMultipleCheck('asig', 'PRO', 'selected') ?>>PRO</option>
                <option <?php echo rellenarMultipleCheck('asig', 'LM', 'selected') ?>>LM</option>
                <option <?php echo rellenarMultipleCheck('asig', 'BD', 'selected') ?>>BD</option>
                <option <?php echo rellenarMultipleCheck('asig', 'DWES', 'selected') ?>>DWES</option>
                <option <?php echo rellenarMultipleCheck('asig', 'DWEC', 'selected') ?>>DWEC</option>
                <option <?php echo rellenarMultipleCheck('asig', 'DAW', 'selected') ?>>DAW</option>
            </select><br>
            <label for="beca">Becas</label><br>
            <label for="libros">Libros</label>
            <input type="checkbox" name="beca[]" id="libros" value="Libros" <?php
                                                                            echo rellenarMultipleCheck('beca', 'Libros', 'checked') ?>>
            <label for="transp">Transporte</label>
            <input type="checkbox" name="beca[]" id="transp" value="Transporte" <?php
                                                                                echo rellenarMultipleCheck('beca', 'Transporte', 'checked') ?>>
            <label for="aloj">Alojamiento</label>
            <input type="checkbox" name="beca[]" id="aloj" value="Alojamiento" <?php
                                                                                echo rellenarMultipleCheck('beca', 'Alojamiento', 'checked') ?>><br>
            <label for="observ">Observaciones</label>
            <textarea name="observacion" id="observ"><?php echo recordarInput('observacion') ?></textarea>
        </fieldset>
        <input type="submit" value="Enviar" name="enviar">
        <input type="reset" value="Limpiar" name="limpiar">
        <button type="submit" name=enviar2><img src="img/bEnviar.png" alt="Enviar" height="16px"></button>
    </form>
    <?php
    //Comprobar si se ha pulsado en enviar
    if (isset($_POST['enviar']) || isset($_POST['enviar2'])) {
        //Chequear errores => VALD
        //1 Nombre es obligatorio
        if(empty($_POST['nombre'])){
            echo '<h3 style="color:red;">Error, debes rellenar el nombre</h3>';
            $error = true;
        }
        //2 DAM no puede tener beca de libros
        if(isset($_POST['ciclo']) && $_POST['ciclo']=='Desarrollo de Aplicaciones Multiplataforma' && 
        isset($_POST['beca']) && in_array('Libros',$_POST['beca'])){
            echo '<h3 style="color:red;">Error, no puedes tener beca de libros si eres alumno de DAM</h3>';
            $error = true;
        }
        //3 Mínimo hay que marcar 3 asignaturas
        if(!isset($_POST['asig']) || sizeof($_POST['asig'])<3){
            echo '<h3 style="color:red;">Error, al menos debes rellanar 3 asignaturas</h3>';
            $error = true;
        }
        //4 La fecha de matricula debe ser anterior a hoy
        if(isset($_POST['fecha'])&& strtotime($_POST['fecha'])>strtotime(date('Y-m-d'))){
             echo '<h3 style="color:red;">Error, la fecha no puede estar en el futuro</h3>';
            $error = true;
        }
        //5 Si la beca de alojamiento esá marcada, hay que rellenar observaciones
        //6 Si tienen beca de transporte no puede tener la de alojamiento
        //7 El tamaño del fichero debe ser menor de 1M

        if(!isset($error)){
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
            if (!empty($_POST['nombre'])) {
                echo '<tr><td>Nombre</td>';
                echo '<td>' . $_POST['nombre'] . '</td></tr>';
            }
            //Subir foto al servidor y mostrar
            if (isset($_FILES['foto'])) {
                //Subir fichreo a carpeta img
                if (move_uploaded_file($_FILES['foto']['tmp_name'], 'img/' . $_FILES['foto']['name'])) {
                    //Mostrar en la tabla
                    echo '<tr><td>Foto</td>';
                    echo '<td><img src="img/' . $_FILES['foto']['name'] . '" height="50px"></td></tr>';
                }
            }
            //Recuperar el sexo si se ha rellenado
            if (!empty($_POST['sexo'])) {
                echo '<tr><td>Sexo</td>';
                echo '<td>' . $_POST['sexo'] . '</td></tr>';
            }
            //Recuperar la fecha si se ha rellenado
            if (!empty($_POST['fecha'])) {
                echo '<tr><td>Fecha</td>';
                echo '<td>' . $_POST['fecha'] . '</td></tr>';
            }
            //Recuperar la fecha si se ha rellenado
            if (!empty($_POST['hora'])) {
                echo '<tr><td>Hora</td>';
                echo '<td>' . $_POST['hora'] . '</td></tr>';
            }
            //Recuperar el ciclo si se ha rellenado
            if (!empty($_POST['ciclo'])) {
                echo '<tr><td>Ciclo</td>';
                echo '<td>' . $_POST['ciclo'] . '</td></tr>';
            }
            //Recuperar asignaturas si se ha rellenado
            if (isset($_POST['asig'])) {
                echo '<tr><td>Asignaturas</td>';
                echo '<td>';
                //Recorremos el array para mostrar todas las asignaturas
                foreach ($_POST['asig'] as $a) {
                    echo $a . ' ';
                }
                echo '</td></tr>';
            }
            //Recuperar becas si se ha rellenado
            if (isset($_POST['beca'])) {
                echo '<tr><td>Becas</td>';
                echo '<td>';
                //Recorremos el array para mostrar todas las asignaturas
                foreach ($_POST['beca'] as $b) {
                    echo $b . ' ';
                }
                echo '</td></tr>';
            }
            //Recuperar observaciones
            if (!empty($_POST['observacion'])) {
                echo '<tr><td>Observaciones</td>';
                echo '<td>' . $_POST['observacion'] . '</td></tr>';
            }
            ?>
        </table>
        <?php
        }
    }
    ?>
</body>

</html>