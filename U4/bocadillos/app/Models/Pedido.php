<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pedido extends Model
{
    //Definir realación 1:N con detalle
    function detalles(){
        return $this->hasMany(Detalle::class)->get();
    }

    function total(){
        return DB::select('SELECT sum(cantidad * precio) as total
            from detalles
            where pedido_id ='.$this->id)[0]->total;
    }
}
