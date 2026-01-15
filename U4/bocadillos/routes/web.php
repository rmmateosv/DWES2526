<?php

use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::controller(ProductoController::class)->group(function(){
    Route::get('/productos','verProductos')->name('verProductos');
});
