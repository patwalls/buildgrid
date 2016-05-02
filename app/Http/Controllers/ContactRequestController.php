<?php

namespace BuildGrid\Http\Controllers;

use Illuminate\Http\Request;
use BuildGrid\Http\Requests;
use BuildGrid\ContactRequest;
use BuildGrid\Http\Controllers\Controller;

class ContactRequestController extends Controller
{
    public function addContactRequest(Request $request)
    {

      $this->validate($request, [
          'name' => 'required',
          'email' => 'required|email',
      ]);

      $project = ContactRequest::create([
        'name' => $request->get('name'), 
        'email' => $request->get('email'), 
        'message' => $request->get('message')
      ]); 

      return redirect('/');
 
      // return response()->json(['response' => 'Thank You for submitting your request.  We will contact you shortly']);
      
    }
}
