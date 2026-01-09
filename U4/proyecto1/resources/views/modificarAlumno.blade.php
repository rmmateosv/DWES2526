<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{route('modificar',$alumno->id)}}" method="post">
            @method('PUT')
            @csrf <!-- Pasar token de autenticación, si no, no se envía el formulario -->
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" value="{{$alumno->nombre}}"/>
            @error('nombre')
                <span style="color:red;">Rellena el nombre</span>
            @enderror
            <label for="curso">Curso</label>
            <input type="text" id="curso" name="curso"  value="{{$alumno->curso}}"/>
            @error('curso')
                <span style="color:red;">Rellena el curso</span>
            @enderror
            <button type="submit" name="guardarAlumno">Guardar Alumno</button>
        </form>
          
    <p style="color:red">
        @if ($errors->any())            
            @foreach ($errors->all() as $e)
                <h4>{{$e}}</h4>      
            @endforeach
        @endif
    </p>
    <p style="color:red">
        @if(session('mensaje'))
            {{session('mensaje')}}
        @endif
    </p>
</body>
</html>