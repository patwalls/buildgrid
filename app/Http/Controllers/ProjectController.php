<?php

namespace BuildGrid\Http\Controllers;

use BuildGrid\Bom;
use BuildGrid\Events\NewProjectCreated;
use BuildGrid\Http\Requests;
use BuildGrid\User;
use Illuminate\Http\Request;
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
        //$projects = $user->projects;
        $user = User::findOrFail(\Auth::id());
        $projects = $user->projects;
        if ($projects->isEmpty())
        {
            return view('create_project', ['projects' => $projects]);
        }

        return view('home', ['projects' => $projects]);
    }


    public function create(Request $request, Project $project = null)
    {

        if( ( $project->trashed() || ! $project->exists ) && $request->route()->getName() == 'getAddBomToProject' ){
            return \Redirect::route('home');
        }


        return view('create_project', compact('project'));

    }


    /**
     * @param CreateNewProjectRequest $request
     * @param Project|null $project
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function store(CreateNewProjectRequest $request, Project $project = null)
    {

        if ( $project === null ) {

             $project = Project::create([
                'user_id' => \Auth::id(),
                'name'    => $request->get('project_name')
            ]);

            Event::fire(new NewProjectCreated($project));

        }


        $bom = Bom::create([
            'name'            => $request->get('bom_name'),
            'project_id'      => $project->id,
            'bom_description' => $request->get('bom_description'),
            'filename'        => $request->get('filename')
        ]);


        switch( $request->route()->getName() ){
            case 'postCreateproject':
                $toast_text = 'Your project was succesfully created';
                break;
            case 'postAddBomToProject':
                $toast_text = 'Your new BOM has been added to your project';
                break;
            default:
                $toast_text = 'Success!';
        }


        // Save the suppliers associated with this newly created Project/Bom
        $this->supplierRepository->store($request->get('supplier'), $bom->id);


        return response([
                            'bom_id' => $bom->id,
                            '_token' => csrf_token(),
                            'toast_text' => $toast_text
                        ], 200);

    }


    public function showBom($id)
    {
        $bom = Bom::findOrFail($id);

        $invited_suppliers = $bom->invitedSuppliers;
        $responses = $bom->responses->sortBy('created_at')->sortBy('status');

        $user = $bom->project->user;

        return view('boms.show', compact(['bom', 'invited_suppliers', 'responses', 'user']));
    }
}
