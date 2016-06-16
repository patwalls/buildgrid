<?php

namespace BuildGrid\Http\Controllers;

use BuildGrid\Bom;
use BuildGrid\BomResponse;
use BuildGrid\Project;
use BuildGrid\InvitedSupplier;
use BuildGrid\Repositories\BomRepository;
use BuildGrid\Repositories\BomResponseRepository;
use BuildGrid\Repositories\InvitedSupplierRepository;
use Illuminate\Http\Request;
use BuildGrid\Http\Requests;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use BuildGrid\Http\Requests\AddAdditionalSuppliersRequest;

class BomController extends Controller {


    /**
     * BomController constructor.
     * @param BomRepository $bomRepository
     */
    public function __construct(BomRepository $bomRepository, BomResponseRepository $bomResponseRepository, InvitedSupplierRepository $invitedSupplierRepository)
    {
        $this->bomRepository = $bomRepository;
        $this->bomResponseRepository = $bomResponseRepository;
        $this->invitedSupplierRepository = $invitedSupplierRepository;
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
        $supplier = InvitedSupplier::where('hashid', $request->get('hashid'))->first();
        $supplier->status = 'responded';
        $supplier->update();
        $bom = Bom::find($supplier->bom_id);

        $file = $request->file('file');

        $bom_response = BomResponse::create([
            'bom_id'              => $bom->id,
            'invited_supplier_id' => $supplier->id,
            'filename'            => $file->getClientOriginalName(),
            'comment'             => $request->get('comment')
        ]);

        if($bom_response && $this->bomResponseRepository->storeBomResponseFile($bom_response, $file)){
            return response('OK', 200);
        }

        return response('Error', 500);
    }


    public function addNewSupplierToBom(AddAdditionalSuppliersRequest $request)
    {

        $bom_id = $request->get('bom_id');
    
        $this->invitedSupplierRepository->store($request->get('supplier'), $bom_id);

        return redirect()->route('getShowBom', $bom_id);

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

        if($supplier->status == 'notViewed'){
            $supplier->status = 'viewed';
            $supplier->update();
        }

        return View::make('supplier.bom_supplier_view', compact(['supplier']));

    }



    /**
     * @param $bom_id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    private function bomFileDownload($bom_id, $attach)
    {

        $bom = Bom::findOrFail($bom_id);

        $file = $this->bomRepository->retrieveBomFile($bom);

        if (! $file ) {
            return response('Not Found', 404);
        }

        $headers = [ 'Content-Type' => $file['mimeType'] ];

        if ($attach != 'attach'){
            return response($file['contents'], 200, $headers);
        }

        $headers['Content-Disposition'] = 'attachment; filename="' . $bom->filename .'"';

        return response($file['contents'], 200, $headers);

    }


    public function bomDownload($bom_id, $attach = 'attach')
    {
        $bom = Bom::findOrFail($bom_id);

        if (! \Auth::id() == $bom->project->user_id || ! \Auth::user()->is_admin){
            return response('Not Found', 404);
        }

        return $this->bomFileDownload($bom->id, $attach);
    }


    public function supplierBomDownload($hashid, $attach = 'attach')
    {
        $invited_supplier = InvitedSupplier::where('hashid', $hashid)->first();

        if (! $invited_supplier ) {
            return response('Not Found', 404);
        }

        return $this->bomFileDownload($invited_supplier->bom_id, $attach);

    }


    public function bomResponseDownload($response_id)
    {
        $response = BomResponse::findOrFail($response_id);

        $file = $this->bomResponseRepository->retrieveBomResponseFile($response);

        if (! $file ) {
            return response('Not Found', 404);
        }

        $headers = [
            'Content-Type' => $file['mimeType'],
            'Content-Disposition' => 'attachment; filename="' . $response->filename .'"'
        ];

        return response($file['contents'], 200, $headers);
    }

    public function archiveBom(Request $request)
    {
        $id = $request->id;

        $bom = Bom::findOrFail($id);
        $bom->status = 'archived';
        $bom->save();

        return response('OK', 200);
    }
}
