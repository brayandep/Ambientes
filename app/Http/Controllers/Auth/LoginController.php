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
            return redirect()->intended('/');
        }

        return redirect()->back()->withErrors([
            'email' => 'Las credenciales proporcionadas no son válidas.',
        ]);
    }
    public function register(Request $request){
      // Validar los datos
      $request->validate([
        'nombre' => '',
        'email' => 'required|string|email|max:255|unique:users',
        'telefono' => '', // Eliminamos la regla required
        'password' => 'min:8', // Eliminamos la regla required
        'direccion' => '', // Eliminamos la regla required
        'rol' => '', // Eliminamos la regla required
        'ci' => '', // Eliminamos la regla required
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
       
        return redirect(route('inicio'));
    }
    public function logout(Request $request){
        // Validar los datos
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
          return redirect(route('sesion.index'));
      }



      //editar
      public function edit()
      {
          // Obtener el usuario autenticado
          $user = Auth::user();
          
          // Mostrar el formulario de edición con los datos del usuario
          return view('usuario.modificar', compact('user'));
      }
  
      public function update(Request $request)
      {
          // Validar los datos
          $request->validate([
              'nombre' => 'required|string|max:255',
              'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
              'telefono' => 'required',
              'direccion' => 'required',
              'rol' => 'required',
              'ci' => 'required',
          ]);
      
          // Obtener el usuario autenticado
          $user = Auth::user();
      
          // Actualizar los datos del usuario
          $user->nombre = $request->nombre;
          $user->email = $request->email;
          $user->ci = $request->ci;
          $user->rol = $request->rol;
          $user->telefono = $request->telefono;
          $user->direccion = $request->direccion;
          if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
         $user->save();
          // Guardar los cambios
      
          // Redirigir al usuario a una página después de la actualización
          return redirect()->route('user.edit')->with('success', 'Datos actualizados correctamente');
      }
      
}