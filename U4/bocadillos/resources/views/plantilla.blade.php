<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bacadillos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                <a class="navbar-brand"  href="{{route('inicio')}}">Ventas</a>
                </li>
                <li class="nav-item">
                <a class="navbar-brand"  href="{{route('pedidos')}}">Pedidos</a>
                </li>
                <li class="nav-item">
                <a class="navbar-brand"  href="{{route('productos')}}">Productos</a>
                </li>
            </ul>
            <span class="navbar-text">
                @auth
                    {{Auth::user()->name}}
                @endauth
            </span>
            <nav class="navbar bg-body-tertiary">
                <a  class="btn btn-sm btn-outline-secondary" href="{{route('cerrar')}}">Salir</a>                
            </nav>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        @yield('titulo')
        <p></p>
        @yield('contenido')
       
        <div class="row">
            <div class="col">
                @if (session('mensaje'))
                    <div class="p-3 text-success-emphasis bg-success-subtle border border-success-subtle rounded-3">{{session('mensaje')}}</div> 
                @endif
                @if ($errors->any())
                    @foreach ($errors->all() as $e)
                        <div class="p-3 text-danger-emphasis bg-danger-subtle border border-danger-subtle rounded-3">{{$e}}</div> 
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</body>
</html>