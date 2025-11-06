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
    <div>
        <form action="" method="post">
            <label for="email">Email</label>
            <input type="text" name="email" id="email">
            <label for="ps">Constraseña</label>
            <input type="password" name="ps" id="ps">
            <button type="submit" name="iniciar">Iniciar</button>
            <button type="reset" name="cancelar">Cancelar</button>
            <a href="registro.php">Registrarse</a>
        </form>
    </div>
    <div>
        <?php
        if (isset($error)) {
            echo '<h3 style="color:red;">' . $error . '</h3>';
        }
        ?>
    </div>
    <div>
        <?php
        if (isset($mensaje)) {
            echo '<h3 style="color:green;">' . $mensaje . '</h3>';
        }
        ?>
    </div>

</body>

</html>