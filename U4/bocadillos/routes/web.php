<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('inicio');
});

Route::controller(ProductoController::class)->group(function(){
    Route::get('/productos','verProductos')->name('productos');
});

Route::controller(PedidoController::class)->group(function(){
    Route::get('/inicio','verProductos')->name('inicio');
    Route::post('/pedido','crearPedido')->name('crearPedido');
    Route::post('/insertarD','insertarDetalle')->name('insertarD');
    Route::post('/eliminarD','eliminarDetalle')->name('eliminarD');
    Route::put('/modificar/{id}','modificar')->name('modificar');
    Route::get('/pedidos','verPedidos')->name('pedidos');
});

Route::controller(LoginController::class)->group(function(){
    Route::get('/login','cargarLogin')->name('login');
    Route::get('/registro','cargarRegistro')->name('registro');
    Route::post('/loguear','loguear')->name('loguear');
    Route::post('/registrar','registrar')->name('registrar');
    Route::get('/cerrar','cerrarSesion')->name('cerrar');
});
