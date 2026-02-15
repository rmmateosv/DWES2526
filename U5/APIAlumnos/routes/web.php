<?php

use App\Http\Controllers\AlumnoController;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//Definir todas las rutas de la api
Route::apiResource('apiAlumnos',AlumnoController::class)
            ->withoutMiddleware(VerifyCsrfToken::class);
