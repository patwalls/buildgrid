<?php

namespace BuildGrid\Listeners;

use BuildGrid\Events\NewBom;
use BuildGrid\Mailers\BomMailer;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailNewBom
{
    /**
     * Create the event listener.
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
        BomMailer::sendNewBomMail($event->bom);
    }
}
