<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController
{
    public function cargarLogin(){
        return view('login');
    }
    public function cargarRegistro(){
        return view('registro');
    }
    public function loguear(Request $r){

    }
    public function registrar(Request $r){
        //Validar campos del formulario
        $r->validate([
            'nombre'=>'required',
            'email'=>'required|unique:App\Models\User|email:rfc,dns', //No se puede repetir
            'ps1' =>'required',
            'ps2' =>'required|same:ps1'
        ]);
        try {
            //<code...
            $us=new User();
            $us->name=$r->nombre;
            $us->email=$r->email;
            $us->password = Hash::make($r->ps1);
        } catch (\Throwable $th) {
            return back()->with('mensaje', 'Error:' . $th->getMessage());
        }
    }
}
