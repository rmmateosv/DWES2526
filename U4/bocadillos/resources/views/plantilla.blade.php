<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bacadillos</title>
</head>
<body>
    <div>
        <a href="">Ventas</a>
        <a href="">Pedidos</a>
        <a href="">Productos</a>
    </div>
    <h2>Nombre del Empleado</h2>
    <div>
        @yield('titulo')
        @yield('contenido')
    </div>
    <div>
        @if (session('mensaje'))
           <p style="color:red">{{session('mensaje')}}</p> 
        @endif
        @if ($errors->any())
            @foreach ($errors->all() as $e)
                <p style="color:red">{{$e}}</p> 
            @endforeach
        @endif

    </div>
</body>
</html>