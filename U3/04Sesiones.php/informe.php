<?php
session_start();
if(!isset($_SESSION['centro'])){
    header('location:ies.php');
}
elseif(!isset($_SESSION['curso'])){
    header('location:curso.php');
}
elseif(!isset($_SESSION['alumno'])){
    header('location:alumno.php');
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
    <h1>Centro:<?php echo $_SESSION['centro']?></h1>
    <h1>Curso:<?php echo  $_SESSION['curso']?></h1>
    <h1>Alumno:<?php echo $_SESSION['alumno']?></h1>
</body>
</html>