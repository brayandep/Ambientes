<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ReservaRechazada extends Notification
{
    use Queueable;

    protected $horario;

    public function __construct($horario)
    {
        $this->horario = $horario;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('Su reserva de ambiente ha sido rechazada porque el ambiente ya no se encuentra disponible en el horario solicitado')
                    ->line('El horario solicitado fue: ' . $this->horario)
                    ->line('Puede volver a hacer una solicitud en el sistema o ingresando al enlace:')
                    ->action('Ver Detalles', url('/Solicitud'))
                    ->line('Gracias por usar nuestra aplicación!');
    }
}
