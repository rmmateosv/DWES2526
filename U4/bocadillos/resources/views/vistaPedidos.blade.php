@extends('plantilla')


@section('titulo')
    <h6 class="h6">Venta de bocadillos</h3>
@endsection

@section('contenido')

    <div class="row">
        <div class="col">
            <table class="table">
                <tr>
                    <td>Id</td>
                    <td>Fecha</td>
                    <td>Cancelado</td>
                    <td>Fianlizado</td>
                    <td>Vendedor</td>
                    <td>Acciones</td>
                </tr>
                @foreach ($pedidos as $p)
                    <tr>
                        <td>{{$p->id}}</td>
                        <td>{{date('d/m/Y h:i:s',strtotime($p->created_at))}}</td>
                        <td>{{($p->cancelado?'X':'')}}</td>
                        <td>{{($p->fin?'X':'')}}</td>
                        <td>{{$p->usuario->name}}</td>
                        <td>
                            <a href="{{route('detalle',$p->id)}}">Ver Detalle</a>
                            @if ($p->user_id==Auth::user()->id)
                                <button>Borrar</button>    
                            @endif
                            
                        </td>
                        
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="col">       
                @if (session('pedidoSeleccionado'))
                    <table>
                        <tr>
                            <td>Producto</td>
                            <td>Foto</td>
                            <td>Cantidad</td>
                            <td>Precio</td>
                            <td>Total</td>
                        </tr>
                    @foreach (session('pedidoSeleccionado')->detalles() as $d)
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
                    
                @endif
        </div>
    </div>
@endsection
