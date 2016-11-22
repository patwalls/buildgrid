<?php
/**
 * Created by PhpStorm.
 * User: gerardo
 * Date: 5/10/16
 * Time: 05:22 PM
 */

namespace BuildGrid\Listeners;


use BuildGrid\Events\SupplierRespondedBom;
use BuildGrid\Mailers\SupplierRespondedBomMailer;

class EmailSupplierResponseBom
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
     * @param SupplierRespondedBom $event
     */
    public function handle(SupplierRespondedBom $event)
    {
       SupplierRespondedBomMailer::sendSupplierResponseBomMail($event->bomResponse);
       SupplierRespondedBomMailer::sendConfirmationToSupplier($event->bomResponse);
    }
}
