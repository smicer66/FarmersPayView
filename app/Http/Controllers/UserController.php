<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Encryption\Encrypter;
use Redirect;
use Illuminate\Support\Str;

class UserController extends Controller
{
    


    public function getRegister()
    {
		return view('core.guest.register');
        
    }
	
	
	public function getAllUsers()
	{
		return view('core.authenticated.users.list-users');
	}
	
	
	public function getUserTypes()
	{
		return view('core.authenticated.usertypes.list-user-types');
	}
	
	
	public function getListUserTypesApi(Request $request)
	{
		
		//dd($request->all());
		$start = $request->get('start')/$request->get('length');
		$length = $request->get('length');
		$url = 'http://'.getServiceBaseURL().'/api/v1/user/list-user-types/'.$length.'/'.$start;
		$all = $request->all();
			
		
			
		$defaultData = sendGetRequest($url, $all, 'application/json', \Auth::user()->token);
		//dd($defaultData->json());
		if($defaultData->status()!=200)
		{
			return back()->with('error', 'Error logging in. Please try again later');
		}
		$defaultData = $defaultData->json();
		$defaultData = json_encode($defaultData);
		$defaultData = json_decode($defaultData);
		$userTypeList = $defaultData->responseData->userTypeList;
		$count = $defaultData->responseData->count;
		$userTypes = [];
		foreach($userTypeList as $userType)
		{
			$userTypeEntry = [];
			$link = '<div class="btn-group">
                                    <button class="btn btn-sm btn-danger btn-sm" type="button">Action</button>
                                    <button data-toggle="dropdown" class="btn btn-danger btn-sm dropdown-toggle"
                                            type="button" aria-expanded="false">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul role="menu" class="dropdown-menu">
                                        <li><a href="/update-permissions/'.$userType->id.'">Assign Permissions</a></li>
                                    </ul>
                                </div>';
			$userTypeEntry['userType'] = $userType->userType;
			$userTypeEntry['createdByFullName'] = $userType->createdByFullName;
			$userTypeEntry['link'] = $link;
			array_push($userTypes, $userTypeEntry);
		}
		
		//dd($defaultData);
		
		return [
			'data'=>$userTypes,
			'recordsTotal'=>$count[0],
			'recordsFiltered'=>$count[0],
			
		];
	}
	

	public function getListUsersApi(Request $request)
	{
		
		//dd($request->all());
		$start = $request->get('start')/$request->get('length');
		$length = $request->get('length');
		$url = 'http://'.getServiceBaseURL().'/api/v1/user/list-users/'.$length.'/'.$start;
		$all = $request->all();
			
		
			
		$defaultData = sendGetRequest($url, $all, 'application/json', \Auth::user()->token);
		//dd($defaultData->json());
		if($defaultData->status()==500)
		{
			$js = $defaultData->json();
			$js['message'] = $js['error'];
			dd($js);
			return $js;
		}
		else if($defaultData->status()!=200)
		{
			return \Response::json($defaultData->json(), $defaultData->status());
		}
		$defaultData = $defaultData->json();
		$defaultData = json_encode($defaultData);
		$defaultData = json_decode($defaultData);
		$userList = $defaultData->responseData->userList;
		$count = $defaultData->responseData->count;
		$users = [];
		foreach($userList as $us)
		{
			$userEntry = [];
			$link = '';
			$user = $us->user;
			if($user->userStatus!='NOT_ACTIVATED')
			{
				$link = $link.'<div class="btn-group">
						<button class="btn btn-sm btn-danger btn-sm" type="button">Action</button>
						<button data-toggle="dropdown" class="btn btn-danger btn-sm dropdown-toggle"
								type="button" aria-expanded="false">
							<span class="caret"></span>
							<span class="sr-only">Toggle Dropdown</span>
						</button>
						<ul role="menu" class="dropdown-menu">';
				if($user->userStatus=='ACTIVE')
				{
					$link = $link.'<li><a href="/administrator/update-user-status/SUSPENDED/'.$user->id.'">Block Profile</a></li>';
				}
				if($user->userStatus=='SUSPENDED')
				{
					$link = $link.'<li><a href="/administrator/update-user-status/ACTIVE/'.$user->id.'">Activate Profile</a></li>';
				}
				
				$link = $link.'</ul>
						</div>';
			}
			$userEntry['fullName'] = $user->lastName." ".$user->firstName.(strlen($user->otherNames)>0 ? (" ".$user->otherNames) : "");
			$userEntry['mobileNumber'] = $user->mobileNumber;
			$userEntry['userRole'] = $user->userRole."<br><small><i>".($us->userType==null ? "" : $us->userType)."</i></small>";
			$userEntry['dateOfBirth'] = $user->dateOfBirth;
			$userEntry['status'] = $user->userStatus;
			$userEntry['link'] = $link;
			array_push($users, $userEntry);
			
		}
		
		//dd($defaultData);
		
		return [
			'data'=>$users,
			'recordsTotal'=>$count[0],
			'recordsFiltered'=>$count[0],
			
		];
	}
	
	
	
	public function getUpdateUserStatus(Request $request, $status, $userId)
	{
		//dd([$status, $userId]);
		$all = $request->all();
		
		$data = [];
		
		$data['status'] = $status;
		$data['userId'] = $userId;
		$url = 'http://'.getServiceBaseURL().'/api/v1/user/update-user-status';
		$authData = sendPostRequestWithToken($url, $data, 'application/json', \Auth::user()->token);
		//dd($authData);
		
		if($authData->status()==500)
		{
			return \Redirect::back()->with('error', $authData->json()['message']);
		}
		else if($authData->status()!=200)
		{
			return \Redirect::back()->with('error', $authData->json()['message']);
		}
		
		return \Redirect::back()->with('success', $authData->json()['message']);
	}

	public function getAddNewUserType()
	{
		return view('core.authenticated.usertypes.add-user-type');
	}
	
	
	
	
	public function postAddUserType(Request $request)
	{
		$all = $request->get('userTypes');
		
		$check = false;
		$respTrue = null;
		$respFalse = null;
		$data = [];
		
		$data['userTypes'] = $all;
		$url = 'http://'.getServiceBaseURL().'/api/v1/user/add-user-type';
		$authData = sendPostRequestWithToken($url, $data, 'application/json', \Auth::user()->token);
		
		
		if($authData->status()==500)
		{
			$js = $authData->json();
			$js['message'] = $js['error'];
			return $js;
		}
		else if($authData->status()!=200)
		{
			return $authData->json();
		}
		
		return $authData->json();
		
	}

    
	public function getAddNewAdminUser()
	{
		$url = 'http://'.getServiceBaseURL().'/api/v1/utilities/fetch-default-data';
			
			
		$defaultData = sendGetRequest($url, [], 'application/json', null);
		if($defaultData->status()!=200)
		{
			return back()->with('error', 'Error logging in. Please try again later');
		}
		
		$defaultData = $defaultData->json();
		$defaultData = json_encode($defaultData);
		$defaultData = json_decode($defaultData);
		$defaultData = $defaultData->responseData;
		$userTypes = $defaultData->userTypeList;
		
		return view('core.authenticated.users.add-admin-user', compact('userTypes'));
	}
	
	
	
	public function postAddAdminUserApi(Request $request)
	{
		$all = $request->except('_token');
		//dd($all);
		
		$url = 'http://'.getServiceBaseURL().'/api/v1/user/create-new-administrator';
		$authData = sendPostRequestWithToken($url, $all, 'application/json', \Auth::user()->token);
		
		
		if($authData->status()==500)
		{
			$js = $authData->json();
			$js['message'] = $js['error'];
			return $js;
		}
		else if($authData->status()!=200)
		{
			return $authData->json();
		}
		
		return $authData->json();
		
	}



	public function getDashboard()
    {
		if(\Auth::user()->userRole=="ADMINISTRATOR")
			return view('core.authenticated.dashboard.administrator_dashboard');
		else
			return view('core.authenticated.dashboard.farmers_dashboard');
        
    }
	


}
