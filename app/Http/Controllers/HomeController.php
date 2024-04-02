<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Models\Usuario;
class HomeController extends Controller
{
    //
    public function index()
    {
        $usuarios = Usuario::all();;
        return view('inicio');
    }
}
