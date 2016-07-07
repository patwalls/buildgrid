<?php

namespace BuildGrid\Listeners;

use BuildGrid\Events\ResponseAccepted;
use BuildGrid\Mailers\BomResponseMailer;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailResponseAccepted
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
     * @param  ResponseAccepted  $event
     * @return void
     */
    public function handle(ResponseAccepted $event)
    {
        BomResponseMailer::sendBomResponseAcceptedMail($event->bomResponse);
    }
}
