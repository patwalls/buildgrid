<?php

namespace BuildGrid\Listeners;

use BuildGrid\Events\UserPasswordWasChanged;
use BuildGrid\Mailers\UserMailer;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailUserPasswordChanged
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
     * @param  UserPasswordWasChanged  $event
     * @return void
     */
    public function handle(UserPasswordWasChanged $event)
    {
        UserMailer::sendPasswordChangedMail($event->user);
    }
}
