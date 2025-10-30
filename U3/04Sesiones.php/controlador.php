<?php
session_start();

if(isset($_POST['bCurso'])){
    //Guardar el ies en una variable de sesión
    $_SESSION['centro'] = $_POST['centro'];
    //Cargar página curso.php
    header('location:curso.php');
}
elseif(isset($_POST['bAlumno'])){
    $_SESSION['curso'] = $_POST['curso'];
    //Cargar página alumno.php
    header('location:alumno.php');
}
elseif(isset($_POST['bInforme'])){
    $_SESSION['alumno'] = $_POST['alumno'];
    //Cargar página informe.php
    header('location:informe.php');
}
else{
    //Cargar página ies.php, si no se ha pulsado en ninguna opción
     header('location:ies.php');  
}
?>