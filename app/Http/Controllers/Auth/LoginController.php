<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    //
    
    
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            return redirect()->intended('/invitado');
        }

        return redirect()->back()->withErrors([
            'email' => 'Las credenciales proporcionadas no son válidas.',
        ]);
    }
    public function register(Request $request){
      // Validar los datos
      $request->validate([
        'nombre' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'telefono' => 'required',
        'password' => 'required|string|min:8', // Puedes agregar más reglas de validación según tus requisitos
        'direccion' => 'required',
        'rol' => 'required',
        'ci' => 'required',
    ]);  
      $user = new User();

        $user->nombre = $request->nombre;
        $user->email = $request->email;
        $user->ci = $request->ci;
        $user->rol = $request->rol;
        $user->telefono = $request->telefono;
        $user->direccion = $request->direccion;
        $user->password = Hash::make($request->password);
        $user->save();
        Auth::login($user);
        return redirect(route('inicio'));
    }
    public function logout(Request $request){
        // Validar los datos
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
          return redirect(route('sesion.index'));
      }
}