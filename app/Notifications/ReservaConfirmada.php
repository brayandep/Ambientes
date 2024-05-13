<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ReservaConfirmada extends Notification
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
                    ->from('smartbyte626@gmail.com', 'Sistema de reservas UMSS')
                    ->subject('Reserva Confirmada')
                    ->line('Su reserva de ambiente ha sido aceptada exitosamente')
                    ->line('El horario solicitado es: ' . $this->horario)
                    ->action('Ver Detalles', url('/Versolicitudes'))
                    ->line('Gracias por usar nuestra aplicación!')
                    ->salutation('Saludos');
    }
}
