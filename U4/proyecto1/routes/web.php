<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    //return view('welcome');
    return 'Hola Mundo';
});

//Rutas para hacer un CRUD de Alumnos
//Ruta para consultar todos los alumnos
Route::get('/alumnos',function(){
    return '<h4>Mostrar todos los alumnos</h4>';
});
//Ruta para consultar un único alumno
Route::get('/alumnos/{idAlumno}',function($id){
    return view('alumno',compact('id'));
});
//Ruta para insertar un alumno
Route::post('/alumnos',function(){
    return '<h4>Insertar alumno </h4>';
})->name('insertar');
//Ruta para modificar un alumno
//Ruta para borrar un alumno
