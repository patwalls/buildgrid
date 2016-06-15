<?php

namespace BuildGrid\Http\Controllers;

use BuildGrid\BomResponse;
use Illuminate\Http\Request;

use BuildGrid\Http\Requests;

class BomResponseController extends Controller
{
    public function responseAccepted(Request $request)
    {
        $id = $request->id;
        $bom_response = BomResponse::findOrFail($id);
        $bom_response->status = 'accepted';
        $bom_response->save();

        return response('OK', 200);
    }

    public function responseRejected(Request $request)
    {
        $id = $request->id;
        $bom_response = BomResponse::findOrFail($id);
        $bom_response->status = 'rejected';
        $bom_response->save();

        return response('OK', 200);
    }

    public function responsePending(Request $request)
    {
        $id = $request->id;
        $bom_response = BomResponse::findOrFail($id);
        $bom_response->status = 'pending';
        $bom_response->save();

        return response('OK', 200);
    }
}
