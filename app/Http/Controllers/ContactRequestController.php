<?php

namespace BuildGrid\Http\Controllers;

use BuildGrid\Events\ContactRequestEvent;
use Illuminate\Http\Request;


class ContactRequestController extends Controller
{
    public function addContactRequest(Request $request)
    {

      $input = $request->only(['name', 'email', 'message_body']);

      \Event::fire(new ContactRequestEvent($input));

      return response()->json(['response' => 'Thank You for submitting your request.  We will contact you shortly']);
      
    }
}
