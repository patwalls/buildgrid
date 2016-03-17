<?php

namespace BuildGrid\Http\Controllers;

use BuildGrid\Bom;
use Illuminate\Http\Request;
use BuildGrid\Http\Requests;
use Illuminate\Support\Facades\Storage;

class BomController extends Controller
{
    public function bomFileUpload(Request $request)
    {
        $bom = Bom::findOrFail($request->bom_id);

        if($bom->project->user_id !== 1234 ){
            return response('Unauthorized', 403);
        }

        $file = $request->file('file');
        $file_storage_path = \Auth::id() . '/' . $bom->project->id . ' - ' . $bom->project->name . '/' . $bom->filename;

        Storage::disk('dropbox')->put($file_storage_path, file_get_contents($file));

        return response('OK');

    }
}
