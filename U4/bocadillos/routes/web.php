<?php

use App\Http\Controllers\LoginController;
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

Route::controller(LoginController::class)->group(function(){
    Route::get('/login','cargarLogin')->name('login');
    Route::get('/registro','cargarRegistro')->name('registro');
    Route::post('/loguear','loguear')->name('loguear');
    Route::post('/registrar','registrar')->name('registrar');
});
