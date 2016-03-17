<?php

namespace BuildGrid\Http\Controllers;

use BuildGrid\Bom;
use BuildGrid\Http\Requests;
use BuildGrid\Http\Requests\CreateNewProjectRequest;
use BuildGrid\InvitedSupplier;
use BuildGrid\Project;


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
        $projects = Project::where('user_id', \Auth::id())->with('boms')->get();

        return view('home', ['projects' => $projects]);
    }


    public function create()
    {
        return view('create_project');
    }


    public function store(CreateNewProjectRequest $request)
    {

        $project = new Project();
        $project->user_id = \Auth::id();
        $project->name = $request->get('project_name');
        $project->save();

        $bom = new Bom();
        $bom->name= $request->get('bom_name');
        $bom->project_id =  $project->id;
        $bom->filename = $request->get('filename');
        $bom->save();

        foreach($request->get('supplier') as $supplier){
            $bom_supplier = new InvitedSupplier();
            $bom_supplier->name = $supplier['name'];
            $bom_supplier->email = $supplier['email'];
            $bom_supplier->bom_id = $bom->id;
            $bom_supplier->save();
        }

        return response(['bom_id' => $bom->id, '_token' => csrf_token() ], 200);
    }

    public function showBom()
    {
        return view('boms.show');
    }
}
