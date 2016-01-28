<?php

namespace BuildGrid\Http\Controllers;

use BuildGrid\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
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

    public function fileUpload(Request $request)
    {
        $filename = $request->file('file')->getClientOriginalName();
        $file = $request->file('file');

        Storage::disk('dropbox')->put($filename, file_get_contents($file));
    }
}
