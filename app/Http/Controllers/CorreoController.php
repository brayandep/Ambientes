<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification; // Importamos la clase Notification
use App\Notifications\ReservaConfirmada; // Importamos la notificación que quieres enviar
use App\Notifications\ReservaRechazada; // Importamos la notificación que quieres enviar

class CorreoController extends Controller
{
    public function enviarCorreo($correoDestino, $horario)
    {
        Notification::route('mail', $correoDestino)->notify(new ReservaConfirmada($horario));

        return redirect()->back()->with('success', 'Correo electrónico enviado correctamente.');
    }
}
