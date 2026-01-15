<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h2>Nombre del Empleado</h2>
    <div style="display: flex; flex-direction: row">
        <div>
            <h2>Selecciona producto</h2>
            <table>
                <tr>
                    <td>Nombre</td>
                    <td>Foto</td>
                    <td>Acción</td>
                </tr>
                @foreach ($productos as $p)
                    <tr>
                        <td>{{$p->nombre}}</td>
                        <td><img src="{{ ($p->foto==null?asset('img/generica.png'):asset($p->foto)) }}" alt="producto"></td>
                        <td>
                            <button type="submit" name="anadir" value="{{$p->id}}">+</button>
                            <button type="submit" name="eliminar" value="{{$p->id}}">-</button>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>

        <div>

        </div>
    </div>
    
</body>
</html>