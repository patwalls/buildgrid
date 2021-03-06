<?php

namespace BuildGrid\Http\Controllers;

use BuildGrid\Bom;
use BuildGrid\BomResponse;
use BuildGrid\Events\SupplierRespondedBom;
use BuildGrid\Project;
use BuildGrid\InvitedSupplier;
use BuildGrid\Repositories\BomRepository;
use BuildGrid\Repositories\BomResponseRepository;
use BuildGrid\Repositories\InvitedSupplierRepository;
use BuildGrid\User;
use Event;
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

        if( $request->has('hashid')){
            $supplier = InvitedSupplier::where('hashid', $request->get('hashid'))->first();
        }

        // If we don't find a supplier by its hashid but the request was made by an Admin,
        // create a new Invited Supplier for the Admin.

        if( ! \Auth::guest() && ! isset($supplier) && (\Auth::user() !== null && \Auth::user()->is_admin) ){

            $supplier = InvitedSupplier::where('hashid', \Hashids::encode([$request->get('bom_id'), \Auth::id()]))->first();

            if (! $supplier ){

                $supplier = InvitedSupplier::create([
                    'name'  => \Auth::user()->full_name,
                    'email' => \Auth::user()->email,
                    'bom_id' => $request->get('bom_id'),
                    'hashid' => \Hashids::encode([$request->get('bom_id'), \Auth::id()])
                ]);

            }
        }

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

        if(! ( $bom_response && $this->bomResponseRepository->storeBomResponseFile($bom_response, $file))){
            return response('Error', 500);
        }

        if( ! \Auth::guest() && ! isset($supplier) && (\Auth::user() !== null && \Auth::user()->is_admin) ){
            $bom->bg_responded = true;
            $bom->update();
        }
        Event::fire(new SupplierRespondedBom ($bom_response));

        return response('OK', 200);

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

        if(! $supplier || ! $supplier->bom){
            return response('Not  Found', 404);
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

        if (! \Auth::id() == $bom->project->user_id &&
            ! (\Auth::user() !== null && \Auth::user()->is_admin) &&
            ! \Route::current()->getName() == 'bomDownloadFilePreviews.io'){

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
        $bom->delete();

        return response('OK', 200);
    }


    /**
     * @param Bom $bom
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     */
    public function getBomPreview(Bom $bom)
    {
        $file = $this->bomRepository->retrievePreview($bom);

        if (! $file ) {
            $file = \Image::make( public_path() . '/images/file_preview.png' );

            $response = \Response::make($file->encode('png'));
            $response->header('Content-Type', 'image/png');

            return $response;
        }

        return response($file, 200, [ 'Content-Type' => 'image/png' ]);
    }
}
