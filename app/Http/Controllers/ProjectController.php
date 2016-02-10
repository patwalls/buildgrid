<?php

namespace BuildGrid\Http\Controllers;

use BuildGrid\Bom;
use BuildGrid\Http\Requests;
use BuildGrid\InvitedSupplier;
use BuildGrid\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }


    public function create()
    {
        return view('home');
    }


    public function saveNewProject(Request $request)
    {

        $project = new Project();
        $project->name = $request->project_name;
        $project->user_id = Auth::id();

        if( $project->save() ){

            $bom = new Bom();
            $bom->project_id = $project->id;
            $bom->name = $request->bom_name;
            $bom->filename = $filename = $request->file('file')->getClientOriginalName();

            if ( $bom->save() ){
                $file = $request->file('file');
                Storage::disk('dropbox')->put($filename, file_get_contents($file));

                for($i = 1; $i <= sizeof($request->name); $i++ ){

                    $supplier         = new InvitedSupplier();
                    $supplier->bom_id = $bom->id;
                    $supplier->name   = $request->name[$i];
                    $supplier->email  = $request->email[$i];

                    if( ! $supplier->save() ){

                        return response($supplier->errors()->all(), 400);

                    }

                    return response('OK', 200);

                }

            }

            return response($bom->errors()->all(), 400);

        }

        return response($project->errors()->all(), 400);

    }
}
