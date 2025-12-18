<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AlumnoController extends Controller
{
    //Método para obtener alumnos
    public function obtenerAlumnos(){
        return view('vistaAlumnos');
    }

    // Ver/Editar alumno
    public function verAlumno($id){
        return '<h1>Mostrar y editar datos de un alumno:'.$id.'</h1>';
    }
    // Insertar alumno
    public function insertarAlumno(){
        return '<h1>Insertar alumno</h1>';
    }
    // midificar alumno
    public function modificarAlumno($id){
        return '<h1>Moficar alumno:'.$id.'</h1>';
    }
    // borrar alumno
    public function borrarAlumno($id){
        return '<h1>Borrar un alumno:'.$id.'</h1>';
    }
}
