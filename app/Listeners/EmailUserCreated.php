<?php

namespace BuildGrid\Listeners;

use BuildGrid\Events\UserWasCreated;
use BuildGrid\Mailers\UserMailer;
use BuildGrid\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailUserCreated
{
    /**
     * Create the event listener.
     *
     */
    public function __construct()
    {
        
    }

    /**
     * Handle the event.
     *
     * @param  UserWasCreated  $event
     * @return void
     */
    public function handle(UserWasCreated $event)
    {
        UserMailer::sendRegistrationMail($event->user);
    }
}
