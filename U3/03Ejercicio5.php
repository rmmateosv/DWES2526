<?php
session_start();
if(isset($_POST['cerrar'])){
    //session_destroy();
    session_unset();
    exit();
   // header('location:03Ejercicio5.php');
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
    <?php
    //Si no he accedido nunca, mensaje de Bienvenida
    //Si he accedido, mostrar fecha y hora de acceso
    if(isset($_SESSION['accesos'])){
        echo '<p>Accesos Anteriores<p>';
        foreach($_SESSION['accesos'] as $a){
            echo '<p>'.$a.'</p>';
        }
    }
    else{
        echo '<p>Bienvenido a Ejercicio 5</p>';
    }
    //Guardo el acceso en la sesión
    $_SESSION['accesos'][]= date('d/m/Y H:i:s');
    ?>    
    <form action="" method="post">
        <button type="submit" name="cerrar">Cerrar Sesión</button>
    </form>
</body>
</html>