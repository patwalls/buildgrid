<?php

namespace BuildGrid\Providers;

use Laravel\Socialite\Two\LinkedInProvider;

class CustomLinkedInProvider extends LinkedInProvider
{
	/**
	 * The fields that are included in the profile.
	 *
	 * @var array
	 */
	protected $fields = [
			'id', 'first-name', 'last-name', 'formatted-name',
			'email-address', 'headline', 'location', 'industry',
			'public-profile-url', 'picture-url', 'picture-urls::(original)',
			'summary'
	];	
	
	public function __construct($linkedInProvider)
	{
		parent::__construct($linkedInProvider->request, 
							$linkedInProvider->clientId, $linkedInProvider->clientSecret, $linkedInProvider->redirectUrl);
	}

	public function getFullUserByToken( $token )
	{
		$user = $this->mapUserToObject ( $this->getUserByToken( $token ) );
		$user->linkedin_token = $token;
		
		return $user;
	}	
	
	public function getFields()
	{
		return $this->fields;
	}
	
	protected function mapUserToObject(array $user)
	{
		$user = [
				'linkedin_id' => $user['id'],
				'first_name' => array_get($user, 'firstName'),
				'last_name' => array_get($user, 'lastName'),
				'email' => array_get($user, 'emailAddress') 
				/*'photo' => array_get($user, 'pictureUrls.values.0'),
				'linkedin_country' => array_get($user, 'location.country.code'),
				'linkedin_location' => array_get($user, 'location.name'),
				'linkedin_industry' => array_get($user, 'industry'),
				'bio'  => array_get($user, 'summary'),
				'profession' => array_get($user, 'headline') */
		];
		
		return (object) $user;
	}	
}
