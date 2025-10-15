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
    <div style="display: flex; flex-direction: row;">
        <div style="border:1px solid black;margin:5px; padding:5px;">
            <!-- Formulario -->
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
                    <textarea name="observacion" id="observ"><?php
                                                                echo recordarInput('observacion') ?></textarea>
                </fieldset>
                <input type="submit" value="Enviar" name="enviar">
                <input type="reset" value="Limpiar" name="limpiar">
                <button type="submit" name=enviar2><img src="../img/bEnviar.png" alt="Enviar" height="16px"></button>
            </form>
            <?php
            if (isset($a)) {
                //Mostrar el alumno creado
                $a->mostrar();
            }
            ?>
            <div>
                <?php if (isset($error)) {
                    echo '<h3 style="color:red">' . $error . '</h3>';
                } ?>
            </div>
        </div>
        <div style="border:1px solid black;margin:5px; padding:5px;">
            <!-- Tabla con datos del fichero -->
            <table border="1px">
                <tr>
                    <td>Nombre</td>
                    <td>Foto</td>
                    <td>Sexo</td>
                    <td>Ciclo</td>
                    <td>Fecha/Hora Matrícula</td>
                    <td>Asignaturas</td>
                    <td>Becas</td>
                    <td>Observaciones</td>
                </tr>
            </table>
        </div>
    </div>

</body>

</html>