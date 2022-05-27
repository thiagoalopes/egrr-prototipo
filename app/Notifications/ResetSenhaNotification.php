<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetSenhaNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $senha;
    private $usuario;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($usuario, $senha)
    {
        $this->senha = $senha;
        $this->usuario = $usuario;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->greeting('Olá ' . $this->usuario->nome)
            ->subject(config('app.name').' - Redefinição de Senha')
            ->line('Você está recebendo esse e-mail com sua nova senha')
            ->line('Senha: ' . $this->senha);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
