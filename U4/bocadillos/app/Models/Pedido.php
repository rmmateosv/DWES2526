<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    //Definir realación 1:N con detalle
    function detalles(){
        return $this->hasMany(Detalle::class)->get();
    }
}
