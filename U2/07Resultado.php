<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        switch($_GET['op']){
            case '+':
                $resultado = $_GET['num1'] + $_GET['num2'];
                break;
            case '-':
                $resultado = $_GET['num1'] - $_GET['num2'];
                break;
            case '*':
                $resultado = $_GET['num1'] * $_GET['num2'];
                break;
            case '/':
                $resultado = $_GET['num1'] / $_GET['num2'];
                break;
            default:
                $resultado =0;
                break;
        }
        echo 'Resultado:'.$resultado;
    ?>
</body>
</html>