<?php

namespace App\Http\Controllers;

use App\Models\Detalle;
use App\Models\Pedido;
use App\Models\Producto;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PedidoController extends Controller
{
    //Crear pedido
    public function crearPedido(Request $r)
    {
        try {
            $p = new Pedido();
            $p->cancelado = false;
            $p->save();
            //Guardamos el pedido en la sesión
            session(['pedido' => $p]);
            return back()->with('mensaje', 'Pedido creado:' . $p->id . '. Puedes añadir bocadillos al pedido');
        } catch (\Throwable $th) {
            return back()->with('mensaje', 'Error' . $th->getMessage());
        }
    }

    public function insertarDetalle(Request $r)
    {
        //Validar que viene un id de producot
        $r->validate([
            'anadir' => 'required'
        ]);

        try {
            if(session('pedido')==null){
                throw new Exception('Crea pedido');
            }
            //Comprobar si ya hay un detalle para el producto
            // En ese caso se suma 1 a la cantidad
            //Buscar detalle
            $d = Detalle::where('pedido_id', session('pedido')->id)
                ->where('producto_id', $r->anadir)
                ->first();
            if ($d == null) {
                $d = new Detalle();
                $d->pedido_id = session('pedido')->id; //code...
                $d->producto_id = $r->anadir;
                $d->cantidad = 1;
                $d->precio = Producto::find($r->anadir)->precio;
            } else {
                $d->cantidad += 1;
            }
            //Insert/update
            $d->save();
            session(['pedido'=>$d->pedido]);
            return back()->with('mensaje', 'Añadido....');
        } catch (\Throwable $th) {
            return back()->with('mensaje', 'Error' . $th->getMessage());
        }
    }
    public function eliminarDetalle(Request $r)
    {
        //Validar que viene un id de producot
        $r->validate([
            'eliminar' => 'required'
        ]);

        try {
            if(session('pedido')==null){
                throw new Exception('Crea pedido');
            }
            //Comprobar si ya hay un detalle para el producto
            // En ese caso se resta 1 a la cantidad y si solamente hay 1, se borra
            //Buscar detalle
            $d = Detalle::where('pedido_id', session('pedido')->id)
                ->where('producto_id', $r->eliminar)
                ->first();
            if ($d != null) {
               if($d->cantidad==1){
                //Borrar
                $d->delete();
               }else{
                //Decrementar cantidad
                $d->cantidad-=1;
                $d->save();
               }
               session(['pedido'=>$d->pedido]);
            }
            return back()->with('mensaje', 'Borrado....');
        } catch (\Throwable $th) {
            return back()->with('mensaje', 'Error' . $th->getMessage());
        }
    }
}
