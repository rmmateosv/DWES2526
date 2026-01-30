<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ProductoController extends Controller
{
    function __construct(){
        //Usamos el middelware de autenticación para evitar
        //el acceo a cualquier ruta de este controlador
        $this->middleware('auth');
    }
    function verProductos(){
        return 'Página CRUD de productos';
    }
}
