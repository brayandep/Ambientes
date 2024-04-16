<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalendarioController extends Controller
{
    public function index()
    {
        return view('Calendario.general');
    }

    public function individual()
    {
        return view('Calendario.individual');
    }
}
