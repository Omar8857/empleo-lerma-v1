<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewVacancy extends Notification
{
    use Queueable;
    protected $vacancy;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($vacancy)
    {
        $this->vacancy = $vacancy;
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
            ->from('contacto@lerma.gob.mx', 'Empleo Lerma')
            ->subject('Una nueva vacante se ha registrado!!')
            ->greeting('Hola Administrador')
            ->line('La vacante ' . $this->vacancy->titulo_puesto . ' se ha registrado en la aplicación Empleo Lerma.')
            ->line('Para revisar los datos accede a la aplicación, da clic en el siguiente enlace.')
            ->action('Ver vacante', url(route('vacante', ['slug' => $this->vacancy->slug])))
            ->line('Gracias por usar la aplicación!')
            ->salutation('¡Saludos!');
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
