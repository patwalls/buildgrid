<?php

namespace BuildGrid\Http\Controllers;

use BuildGrid\Bom;
use BuildGrid\BomResponse;
use BuildGrid\Events\ResponseAccepted;
use Event;
use Illuminate\Http\Request;

use BuildGrid\Http\Requests;

class BomResponseController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function responseAccepted(Request $request)
    {
        $status = 'accepted';
        $id = $request->id;
        $bom_response = BomResponse::findOrFail($id);
        $bom_response->status = $status;
        $bom_response->save();

        $bom = $bom_response->bom;
        $bom->status = $status;
        $bom->update();

        Event::fire(new ResponseAccepted($bom_response));

        return response('OK', 200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function responseRejected(Request $request)
    {
        $id = $request->id;
        $bom_response = BomResponse::findOrFail($id);
        $bom_response->status = 'rejected';
        $bom_response->save();

        return response('OK', 200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function responsePending(Request $request)
    {
        $id = $request->id;
        $bom_response = BomResponse::findOrFail($id);
        $previous_status = $bom_response->status;
        $bom_response->status = 'pending';
        $bom_response->save();

        if($previous_status == 'accepted')
        {
            $bom = $bom_response->bom;
            $bom->status = 'active';
            $bom->update();

        }

        return response('OK', 200);
    }
}
