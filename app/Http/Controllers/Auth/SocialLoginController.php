<?php

namespace BuildGrid\Http\Controllers\Auth;

use Socialite;
use Auth;

use BuildGrid\User;
use BuildGrid\Http\Controllers\Controller;
use BuildGrid\Providers\CustomLinkedInProvider;


class SocialLoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Social Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the social login of users...
    |
    */
    
    /**
     * Redirect the user to the LinkedIn authentication page.
     *
     * @return Response
     */
    public function redirectToLinkedIn()
    {
    	return Socialite::driver('linkedin')->redirect();
    }
	
	/**
	 * Obtain the user information from LinkedIn.
	 *
	 * @return Response
	 */
	public function handleLinkedInCallback() {
		try {
			$linkedInProvider = Socialite::driver('linkedin');
			$customLinkedInProvider = new CustomLinkedInProvider($linkedInProvider);
			
			$linkedInProvider->fields( $customLinkedInProvider->getFields() );
			
			//First call to get the user's AccessToken
			$user = $linkedInProvider->user();
		
			//Second call to get All extra info doesn't provided for Laravel Socialite
			$user = $customLinkedInProvider->getFullUserByToken($user->token) ;
		} catch ( Exception $e ) {
			return redirect()->route('login');
		}
		
		$authUser = $this->getLinkedInUser($user);
		
        Auth::login($authUser, true);

        return redirect()->route('home');
    }
    
    /**
     * Return user if exists; create and return if doesn't
     *
     * @param $user		User with all LinkedIn info
     * @return User
     */
    private function getLinkedInUser($user)
    {
    	//$user->status = 'Verified';
    	
    	if ($authUser = User::where('email', $user->email)->first()) {
    		
    		//Update all info for an existing user
    		$authUser->linkedin_id 	     = $user->linkedin_id;
    		$authUser->linkedin_token    = $user->linkedin_token;		
    		
    		$authUser->save();
    		
    		return $authUser;
    	}
    
    	//Create a NEW user
    	return User::create((array) $user);
    } 
}
