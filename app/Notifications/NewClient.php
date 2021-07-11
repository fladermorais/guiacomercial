<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\SlackMessage;

class NewClient extends Notification
{
    use Queueable;
    
    private $message;
    /**
    * Create a new notification instance.
    *
    * @return void
    */
    public function __construct($message)
    {
        $this->message = $message;
    }
    
    /**
    * Get the notification's delivery channels.
    *
    * @param  mixed  $notifiable
    * @return array
    */
    public function via($notifiable)
    {
        return ['slack'];
    }
   
    
   /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toSlack($notifiable)
    {  
        return (new SlackMessage)
            ->content($this->message . " \n Nome do Cliente: " . $notifiable->name . " \n" .
        "E-mail cadastrado: ". $notifiable->email . "\n ");
    }
}
