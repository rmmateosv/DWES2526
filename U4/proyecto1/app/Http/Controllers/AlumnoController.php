<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Alumno;
use Exception;

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
    public function insertarAlumno(Request $request){
       //Validar que se ha rellenado el nombre y el curso
     
        $request->validate([
            'nombre'=>'required',
            'curso' => 'required'
       ]);
       try{
        //Creamos un objeto de la clase (modelo) Alumno
        $a = new Alumno();
        //Rellenamos atributos de clase Alumno, que son lo campos de la tabla en la BD
        //con lo datos del formulario que vienen en $request
        $a->nombre=$request->nombre;
        $a->curso=$request->curso;
        //Insertar alumno con datos d $a
        if(!$a->save()){
            throw new Exception('Error al crear el alumno');
        }else{
            return back()->with('mensaje','Alumno creado con id:'.$a->id);
        }
       }
       catch (\Throwable $th) {
        return back()->with('mensaje',$th->getMessage());
       }
       
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
