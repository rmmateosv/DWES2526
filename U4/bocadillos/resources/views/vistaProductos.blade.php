@extends('plantilla')


@section('titulo')
    <h6 class="h6">Venta de bocadillos</h3>
@endsection

@section('contenido')

    <div class="row">
        <div class="col">
            <table class="table">
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
        <div class="col">       
                @if (session('pedido'))
                    <h3>Pedido:{{session('pedido')->id}} Total:{{session('pedido')->total()}}</h3>
                    <table class="table">
                        <tr>
                            <td>Producto</td>
                            <td>Imagen</td>
                            <td>Cantidad</td>
                            <td>Precio</td>
                            <td>Total</td>
                        </tr>
                    @foreach (session('pedido')->detalles() as $d)
                        <tr>
                            <td>{{$d->producto->nombre}}</td>
                            <td>
                            <img src="{{ ($d->producto->foto==null?asset('img/generica.png'):
                            asset($d->producto->foto)) }}" alt="producto"></td>
                            <td>{{$d->cantidad}}</td>
                            <td>{{$d->precio}}</td>
                            <td>{{($d->cantidad*$d->precio)}}</td>
                        </tr>
                    @endforeach
                    </table>
        
                    <form action="{{route('modificar',session('pedido')->id)}}" method="post">
                        @csrf
                        @method('PUT')
                        <button type="submit" name="fin">Finalizar</button>
                        <button type="submit"  name="cancelar">Cancelar</button>
                    </form>

                @else
                    <form action="{{route('crearPedido')}}" method="post">
                        @csrf
                        <button type="submit" name="nuevo" value="nuevo">Nuevo Pedido</button>
                    </form>
                @endif    
        </div>
    </div>
@endsection
