<?php

namespace App\Components\Notifications\Models;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AccountNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    protected $notify_ar;
    protected $notify_en;
//    protected $url;
//    protected $id;

    public function __construct( $notify_ar , $notify_en , $url = 'notifications', $urlid = '')
    {
        $this->notify_ar = $notify_ar ;
        $this->notify_en = $notify_en ;
        $this->url = $url ;
        $this->urlid = $urlid ;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
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
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return api_notify( $this->notify_ar  ,
            $this->notify_en  ,
            $this->url. '/'.$this->urlid
        ) ;

    }
}
