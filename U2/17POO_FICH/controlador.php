<?php
require_once 'Alumno.php';

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

//Comprobar si se ha pulsado en enviar
if (isset($_POST['enviar']) || isset($_POST['enviar2'])) {
    //Chequear errores => VALD
    //1 Nombre es obligatorio
    if (empty($_POST['nombre'])) {
        echo '<h3 style="color:red;">Error, debes rellenar el nombre</h3>';
        $error = true;
    }
    //2 DAM no puede tener beca de libros
    if (
        isset($_POST['ciclo']) && $_POST['ciclo'] == 'Desarrollo de Aplicaciones Multiplataforma' &&
        isset($_POST['beca']) && in_array('Libros', $_POST['beca'])
    ) {
        echo '<h3 style="color:red;">Error, no puedes tener beca de libros si eres alumno de DAM</h3>';
        $error = true;
    }
    //3 Mínimo hay que marcar 3 asignaturas
    if (!isset($_POST['asig']) || sizeof($_POST['asig']) < 3) {
        echo '<h3 style="color:red;">Error, al menos debes rellanar 3 asignaturas</h3>';
        $error = true;
    }
    //4 La fecha de matricula debe ser anterior a hoy
    if (isset($_POST['fecha']) && strtotime($_POST['fecha']) > strtotime(date('Y-m-d'))) {
        echo '<h3 style="color:red;">Error, la fecha no puede estar en el futuro</h3>';
        $error = true;
    }
    //5 Si la beca de alojamiento esá marcada, hay que rellenar observaciones
    if (isset($_POST['beca']) && in_array('Alojamiento', $_POST['beca']) && empty($_POST['observacion'])) {
        echo '<h3 style="color:red;">Error, la beca de alojamiento requiere observaciones</h3>';
        $error = true;
    }
    //6 Si tienen beca de transporte no puede tener la de alojamiento
    if (isset($_POST['beca']) && in_array('Alojamiento', $_POST['beca']) && in_array('Transporte', $_POST['beca'])) {
        echo '<h3 style="color:red;">Error, la beca de alojamiento es incompatible con la de transporte</h3>';
        $error = true;
    }
    //7 El tamaño del fichero debe ser menor de 1M = 1048576B
    if (isset($_FILES['foto']) && $_FILES['foto']['size'] > 1048576) {
        echo '<h3 style="color:red;">Error, el fichero no puede superar 1M</h3>';
        $error = true;
    }

    if (!isset($error)) {
       //Crear un objeto de la clase Alumno 
       $a = new Alumno($_POST['nombre'],
                        (isset($_FILES['foto'])?$_FILES['foto']['name']:null),
                        (isset($_POST['sexo'])?$_POST['sexo']:null),
                        (isset($_POST['fecha'])?$_POST['fecha']:null),
                        (isset($_POST['hora'])?$_POST['hora']:null),
                        (isset($_POST['ciclo'])?$_POST['ciclo']:null),
                        $_POST['asig'],
                        (isset($_POST['beca'])?$_POST['beca']:null),
                        (isset($_POST['observacion'])?$_POST['observacion']:null)
                    );
        //Mostrar el alumnos creado
        $a->mostrar();
        
    }
}

?>