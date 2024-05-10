<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
