<?php
require_once 'Evento.php';

if (isset($_POST['crear'])) {
    if (empty($_POST['fecha']) || empty($_POST['hora']) || empty($_POST['asunto'])) {
        $error = 'Error: Hay campos vacíos';
    } else {
        //Crear un objeto Evento
        $e = new Evento($_POST['fecha'], $_POST['hora'], $_POST['asunto']);

        //Comprobar si la cookie está creada
        if(!isset($_COOKIE['datos'])){
            //Crear un array vacío
            $datos = array();
        }
        else{
            $datos=unserialize($_COOKIE['datos']);
        }
        //Añadir evento a cookie
        $datos[]=$e;
        setcookie('datos',serialize($datos),time()+365*24*60*60);
        //Recargar página
        header('location:index.php');
    }
}
elseif(isset($_POST['borrar'])){
    //Recuperar los datos de la cookie
    $datos = unserialize($_COOKIE['datos']);
    //Eliminar del arry la posición indicada en el botón borrar
    unset($datos[$_POST['borrar']]);
    //Reindexar el array
    array_values($datos);
    //Actualizar la cookie
    setcookie('datos',serialize($datos),time()+365*24*60*60);
    //Recargar página
    header('location:index.php');
}

?>