<?php

namespace App\Http\Controllers;

use App\Models\User;
use Database\Seeders\RolSeeder;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class usuariocontroller extends Controller
{
    public function index()
    {
       
        return view('usuario.registro');
    }
    public function index2()
    {
       
        return view('usuario.inicio');
    }

    public function show()
    {
        $usuarios = User::orderBy('id', 'desc')->paginate();

        return view('usuario.lista', compact('usuarios'));
    }

    public function edit(User $usuario)
    {
        $roles = Role::all();
        $userRoles = $usuario->roles->pluck('id')->toArray();
        return view('usuario.roles', compact('usuario', 'roles', 'userRoles'));
    }
    public function update(Request $request, User $usuario)
    {
        $usuario -> syncRoles($request->roles);
        //print_r($usuario);
        return redirect()->route('Usuario.show');
    }
    // $usuario->syncRoles($request->input('roles'));
}
