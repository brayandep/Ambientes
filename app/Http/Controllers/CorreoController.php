<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ReservaConfirmada;
use App\Notifications\ReservaRechazada;
use App\Notifications\WelcomeNotification; // Importar la notificación de bienvenida

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

    // Nuevo método para enviar la notificación de bienvenida
    public function enviarCorreoBienvenida($correoDestino, $nombreUsuario, $email, $password)
    {
        Notification::route('mail', $correoDestino)->notify(new WelcomeNotification($nombreUsuario, $email, $password));

        return redirect()->back()->with('success', 'Correo de bienvenida enviado correctamente.');
    }
}
