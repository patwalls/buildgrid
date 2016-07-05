<?php

namespace BuildGrid\Listeners;

use BuildGrid\Events\NewProjectCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailNewProjectCreated
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
     * @param  NewProjectCreated  $event
     * @return void
     */
    public function handle(NewProjectCreated $event)
    {
        UserMailer::sendRegistrationMail($event);
    }
}
