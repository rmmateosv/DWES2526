@extends('plantilla')


@section('titulo')
    <h3>Venta de bocadillos</h3>
@endsection

@section('contenido')
<div style="display: flex; flex-direction: row">
    <div style="border:1px solid red;margin:20px;">
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
                        @if (session('pedido'))                            
                        <form action="{{route('insertarD')}}" method="post">
                            @csrf
                            <button type="submit" name="anadir" value="{{$p->id}}">+</button>
                        </form>
                        <form action="{{route('eliminarD')}}" method="post">
                            @csrf
                            <button type="submit" name="eliminar" value="{{$p->id}}">-</button>
                        </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

    <div style="border:1px solid red;margin:20px">
        <form action="{{route('crearPedido')}}" method="post">
            @csrf
            @if (session('pedido'))
                <h3>Pedido:{{session('pedido')->id}}</h3>
                <table border="1">
                    <tr>
                        <td>Producto</td>
                        <td>Cantidad</td>
                        <td>Precio</td>
                    </tr>
                @foreach (session('pedido')->detalles() as $d)
                    <tr>
                        <td>{{$d->producto->nombre}}</td>
                        <td><img src="{{ ($d->producto->foto==null?asset('img/generica.png'):asset($d->producto->foto)) }}" alt="producto"></td>
                        <td>{{$d->cantidad}}</td>
                        <td>{{$d->precio}}</td>
                        <td>{{($d->cantidad*$d->precio)}}</td>
                    </tr>
                @endforeach
                </table>

            @else
                <button>Nuevo Pedido</button>
            @endif
            
        </form>
    </div>
</div>

@endsection
