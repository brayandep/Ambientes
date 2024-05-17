<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ReservaConfirmada;
use App\Notifications\ReservaRechazada;

class CorreoController extends Controller
{
    public function enviarCorreoConfirmacion($correoDestino, $nombreUsuario, $horario, $nombreAmbiente, $fechaSolicitud)
    {
        Notification::route('mail', $correoDestino)->notify(new ReservaConfirmada($nombreUsuario, $horario, $nombreAmbiente, $fechaSolicitud));

        return redirect()->back()->with('success', 'Correo de confirmación enviado correctamente.');
    }

    public function enviarCorreoRechazo($correoDestino, $nombreUsuario, $horario, $nombreAmbiente, $fechaSolicitud)
    {
        Notification::route('mail', $correoDestino)->notify(new ReservaRechazada($nombreUsuario, $horario, $nombreAmbiente, $fechaSolicitud));

        return redirect()->back()->with('success', 'Correo de rechazo enviado correctamente.');
    }
}
