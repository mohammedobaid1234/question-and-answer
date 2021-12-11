<?php

namespace App\Listeners;

use App\Events\VoteCreatedEvent;
use App\Models\Question;
use App\Models\User;
use App\Notifications\VoteCreatedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;

class SendNotifyListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($question_id)
    {
        $user_id = Question::findOrFail($question_id);
        // dd($user_id);
        $user_id = $user_id->user_id;
        $user = User::findOrFail($user_id);
        // dd($user);
        $user->notify( new VoteCreatedNotification($user, $question_id));
        
        

        
    }
}
