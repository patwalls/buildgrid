<?php

namespace BuildGrid\Http\Controllers;

use BuildGrid\Bom;
use BuildGrid\InvitedSupplier;
use BuildGrid\Repositories\BomRepository;
use Illuminate\Http\Request;
use BuildGrid\Http\Requests;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;

class BomController extends Controller {


    /**
     * BomController constructor.
     * @param BomRepository $bomRepository
     */
    public function __construct(BomRepository $bomRepository)
    {
        $this->bomRepository = $bomRepository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function bomFileUpload(Request $request)
    {
        $bom = Bom::findOrFail($request->bom_id);

        if($bom->project->user_id !== \Auth::id() ){
            return response('Unauthorized', 403);
        }

        $file = $request->file('file');

        if( $this->bomRepository->storeBomFile($bom, $file) == true){
            return response('OK');
        }

        return response('We could not store the document', 500);

    }


    public function bomResponseUpload(Request $request)
    {
        dd( $request->all() );
    }



    /**
     * @param $hashid
     * @return mixed
     */
    public function displayBomForSupplier($hashid)
    {

        $supplier = InvitedSupplier::where('hashid', $hashid)->first();

        if(! $supplier){
            return response('Not Found', 404);
        }

        return View::make('supplier.bom_supplier_view', compact(['supplier']));

    }



    /**
     * @param $bom_id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function fileDownload($hashid)
    {
        $invited_supplier = InvitedSupplier::where('hashid', $hashid)->first();

        if (! $invited_supplier ) {
            return response('Not Found', 404);
        }

        $bom = Bom::findOrFail($invited_supplier->bom_id);

        $file = $this->bomRepository->retrieveBomFile($bom);

        if (! $file ) {
            return response('Not Found', 404);
        }

        $headers = [
            'Content-Type' => $file['mimeType'],
            'Content-Disposition' => 'attachment; filename="' . $bom->filename .'"'
        ];

        return response($file['contents'], 200, $headers);
    }

}
