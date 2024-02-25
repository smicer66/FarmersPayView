<?php

namespace App\Providers;

use Closure;
use Illuminate\Contracts\Auth\Authenticatable as UserContract;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Str;
use Illuminate\Auth\GenericUser;

class CustomUserProvider implements UserProvider
{
    

    /**
     * Retrieve a user by their unique identifier.
     *
     * @param  mixed  $identifier
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveById($identifier)
    {
		
		$userString = \Session::get('user');
		$userDB = json_decode($userString);
		/*dd($user);
		
        $url = 'http://'.getServiceBaseURL().'/api/v1/user/get-user-by-id/'.$identifier;
		
		$data = [];
		
	
		$authData = sendGetRequest($url, $data, 'application/json');
		//dd($authData->status());
		if($authData->status()!=200)
		{
			//dd($authData->json());
			return null;
		}
		$authData = $authData->json();
		$authData = json_encode($authData);
		$authData = json_decode($authData);
		//dd($authData);
		
		if(isset($authData->responseCode) && $authData->responseCode!=null && $authData->responseCode == 0) {

			//$token = $authData->token;
			
			$userDB = $authData->responseData;*/
			//dd($user);
			$user = new \App\Models\User();
			$user->id = $userDB->id;
			$user->firstName = $userDB->firstName;
			$user->lastName = $userDB->lastName;
			$user->otherNames = $userDB->otherNames;
			$user->mobileNumber = $userDB->mobileNumber;
			$user->username = $userDB->username;
			$user->gender = $userDB->gender;
			$user->userRole = $userDB->userRole;
			$user->createdAt = $userDB->createdAt;
			$user->token = $userDB->token;
			//\Auth::login($user, false);
			
			//dd(11);
			/*return new GenericUser([
				'id' => $userDB->id,
				'first_name' =>  $userDB->firstName,
				'last_name' =>  $userDB->lastName,
				'other_names' =>  $userDB->otherNames,
				'mobile_number' =>  $userDB->mobileNumber,
				'username' =>  $userDB->username,
				'gender' =>  $userDB->gender,
				'user_role' =>  $userDB->userRole,
				'created_at' =>  $userDB->createdAt,
				//'email' => $identifier,
			]);*/
			return $user;

		//}
		
    }

    /**
     * Retrieve a user by their unique identifier and "remember me" token.
     *
     * @param  mixed  $identifier
     * @param  string  $token
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByToken($identifier, $token)
    {
        $model = $this->createModel();

        $retrievedModel = $this->newModelQuery($model)->where(
            $model->getAuthIdentifierName(), $identifier
        )->first();

        if (! $retrievedModel) {
            return;
        }

        $rememberToken = $retrievedModel->getRememberToken();

        return $rememberToken && hash_equals($rememberToken, $token)
                        ? $retrievedModel : null;
    }

    /**
     * Update the "remember me" token for the given user in storage.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable|\Illuminate\Database\Eloquent\Model  $user
     * @param  string  $token
     * @return void
     */
    public function updateRememberToken(UserContract $user, $token)
    {
        
    }

    /**
     * Retrieve a user by the given credentials.
     *
     * @param  array  $credentials
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByCredentials(array $credentials)
    {
		dd(111);
        if (empty($credentials) ||
           (count($credentials) === 1 &&
            Str::contains($this->firstCredentialKey($credentials), 'password'))) {
            return;
        }

        // First we will add each credential element to the query as a where clause.
        // Then we can execute the query and, if we found a user, return it in a
        // Eloquent User "model" that will be utilized by the Guard instances.
        $query = $this->newModelQuery();

        foreach ($credentials as $key => $value) {
            if (Str::contains($key, 'password')) {
                continue;
            }

            if (is_array($value) || $value instanceof Arrayable) {
                $query->whereIn($key, $value);
            } elseif ($value instanceof Closure) {
                $value($query);
            } else {
                $query->where($key, $value);
            }
        }

        return $query->first();
    }

    /**
     * Get the first key from the credential array.
     *
     * @param  array  $credentials
     * @return string|null
     */
    protected function firstCredentialKey(array $credentials)
    {
        foreach ($credentials as $key => $value) {
            return $key;
        }
    }

    /**
     * Validate a user against the given credentials.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  array  $credentials
     * @return bool
     */
    public function validateCredentials(UserContract $user, array $credentials)
    {
        $plain = $credentials['password'];

        return $this->hasher->check($plain, $user->getAuthPassword());
    }
	
}
