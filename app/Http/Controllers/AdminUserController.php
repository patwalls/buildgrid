<?php

namespace BuildGrid\Http\Controllers;

use BuildGrid\User;
use Illuminate\Http\Request;

use BuildGrid\Http\Requests;
use BuildGrid\Http\Controllers\Controller;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if( $request->ajax() )
        {
            return \Datatables::of(User::all())->make(true);
        }

        return \View::make('admin.users.index');
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
     * @param  \BuildGrid\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, Request $request)
    {
        if( $request->ajax() ) {
            return \Datatables::collection($user->boms()->get())->make(true);
        }

        return \View::make('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user, Request $request)
    {
        $user->status = 'active';

            $user->projects()->status = 'active';
            $user->boms()->status = 'active';

        $user->update();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  BuildGrid\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BuildGrid\User $user)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, Request $request)
    {
        $user->status = 'inactive';
        $user->projects()->status = 'inactive';
        $user->boms()->status = 'archived';

        $user->update();
    }
}
