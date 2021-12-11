<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;

class VoteCreatedNotification extends Notification
{
    use Queueable;
    protected $auth_user;
    protected $question_id;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($question_id)
    {
        $auth_user = Auth::user();
        $this->auth_user = $auth_user;
        $this->question_id = $question_id;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['broadcast' , 'database'];
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

    public function toDatabase($notifiable)
    {
        return [
            'body' => $this->auth_user->name . ' Add answer in you question',
            'url' => route('questions.show', $this->question_id),
        ];
    }
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage(
            [
                'body' => $this->auth_user->name . ' Add answer in you question',
                // 'url' => url(route('question.show', [$this->question_id]))
            ]
        );
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
