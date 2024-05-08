<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RolController extends Controller
{
    public function index(){
        return view ('RegistroRol.Registrar_roles_nuevos');
    }


}
