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

    public function addBomToProject(){
        return 'foo';
    }


    public function create()
    {
        return view('create_project');
    }


    public function store(CreateNewProjectRequest $request)
    {
        // Add check for does project name + user ID already exist,
        //  if yes set $project->id if no project exists
        //  
        
        // $project = DB::table('projects')->where('id', '=', \Auth::id())
        //             ->where('name', $request->get('project_name'))
        //             ->get();

        // print_r($project);

        $project = Project::create([
            'user_id' => \Auth::id(),
            'name'    => $request->get('project_name')
        ]);

        $bom = Bom::create([
            'name'            => $request->get('bom_name'),
            'project_id'      => $project->id,
            'bom_description' => $request->get('bom_description'),
            'filename'        => $request->get('filename')
        ]);

        // Save the suppliers associated with this newly created Project/Bom
        $this->supplierRepository->store($request->get('supplier'), $bom->id);

        return response(['bom_id' => $bom->id, '_token' => csrf_token() ], 200);
    }

    public function showBom($id)
    {
        $bom = Bom::findOrFail($id);

        $invited_suppliers = $bom->invitedSuppliers;
        $responses = $bom->responses;

        $user = $bom->project->user;

        return view('boms.show', compact(['bom', 'invited_suppliers', 'responses', 'user']));
    }
}
