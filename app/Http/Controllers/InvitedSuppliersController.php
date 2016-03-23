<?php

namespace BuildGrid\Http\Controllers;

use Illuminate\Http\Request;

use BuildGrid\Http\Requests;
use BuildGrid\Http\Controllers\Controller;
use BuildGrid\Mailers\InvitedSupplierMailer;

class InvitedSuppliersController extends Controller
{
    public function sendReminderEmail($invited_supplier_id)
    {
      InvitedSupplierMailer::sendBomInvitationToSupplier($invited_supplier_id);
    }
}
