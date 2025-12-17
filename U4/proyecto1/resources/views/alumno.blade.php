<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h4>Datos del alumno {{$id}}</h4>
    <h4>Insertar alumno</h4>
    <form action="{{route('insertar')}}" method="post">
        @csrf
        <button type="submit">aa</button>
    </form>
</body>
</html>