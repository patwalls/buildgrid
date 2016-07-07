<?php

namespace BuildGrid\Http\Controllers;

use Auth;
use BuildGrid\Events\UserPasswordWasChanged;
use BuildGrid\Repositories\UserRepository;
use Event;
use Hash;
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

        if ($user !== null) {
            $user->fill($request->all());
            $user->save();
        }

        return back()->with('message', 'Operation Successful !');
    }

    public function updatePassword(Request $request, $id)
    {
        $this->validate($request, [
            'password' => 'required|min:8',
            'confirm_password' => 'required|min:8'
        ]);

        $user = User::findOrFail($id);

        if (strcmp($request->get('password'), $request->get('confirm_password')) === 0) {
            $user->password = Hash::make($request->get('password'));
            $user->save();

            Event::fire(new UserPasswordWasChanged($user));

            return view('profile', compact($user));
            // return response()->json(['error' => false,
            // 		'message' =>  'The password was updated.' ]);            
        } else {
            return response()->json(['error' => true,
                'message' => "The passwords doesn't match."]);
        }
    }

    /**
     * @param User $user
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function uploadProfilePicture(User $user, Request $request)
    {
        if ($user->id !== \Auth::id() ) {
            return response('Unauthorized', 403);
        }

        $picture = $request->picture;

        if ($this->userRepository->storeProfilePicture($user, $picture)) {
            return response('OK');
        }

        return response('We could not store the picture', 500);
    }


    /**
     * @param User $user
     * @param string $size
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function getProfilePicture(User $user, $size = 'full')
    {

        $file = $this->userRepository->retrieveProfilePicture($user, $size);

        if (! $file ) {

            switch($size){
                case 'full': $file = \Image::make( public_path() . '/images/profile_full.png' );
                    break;
                case 'thumbnail': $file = \Image::make( public_path() . '/images/profile_thumbnail.png' );
                    break;
                default: $file = \Image::make( public_path() . '/images/profile_medium.png' );
            }

            $response = \Response::make($file->encode('png'));
            $response->header('Content-Type', 'image/png');

            return $response;
        }


        return response($file, 200, [ 'Content-Type' => 'image/png' ]);

    }

}
