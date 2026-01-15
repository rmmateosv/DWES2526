<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ProductoController extends Controller
{
    function verProductos(){
        //Recuperar productos 
        $productos = Producto::all();
        return view('vistaProductos',compact('productos'));
    }
}
