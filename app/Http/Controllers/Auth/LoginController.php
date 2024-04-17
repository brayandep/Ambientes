<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    //
    
    public function index()
    {
        return view('Login');
    }
public function login(Request $request)
{
      // Buscar al usuario por su nombre
      $credentials = $request->only('nombre', 'contraseña');
      if (Auth::attempt($credentials)) {
        // Autenticación exitosa
        return redirect()->intended('/');
    } else {
        // Autenticación fallida
        return back()->withErrors([
            'nombre' => 'Las credenciales proporcionadas no son válidas.',
        ]);
    }
}
}