<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PedidoController extends Controller
{
    //Crear pedido
    public function crearPedido(Request $r){
        try {
            $p = new Pedido();
            $p->cancelado = false;
            $p->save();
            return back()->with('mensaje','Pedido creado. Puedes añadir bocadillos al pedido');
        } catch (\Throwable $th) {
            return back()->with('mensaje','Error'.$th->getMessage());
        }
    }
}
