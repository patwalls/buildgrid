<?php

namespace BuildGrid\Listeners;

use BuildGrid\Events\NewBom;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailNewBom
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
     * @param  NewBom  $event
     * @return void
     */
    public function handle(NewBom $event)
    {
        sendNewBomMail::sendNewBomMail($event);
    }
}
