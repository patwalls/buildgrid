<?php

namespace BuildGrid\Http\Controllers;

use Auth;
use BuildGrid\Repositories\UserRepository;
use Illuminate\Http\Request;
use BuildGrid\User;

class UserController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @param UserRepository $userRepository
	 */
	public function __construct(UserRepository $userRepository)
	{
		$this->middleware('auth');
		$this->userRepository = $userRepository;
	}
	
	public function edit()
	{
		$user = User::findOrNew(Auth::id());
		
		return view('profile', ['user' => $user]);
	}
	
	public function update(Request $request)
	{
	    $this->validate($request, [
				'first_name' => 'required|min:2',
				'last_name' => 'required|min:4',
	    	'email' => 'required|email|min:10',
	    	'phone' => 'min:10'
	    ]);
	    
	    $user = User::findOrNew($request->id);
	    
	    if($user !== null){
	    	$user->fill($request->all());
	    	$user->save();
	    }

		return back()->with('message','Operation Successful !');
	}

  public function updatePassword(Request $request, $id)
    {
        $this->validate($request, [
          'password' => 'required|min:8',
          'confirm_password' => 'required|min:8'
        ]);

        $user = User::findOrFail($id);

        if ( strcmp ( $request->get('password') , $request->get('confirm_password') ) === 0) {
            $user->password = Hash::make($request->get('password'));
            $user->save();

						return view('profile', compact($user));            
            // return response()->json(['error' => false,
            // 		'message' =>  'The password was updated.' ]);            
        } else {          
          return response()->json(['error' => true,
          		'message' =>  "The passwords doesn't match." ]);
        }
    }

	/**
	 * @param Request $request
	 * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
	public function uploadProfilePicture(Request $request)
	{
		$user = User::findOrFail($request->id);

		if($user->id !== \Auth::id() ){
			return response('Unauthorized', 403);
		}

		$picture = $request->picture;
		$thumbnail = $request->thumbnail;


		if( $this->userRepository->storePictureProfile($user, $picture) && $this->userRepository->storeThumbnailProfile($user, $thumbnail)){
			return response('OK');
		}

		return response('We could not store the picture', 500);
	}
}	