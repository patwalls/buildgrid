<?php

namespace BuildGrid\Http\Controllers;

use BuildGrid\Bom;
use Illuminate\Http\Request;

use BuildGrid\Http\Requests;
use BuildGrid\Http\Controllers\Controller;

class AdminBomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if( $request->ajax() )
        {
            return \Datatables::of(Bom::all())->make(true);
        }

        return \View::make('admin.boms.index');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Bom $bom)
    {
        $invited_suppliers = $bom->invitedSuppliers;
        $responses = $bom->responses;

        $user = $bom->project->user;

        return view('admin.boms.show', compact(['bom', 'invited_suppliers', 'responses', 'user']));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bom $bom)
    {
        $bom->status = "archived";
        $bom->update();
    }
}
