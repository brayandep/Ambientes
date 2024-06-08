<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WelcomeNotification extends Notification
{
    use Queueable;

    protected $nombreUsuario;
    protected $email;
    protected $password;

    public function __construct($nombreUsuario, $email, $password)
    {
        $this->nombreUsuario = $nombreUsuario;
        $this->email = $email;
        $this->password = $password;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->from('smartbyte626@gmail.com', 'Sistema de reservas UMSS')
                    ->subject('Bienvenido')
                    ->greeting('Hola ' . $this->nombreUsuario)
                    ->line('Te has registrado exitosamente en el sistema de reservas de la UMSS.')
                    ->line('Tu usuario es: ' . $this->email)
                    ->line('Tu contraseña es: ' . $this->password)
                    ->line('Por seguridad se recomienda cambiar la contraseña recibida, puedes hacerlo en la opción de "Modificar usuario" usando el siguiente enlace:')
                    ->action('Ir al sistema de reservas', url('/inicio'))
                    ->line('Gracias por usar nuestra aplicación!')
                    ->salutation('Saludos, Sistema de Reservas UMSS');
    }
}
