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
    
    public function index()
    {
        return view('Login');
    }
    public function login(Request $request)
    {
        // Buscar al usuario por su nombre
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // Autenticación exitosa
            $request->session()->regenerate();
            return redirect()->intended(route('inicio'));
        } else {
            // Autenticación fallida
            return back()->withErrors([
                'nombre' => 'Las credenciales proporcionadas no son válidas.',
            ]);
        }
    }
    public function register(Request $request){
      // Validar los datos
        $user = new User();

        $user->nombre = $request->nombre;
        $user->email = $request->email;
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