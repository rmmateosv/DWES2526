<?php

namespace App\Http\Controllers;

        use App\Models\User;
        use Illuminate\Http\Request;
        use Illuminate\Support\Facades\Auth;
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
        //Comporbar credenciales y en caso correcto
        //redirigir a inicio
        $r->validate([
            'email'=>'required|email:rfc,dns', //No se puede repetir
            'ps' =>'required'
        ]);
        try {
            if(Auth::attempt(['email'=>$r->email, 'password'=>$r->ps],true)){
                $r->session()->regenerate();
                return redirect(route('inicio'));
            }
            else{
                return back()->with('mensaje','Datos incorrectos');
            }
        } catch (\Throwable $th) {
            return back()->with('mensaje', 'Error:' . $th->getMessage());
        }
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
            if($us->save()){
                //Loguear directamente
                Auth::login($us);
                //Rediregimos a la ruta de inicio
                return redirect(route('inicio'));

            }
        } catch (\Throwable $th) {
            return back()->with('mensaje', 'Error:' . $th->getMessage());
        }
    }
    public function cerrarSesion(){
        Auth::logout();
        return redirect(route('login'));
    }
}
