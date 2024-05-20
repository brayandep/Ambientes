<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ReservaRechazada extends Notification
{
    use Queueable;

    protected $nombreUsuario;
    protected $horario;
    protected $nombreAmbiente;
    protected $fechaSolicitud;

    public function __construct($nombreUsuario, $horario, $nombreAmbiente, $fechaSolicitud)
    {
        $this->nombreUsuario = $nombreUsuario;
        $this->horario = $horario;
        $this->nombreAmbiente = $nombreAmbiente;
        $this->fechaSolicitud = $fechaSolicitud;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->from('smartbyte626@gmail.com', 'Sistema de reservas UMSS')
                    ->subject('Reserva Rechazada')
                    ->greeting('Hola ' . $this->nombreUsuario)
                    ->line('Lamentamos informarte que tu reserva para el día ' . $this->fechaSolicitud . ' ha sido rechazada porque el ambiente ya no se encuentra disponible en el horario solicitado.')
                    ->line('El ambiente solicitado fue: ' . $this->nombreAmbiente)
                    ->line('El horario solicitado fue: ' . $this->horario)
                    ->line('Puedes volver a hacer una solicitud en el sistema ingresando al enlace:')
                    ->action('Nueva solicitud', url('/Solicitud'))
                    ->line('Gracias por usar nuestra aplicación!')
                    ->salutation('Saludos, Sistema de Reservas UMSS');
    }
}