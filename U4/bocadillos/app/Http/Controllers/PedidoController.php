<?php

namespace App\Http\Controllers;

use App\Models\Detalle;
use App\Models\Pedido;
use App\Models\Producto;
use Exception;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PedidoController extends Controller
{
     function __construct(){
        //Usamos el middelware de autenticación para evitar
        //el acceo a cualquier ruta de este controlador
        $this->middleware('auth');
    }

    function verProductos(){
        //Recuperar productos 
        $productos = Producto::all();
        return view('vistaProductos',compact('productos'));
    }

    //Crear pedido
    public function crearPedido(Request $r)
    {
         //Chequear que se ha pulsdo el boton nuevo pedido
        $r->validate([
            'nuevo'=> 'required'
        ]);

        try {
           

            $p = new Pedido();
            $p->cancelado = false;
            $p->user_id=Auth::user()->id;
            $p->save();
            //Guardamos el pedido en la sesión
            session(['pedido' => $p]);
            return back()->with('mensaje', 'Pedido creado:' . $p->id . '. Puedes añadir bocadillos al pedido');
        } catch (\Throwable $th) {
            return back()->with('mensaje', 'Error:' . $th->getMessage());
        }
    }

    public function insertarDetalle(Request $r)
    {
        //Validar que viene un id de producot
        $r->validate([
            'anadir' => 'required'
        ]);

        try {
            if (session('pedido') == null) {
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
            session(['pedido' => $d->pedido]);
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
            if (session('pedido') == null) {
                throw new Exception('Crea pedido');
            }
            //Comprobar si ya hay un detalle para el producto
            // En ese caso se resta 1 a la cantidad y si solamente hay 1, se borra
            //Buscar detalle
            $d = Detalle::where('pedido_id', session('pedido')->id)
                ->where('producto_id', $r->eliminar)
                ->first();
            if ($d != null) {
                if ($d->cantidad == 1) {
                    //Borrar
                    $d->delete();
                } else {
                    //Decrementar cantidad
                    $d->cantidad -= 1;
                    $d->save();
                }
                session(['pedido' => $d->pedido]);
            }
            return back()->with('mensaje', 'Borrado....');
        } catch (\Throwable $th) {
            return back()->with('mensaje', 'Error' . $th->getMessage());
        }
    }
    public function modificar(Request $r, $id)
    {
       $r->validate([
            'cancelar' => 'sometimes',
            'fin' => 'sometimes'

        ]);
        try {
            $p = Pedido::find($id);
            if ($p == null) {
                throw new Exception('No existe el pedido');
            } else {
                if ($r->has('cancelar')) {
                    $p->cancelado = true;
                } elseif ($r->has('fin')) {
                    $p->fin = true;
                }
                $p->save();
                session()->forget('pedido');
                return back()->with('mensaje', 'Pedido finalizado/cancelado');
            }
        } catch (\Throwable $th) {
            return back()->with('mensaje', 'Error al cancelar/finalizar' . $th->getMessage());
        }
    }
    public function verPedidos(){
        //Obtener los pedidos
        $pedidos = Pedido::orderBy('created_at','desc')->get();
    
        return view('vistaPedidos',compact('pedidos'));
    }

    public function verDetalle($idPedido){
        //REcuperar el pedido
        $p = Pedido::find($idPedido);
        if($p!=null){
            return back()->with('pedidoSeleccionado',$p);
        }
        else{
            return back()->with('mensaje','No se ha encontrado pedido');
        }

    }
    function borrarPedido(Request $r){
        $r->validate([
            'borrar' => 'required'
        ]);
        try {
            //Recuperar el pedido
            $p = Pedido::find($r->borrar);
            if($p==null || !$p->cancelado){
                throw new Exception('No existe pedido o no está cancelado');
            }
            if($p->user_id!=Auth::user()->id){
                throw new Exception('No puedes borrar el pedido porque es de otro usario');
            }
            DB::transaction(function() use($p){
                //Borrar el detalle del pedido
                foreach($p->detalles() as $d){
                    $d->delete();
                }
                //DB::delete('delete from detalles where pedido_id='.$p->id);
                //Borrar el pedido
                $p->delete();
                
            });
            return back()->with('mensaje','Pedido borrado');

        } catch (\Throwable $th) {
           return back()->with('mensaje','Error al borrar:'.$th->getMessage());
        }
    }
}
