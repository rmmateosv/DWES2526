<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('productos',ProductoController::class)->middleware('auth:sanctum');


Route::controller(LoginController::class)->group(
    function(){
        Route::post('registro','registro');
        Route::post('login','login');
    }
);

//Ruta salir, debe estar autenticado
Route::get('salir',[LoginController::class,'salir'])->middleware('auth:sanctum');

