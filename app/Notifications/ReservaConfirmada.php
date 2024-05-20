<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ReservaConfirmada extends Notification
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
                    ->subject('Reserva Confirmada')
                    ->greeting('Hola ' . $this->nombreUsuario)
                    ->line('Tu reserva de ambiente para el día ' . $this->fechaSolicitud . ' ha sido aceptada exitosamente.')
                    ->line('El ambiente solicitado es: ' . $this->nombreAmbiente)
                    ->line('El horario solicitado es: ' . $this->horario)
                    ->action('Ver Detalles', url('/Versolicitudes'))
                    ->line('Gracias por usar nuestra aplicación!')
                    ->salutation('Saludos, Sistema de Reservas UMSS');
    }
}
