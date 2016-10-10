<?php

namespace BuildGrid\Listeners;

use BuildGrid\Events\ContactRequestEvent;
use BuildGrid\Mailers\ContactRequestMailer;


class ContactRequestListener
{
    /**
     * Create the event listener.
     *
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ContactRequest  $event
     */
    public function handle(ContactRequestEvent $event)
    {
        ContactRequestMailer::sendMailToInfo($event->data);
    }
}
