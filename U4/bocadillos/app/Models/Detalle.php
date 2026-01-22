<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Detalle extends Model
{
    //Definir que un detalle corresponde a un producto
    function producto(){
        return $this->belongsTo(Producto::class);
    }
    //Definir que un detalle corresponde a un pedido
    function pedido(){
        return $this->belongsTo(Pedido::class);
    }
}
