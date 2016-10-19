<?php

namespace BuildGrid\Http\Controllers;

use BuildGrid\Bom;
use BuildGrid\Events\NewBom;
use BuildGrid\Events\NewProjectCreated;
use BuildGrid\Http\Requests;
use BuildGrid\User;
use Event;
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
        if( \Auth::user()->is_admin ){
            return \Redirect::route('admin.dashboard');
        }

        $projects = \Auth::user()->projects;

        if( $projects->isEmpty() ){
            return \Redirect::route('getCreateProject');
        }

        return view('home', compact('projects'));

    }


    /**
     * @param Request $request
     * @param Project|null $project
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Request $request, Project $project = null)
    {
        //If it wants to create a BOM Project has an id. Else if wants to create a new Project, injects an empty dependency.
        if( !$project->getOriginal('id') ){
            //"Destroys" this dependency and passes an empty array
            $project = array();
        } elseif( ( $project->trashed() || ! $project->exists ) && $request->route()->getName() == 'getAddBomToProject' ){
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
        //If it wants to create a new Project
        if( !$project->getOriginal('id') ) {
            $project = Project::create([
                'user_id' => \Auth::id(),
                'name' => $request->get('project_name')
            ]);

        }
        $bom = Bom::create([
            'name'            => $request->get('bom_name'),
            'project_id'      => $project->id,
            'bom_description' => $request->get('bom_description'),
            'filename'        => $request->get('filename')
        ]);


        switch( $request->route()->getName() ){
            case 'postCreateProject':
                $toast_text = 'Your project was succesfully created';
                Event::fire(new NewProjectCreated($project));
                break;
            case 'postAddBomToProject':
                $toast_text = 'Your new BOM has been added to your project';
                Event::fire(new NewBom($bom));
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


    /**
     * @param $id
     * @return mixed
     */
    public function showBom($id)
    {
        $bom = Bom::withTrashed()->findOrFail($id);
        $user = $bom->project->user;

        if( \Auth::id() == $user->id || (\Auth::user() !== null && \Auth::user()->is_admin)){
            $invited_suppliers = $bom->invitedSuppliers;
            $responses = $bom->responses->sortBy('created_at')->sortBy('status');

            return view('boms.show', compact(['bom', 'invited_suppliers', 'responses', 'user']));
        }else{
            return redirect('home');
        }
    }
}
