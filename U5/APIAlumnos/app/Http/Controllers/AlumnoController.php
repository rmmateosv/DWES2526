<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use Exception;
use Illuminate\Http\Request;

class AlumnoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Alumno::all();
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            //code...
            //Validar datos obligatorios
            $request->validate([
                'nombre' => 'required|unique:alumnos',
                'curso' => 'required'
            ]);
            //Crear el alumnos con los datos que vienen en la petición
            $a = new Alumno();
            $a->nombre = $request->nombre;
            $a->curso = $request->curso;
            if ($a->save()) {
                return $a;
            } else {
                throw new Exception('Error al crear el alumno');
            }
        } catch (\Throwable $th) {
            return response(['message'=>$th->getMessage()],500);
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(Alumno $apiAlumno)
    {
        return $apiAlumno;
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $alumno)
    {
        //
        try {
             //Validar datos obligatorios
            $request->validate([
                'nombre' => 'required|unique:alumnos',
                'curso' => 'required'
            ]);
            //Recuperar el alumno
            $a=Alumno::find($alumno);
            if($a==null){
                throw new Exception('No existe el alumno');
            }
            //Modifico datos
            $a->nombre = $request->nombre;
            $a->curso = $request->curso;
            if($a->save()){
                return $a;
            }
            else{
               throw new Exception('No se puede modificar el alumno'); 
            }
        } catch (\Throwable $th) {
            return response(['message'=>$th->getMessage()],500);
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($alumno)
    {
            //Recuperar el alumno
            $a=Alumno::find($alumno);
            if($a==null){
                throw new Exception('No existe el alumno');
            }
            if($a->delete()){
                return true;
            }
            else{
               throw new Exception('No se puede borrar el alumno'); 
            }
    }
}
