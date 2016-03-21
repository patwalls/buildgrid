<?php

namespace BuildGrid\Http\Controllers;

use BuildGrid\Bom;
use BuildGrid\Http\Requests;
use BuildGrid\Http\Requests\CreateNewProjectRequest;
use BuildGrid\Project;
use BuildGrid\Repositories\InvitedSupplierRepository;


class ProjectController extends Controller
{

    /**
     * ProjectController constructor.
     * @param InvitedSupplierRepository $supplierRepository
     */
    public function __construct(InvitedSupplierRepository $supplierRepository)
    {
        $this->middleware('auth');
        $this->supplierRepository = $supplierRepository;
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

        // Save the suppliers associated with this newly created Project/Bom
        $this->supplierRepository->store($request->get('supplier'), $bom->id);

        return response(['bom_id' => $bom->id, '_token' => csrf_token() ], 200);
    }

    public function showBom()
    {
        return view('boms.show');
    }
}
