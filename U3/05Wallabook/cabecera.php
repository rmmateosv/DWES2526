<?php
require_once 'controlador.php';
//Si no estoy logueado, redirigir a login
if(!isset($_SESSION['us'])){
    header('location:login.php');
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
