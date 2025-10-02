<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    include_once '15Menua.php'; //Genera Warning
    ?>
    <h1>Mi página web</h1>
     <?php
    require_once '15Menua.php';//Genera Error
    ?>
   <h1>Texto 1</h1>
   <?php
    include '15Menu.php';
    ?>
    <h1>Texto 2</h1>
     <?php
    require '15Menu.php';
    ?>
   <h1>Texto 3</h1>
</body>
</html>