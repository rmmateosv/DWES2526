<?php
//Crear una cookie que sirva de contador de accesos a esta pweb
if(isset($_COOKIE['contador'])){
    //Sumar 1 al valor del contador
    setcookie('contador',$_COOKIE['contador']+1,time()+31*24*60*60);
}
else{
    //Crear la cookie que caduca en un mes
    setcookie('contador',1,time()+31*24*60*60);
}

if(isset($_POST['cambiarFondo'])){
    setcookie('color',$_POST['color']);
    if(isset($_COOKIE['contador'])){
        setcookie('contador',$_COOKIE['contador']-1,time()+31*24*60*60);
    }
    header('location:01Cookies.php');
}
if(isset($_POST['reiniciar'])){
    setcookie('color','',time()-1); //Caducamos la cookie para que no se tenga en cuenta
    setcookie('contador','',time()-1); //Caducamos la cookie para que no se tenga en cuenta
    header('location:01Cookies.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body style="background-color: <?php echo (isset($_COOKIE['color'])?$_COOKIE['color']:'white'); ?>;">
    <h3>Nº de acceso:<?php echo (isset($_COOKIE['contador'])?$_COOKIE['contador']+1:1)?></h3>
    <form action="" method="post">
        <label for="color">Color de fondo</label>
        <input type="color" name="color" id="color">
        <button type="submit" name="cambiarFondo">Cambiar Color Fondo</button>
        <button type="submit" name="reiniciar">Reiniciar Color Fondo</button>
    </form>
</body>
</html>