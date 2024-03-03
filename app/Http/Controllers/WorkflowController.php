<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WorkflowController extends Controller
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
	
	
	public function getWorkflowUsersApi(Request $request)
	{
		$start = $request->get('start')/$request->get('length');
		$length = $request->get('length');
		$url = 'http://'.getServiceBaseURL().'/api/v1/workflow/get-workflow-users/'.$length.'/'.$start;
		$all = $request->all();
			
		
			
		$defaultData = sendPostRequestWithToken($url, $all, 'application/json', \Auth::user()->token);
		//dd($defaultData->json());
		if($defaultData->status()!=200)
		{
			return back()->with('error', 'Error logging in. Please try again later');
		}
		$defaultData = $defaultData->json();
		$defaultData = json_encode($defaultData);
		$defaultData = json_decode($defaultData);
		//dd($defaultData);
		$workflowUserList = $defaultData->responseData->workflowUserList;
		$count = $defaultData->responseData->count;
		$workflowList = [];
		foreach($workflowUserList as $wfu)
		{
			$wfuEntry = [];
			$link = '<div class="btn-group">
                                    <button class="btn btn-sm btn-danger btn-sm" type="button">Action</button>
                                    <button data-toggle="dropdown" class="btn btn-danger btn-sm dropdown-toggle"
                                            type="button" aria-expanded="false">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul role="menu" class="dropdown-menu">
                                        <li><a href="/update-farm/'.$wfu->id.'">Update Farm</a></li>
                                        <li><a href="/admin/payment/approve-fees/'.$wfu->id.'">Remove Farm</a></li>
                                    </ul>
                                </div>';
			$wfuEntry['userFullName'] = $wfu->userFullName;
			$wfuEntry['level'] = $wfu->level;
			$wfuEntry['userRole'] = $wfu->userRole;
			$wfuEntry['permissionList'] = $wfu->permissionList;
			$wfuEntry['link'] = $link;
			array_push($workflowList, $wfuEntry);
		}
		
		//dd($workflowList);
		
		return [
			'data'=>$workflowList,
			'recordsTotal'=>$count[0],
			'recordsFiltered'=>$count[0],
			
		];
	}
	
	
	public function getWorkflowUsers()
	{
		return view('core.authenticated.workflow.list-workflow-users');
	}
	
	public function getSettings(Request $request)
	{
		$url = 'http://'.getServiceBaseURL().'/api/v1/user/list-users/1000/0';
		$all = $request->all();
		
			
		$defaultData = sendGetRequest($url, $all, 'application/json', \Auth::user()->token);
		//dd($defaultData->json());
		if($defaultData->status()==500)
		{
			$js = $defaultData->json();
			$js['message'] = $js['error'];
			\Auth::logout();
			\Auth::logout();
			
			return \Redirect::to('/login');
		}
		else if($defaultData->status()!=200)
		{
			\Auth::logout();
			\Auth::logout();
			
			return \Redirect::to('/login');
		}
		$defaultData = $defaultData->json();
		$defaultData = json_encode($defaultData);
		$defaultData = json_decode($defaultData);
		
		$userList = $defaultData->responseData->userList;
		//dd($userList);
		$userList = array_filter($userList, function($it){
			
			return $it->user->userRole=="ADMINISTRATOR";
		});
		//dd($userList);
		
		return view('core.authenticated.workflow.workflow-settings', compact('userList'));
	}
	
	
	public function createNewWorkflowApi(Request $request)
	{
		
		$url = 'http://'.getServiceBaseURL().'/api/v1/workflow/create-workflow';
		$all = ($request->except('_token'));
		$createWorkflowRequestData = [];
		$createWorkflowRequestData['createWorkflowRequestData'] = $all['data'];
		$defaultData = sendPostRequestWithToken($url, $createWorkflowRequestData, 'application/json', \Auth::user()->token);
		//dd($defaultData->status());
		if($defaultData->status()!=200)
		{
			return back()->with('error', 'Error logging in. Please try again later');
		}
		$defaultData = $defaultData->json();
		$defaultData = json_encode($defaultData);
		$defaultData = json_decode($defaultData);
		
		//dd($defaultData);
		$workflowUserList = $defaultData->responseData;
		$message = $defaultData->message;
		$responseCode = $defaultData->responseCode;
		
		return [
			'data'=>$workflowUserList,
			'message' => $message,
			'status'=>$responseCode
		];
	}
	
	
	public function updateSettings(Request $request)
	{
		$url = 'http://'.getServiceBaseURL().'/api/v1/user/list-users/1000/0';
		$all = $request->all();
			
		$defaultData = sendGetRequest($url, $all, 'application/json', \Auth::user()->token);
		//dd($defaultData->json());
		if($defaultData->status()==500)
		{
			$js = $defaultData->json();
			$js['message'] = $js['error'];
			\Auth::logout();
			\Auth::logout();
			
			return \Redirect::to('/login');
		}
		else if($defaultData->status()!=200)
		{
			\Auth::logout();
			\Auth::logout();
			
			return \Redirect::to('/login');
		}
		$defaultData = $defaultData->json();
		$defaultData = json_encode($defaultData);
		$defaultData = json_decode($defaultData);
		$userList = $defaultData->responseData->userList;
		//dd($userList);
		
		return view('core.authenticated.workflow.workflow-settings', compact('userList'));
	}
}
