<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="07Resultado.php" method="get">
        <label for="n1">Número 1</label>
        <input type="number" name="num1" id="n1"><br>
        <label for="n2">Número 2</label>
        <input type="number" name="num2" id="n2"><br>
        <label for="n2">Operación</label>
        <select name="op" id="op">
            <option value="+">+</option>
            <option value="-">-</option>
            <option>*</option>
            <option>/</option>
        </select><br>
        <input type="submit" name="calc" value="Calcular">
    </form>
</body>
</html>