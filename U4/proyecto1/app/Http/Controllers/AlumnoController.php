<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Alumno;
use Exception;

class AlumnoController extends Controller
{
    //Método para obtener alumnos
    public function obtenerAlumnos()
    {
        //REcuperar alumnos de la BD
        $alumnos = Alumno::all();
        //Cargar la vista con alumnos
        return view('vistaAlumnos', compact('alumnos'));
    }

    // Ver/Editar alumno
    public function verAlumno($id)
    {
        //Recuprar los datos del alumno cuyo id se pasa en la ruta
        $alumno = Alumno::find($id);
        //Cargar vista para modificar el almno
        return view('modificarAlumno', compact('alumno'));
    }
    // Insertar alumno
    public function insertarAlumno(Request $request)
    {
        //Validar que se ha rellenado el nombre y el curso

        $request->validate([
            'nombre' => 'required',
            'curso' => 'required'
        ]);
        try {
            //Creamos un objeto de la clase (modelo) Alumno
            $a = new Alumno();
            //Rellenamos atributos de clase Alumno, que son lo campos de la tabla en la BD
            //con lo datos del formulario que vienen en $request
            $a->nombre = $request->nombre;
            $a->curso = $request->curso;
            //Insertar alumno con datos d $a
            if (!$a->save()) {
                throw new Exception('Error al crear el alumno');
            } else {
                return back()->with('mensaje', 'Alumno creado con id:' . $a->id);
            }
        } catch (\Throwable $th) {
            return back()->with('mensaje', $th->getMessage());
        }
    }
    // midificar alumno
    public function modificarAlumno(Request $r, $id)
    {
        //Validar si los datos están rellenos
        $r->validate([
            'nombre' => 'required',
            'curso' => 'required'
        ]);

        try {
            //Obtener el alumnos de la bd
            $a = Alumno::find($id);
            if ($a == null) {
                throw new Exception('El alumno no existe');
            }
            //Modificar el nombre/curso
            $a->nombre = $r->nombre;
            $a->curso = $r->curso;

            //Guardar el alumno con los datos cambiados
            if ($a->save()) { //Update
                return redirect()->route('alumnos');
            } else {
                throw new Exception('Error al modificar el alumno');
            }
        } catch (\Throwable $th) {
            return back()->with('mensaje', $th->getMessage());
        }
    }
    // borrar alumno
    public function borrarAlumno(Request $r)
    {
        try {
            //Comprobar que el alumno existe
            $a = Alumno::find($r->borrarAlumno);
            if ($a == null) {
                throw new Exception('El alumno no existe');
            }
            if ($a->delete()) { //delete
                return back()->with('mensaje', 'Alumno borrado');
            } else {
                throw new Exception('Error al borrar el alumno');
            }
        } catch (\Throwable $th) {
            return back()->with('mensaje', $th->getMessage());
        }
    }
}
