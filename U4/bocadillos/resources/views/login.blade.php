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
   <div class="container-fluid">
        <h1>Bienvenido a Bocadillos</h1>
        <form action="{{route('loguear')}}" method="post">
            @csrf
            <input type="email" name="email" placeholder="email"/><br>
            <input type="password" name="ps" placeholder="password"/><br/>
            <button type="submit">Login</button>
            <a href="{{route('registro')}}">Registrarse</a>
        </form>
    
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