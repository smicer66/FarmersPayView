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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function show($id)
    {
        //
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
    public function destroy($id)
    {
        //
    }


    public function getRegister()
    {
        /*$role = new \App\Models\Roles();
        $rolesList = $role->getAdminCreationRolesList();
        $user = \Auth::user();


        $all_banks = json_decode($user->all_banks);
        $all_provinces_ = json_decode($user->all_provinces);
	$all_countries = json_decode($user->all_countries);
        $all_provinces = array();

        foreach($all_provinces_ as $province)
            $all_provinces[$province->id] = $province->provinceName;
			
		return view('core.authenticated.admin_user.new_admin_staff', compact('rolesList', 'all_provinces', 'all_banks', 'all_countries'));	
		*/


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
		foreach($userList as $user)
		{
			$userEntry = [];
			$link = '';
			
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
			$userEntry['userRole'] = $user->userRole;
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
	
	

    public function getUserListing(Request $request, $urole=NULL)
    {

        return view('core.authenticated.admin_user.admin_user_listing', compact('urole'));
    }

    public function postRegister(Request $request)
    {
        $data = $request->all();
        $pswd = Str::random(6);


		$defaultAcquirer = \App\Models\Acquirer::where('isDefault', '=', 1)->first();
        	//dd($defaultAcquirer->toArray());
        	if($defaultAcquirer==null)
        	{
            		return response()->json(['message' => 'Error encountered. ERR00AQ1', 'success'=>false], 200);
        	}

        	$defaultAcquirer = $defaultAcquirer->toArray();
        	$encrypterFrom = new Encrypter($defaultAcquirer['accessExodus'], 'AES-256-CBC');
        	$password= $encrypterFrom->encrypt($pswd."");


        $data['encPassword'] = $password;
        $data['bankId'] = intval($data['bankId']);
        $data['locationDistrict_id'] = intval($data['locationDistrict_id']);
        $data['token'] = \Auth::user()->token;
        $data['probasePayMerchantCode'] = BEVURA_MERCHANT_CODE;
        $data['probasePayDeviceCode'] = BEVURA_DEVICE_CODE;
	 $data['roleCode'] = $data['role_type'];
	 $data['username'] = $data['contactEmail'];
	 $data['mobileNumber'] = $data['countryalt']."".$data['contactMobile'];
	 //$data['username'] = "temboadams@gmail.com";


	//dd($data);


        $file_name = NULL;
        if ($request->hasFile('profilePix')) {
            $file = \Input::file('profilePix');
            $file_name = str_random(25) . '.' . $file->getClientOriginalExtension();
            $dest = 'files/passports/';
            $file->move($dest, $file_name);
            unset($data['profilePix']);
            $data['profilePix'] = $file_name;

        }

        $result = null;


	 




	 if($data['role_type']=='CUSTOMER')
	 {
	 	$data['setRegistrationCode'] = isset($data['setRegistrationCode']) && $data['setRegistrationCode']!=null && $data['setRegistrationCode']==0 ? 1 : 0;
	 }
	 else
	 {
	 	unset($data['setRegistrationCode']);
	 }

	 $dataStr = "";
        foreach($data as $d => $v)
        {
            $dataStr = $dataStr."".$d."=".$v."&";
        }


        if($data['role_type']=='BANK_STAFF')
        {
		$url = 'http://'.getServiceBaseURL().'/ProbasePayEngineV2/services/UserServices/createBankStaff';
		$authDataStr = sendPostRequest($url, $dataStr);
        	$authData = json_decode($authDataStr);


            //$result = handleSOAPCalls('createBankStaff', 'http://'.getServiceBaseURL().'/ProbasePayEngine/services/UserServices?wsdl', $data);
        }
        else {
//dd($data);
		$url = 'http://'.getServiceBaseURL().'/ProbasePayEngineV2/services/UserServicesV2/createNewUserAccount';
		$authDataStr = sendPostRequest($url, $dataStr);
        	$authData = json_decode($authDataStr);

            //$result = handleSOAPCalls('createNewAdminUser', 'http://'.getServiceBaseURL().'/ProbasePayEngine/services/UserServices?wsdl', $data);
        }

        


	 
        

        if($authData->status == 500)
        {

		if($data['role_type']=='ACCOUNTANT')
		{

		}
		else if($data['role_type']=='EXCO_STAFF')
		{

		}
		else
		{
            		$mobile = $data['contactMobile'];
            		$msg = "Welcome to ProbasePay.com. \nYour Password is ".$pswd."\n\nThank You.";
            		send_sms($mobile, $msg);
            		return \Redirect::to('/potzr-staff/user-listing/agent')->with('message', 'New User Account Successfully created');
		}
        }
	 dd($authData);
        return \Redirect::back()->with('error', 'New User Account creation failed. '.(isset($authData->message) && $authData->message!=null ? $authData->message : ''));
        //dd($result);
    }


    public function getProfileView($id=NULL)
    {
        return view('probasewallet.authenticated.user', compact('rolesList', 'all_provinces', 'all_banks'));
    }


	public function getManageUserStatus(Request $request, $id, $action)
	{
		$all = $request->all();
		//dd([$action, $id, $all]);
		$status = null;
		$userIds = $id;
		if($action=='disable')
		{
			$status = 0;
		}
		else if($action=='enable')
		{
			$status = 1;
		}
		else if($action=='unlock')
		{
			$status = 1;
		}

		$defaultAcquirer = \App\Models\Acquirer::where('isDefault', '=', 1)->first();
        	//dd($defaultAcquirer->toArray());
        	if($defaultAcquirer==null)
        	{
            		return response()->json(['message' => 'Error encountered. ERR00AQ1', 'success'=>false], 200);
        	}

        	$defaultAcquirer = $defaultAcquirer->toArray();
        	$encrypterFrom = new Encrypter($defaultAcquirer['accessExodus'], 'AES-256-CBC');
        	$userIds= $encrypterFrom->encrypt($id."");


		$data['token'] = \Auth::user()->token;
		$data['status'] = $status;
		$data['userIdS'] = $userIds;
	 	$data['deviceCode'] = BEVURA_DEVICE_CODE;
	 	$data['merchantCode'] = BEVURA_MERCHANT_CODE;
//dd($data);
		$result = null;
        	$dataStr = "";
        	foreach($data as $d => $v)
        	{
            		$dataStr = $dataStr."".$d."=".$v."&";
        	}

//dd($dataStr);

//dd($action);
        	$url = 'http://'.getServiceBaseURL().'/ProbasePayEngineV2/services/UserServicesV2/updateUserStatus';
        	$authDataStr = sendPostRequest($url, $dataStr);
        	$authData = json_decode($authDataStr);

        	if($authData->status==502) {
            		return \Redirect::back()->with('message', 'Users status updated successfully');
        	}
       	else {
            		return \Redirect::back()->with('message', isset($authData->message) && $authData->message!=null ? $authData->message : 'Users status could not be updated');
        	}
		
	}





	public function getResendUserCredentials(Request $request, $id	)
	{
		$all = $request->all();
		$userIds = $id;
		
		$defaultAcquirer = \App\Models\Acquirer::where('isDefault', '=', 1)->first();
        	//dd($defaultAcquirer->toArray());
        	if($defaultAcquirer==null)
        	{
            		return response()->json(['message' => 'Error encountered. ERR00AQ1', 'success'=>false], 200);
        	}

        	$defaultAcquirer = $defaultAcquirer->toArray();
        	$encrypterFrom = new Encrypter($defaultAcquirer['accessExodus'], 'AES-256-CBC');
        	$userIds= $encrypterFrom->encrypt($id."");


		$data['token'] = \Auth::user()->token;
		$data['userIdS'] = $userIds;
	 	$data['deviceCode'] = BEVURA_DEVICE_CODE;
	 	$data['merchantCode'] = BEVURA_MERCHANT_CODE;
//dd($data);
		$result = null;
        	$dataStr = "";
        	foreach($data as $d => $v)
        	{
            		$dataStr = $dataStr."".$d."=".$v."&";
        	}

//dd($dataStr);

//dd($action);
        	$url = 'http://'.getServiceBaseURL().'/ProbasePayEngineV2/services/UserServicesV2/resendUserCredentials';
        	$authDataStr = sendPostRequest($url, $dataStr);
        	$authData = json_decode($authDataStr);

        	if($authData->status==5000) {
            		return \Redirect::back()->with('message', 'User has been sent their security credentials');
        	}
       	else {
            		return \Redirect::back()->with('message', isset($authData->message) && $authData->message!=null ? $authData->message : 'Users security credentials could not be sent');
        	}
		
	}
}
