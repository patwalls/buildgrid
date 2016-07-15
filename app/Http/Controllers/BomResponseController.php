<?php

namespace BuildGrid\Http\Controllers;

use BuildGrid\Repositories\BomResponseRepository;
use BuildGrid\BomResponse;
use BuildGrid\Events\ResponseAccepted;
use Event;
use Illuminate\Http\Request;

use BuildGrid\Http\Requests;

class BomResponseController extends Controller
{
    public $bomResponseRepository;

    /**
     * BomResponseController constructor.
     * @param BomResponseRepository $bomResponseRepository
     */
    public function __construct(BomResponseRepository $bomResponseRepository)
    {
        $this->bomResponseRepository = $bomResponseRepository;
    }

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

    /**
     * @param BomResponse $bomResponse
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     */
    public function getBomResponsePreview(Request $request)
    {
        $bom_response_id = $request->id;
        $bom_response = BomResponse::findOrFail($bom_response_id);
        $file = $this->bomResponseRepository->retrieveBomResponsePreview($bom_response);

        if (! $file ) {
            $file = \Image::make( public_path() . '/images/file_preview.png' );

            $response = \Response::make($file->encode('png'));
            $response->header('Content-Type', 'image/png');

            return $response;
        }

        return response($file, 200, [ 'Content-Type' => 'image/png' ]);
    }
}
