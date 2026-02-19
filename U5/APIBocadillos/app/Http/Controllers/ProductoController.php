<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Exception;
use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Producto::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            //code...
            $request->validate([
                'nombre'=>'required',
                'precio'=>'required'
            ]);

            $p = new Producto();
            $p->nombre=$request->nombre;
            $p->precio=$request->precio;
            if($p->save()){
                return $p;
            }
            else{
                throw new Exception('Error al crear el producto');
            }
        } catch (\Throwable $th) {
            return response(['mensaje'=>$th->getMessage()],500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        return $producto;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        //
    }
}
