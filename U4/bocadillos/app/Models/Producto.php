<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    //Definir relación 1:N con detalle
    function detalles(){
        return $this->hasMany(Detalle::class)->get();
    }
}
