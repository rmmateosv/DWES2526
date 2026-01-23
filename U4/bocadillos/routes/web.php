<?php

use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('verProductos');
});

Route::controller(ProductoController::class)->group(function(){
    Route::get('/productos','verProductos')->name('verProductos');
});

Route::controller(PedidoController::class)->group(function(){
    Route::post('/pedido','crearPedido')->name('crearPedido');
    Route::post('/insertarD','insertarDetalle')->name('insertarD');
    Route::post('/eliminarD','eliminarDetalle')->name('eliminarD');
    Route::put('/modificar/{id}','modificar')->name('modificar');
});
