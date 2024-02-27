<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FarmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	 
	public function getAddFarm()
	{
		//dd(\Auth::user());
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
		$districtList = $defaultData->districtList;
		$provinceList = $defaultData->provinceList;
		
		//dd($defaultData);
		
		return view('core.authenticated.farmers.add-farm1', compact('provinceList', 'districtList'));
	}
	
	
	public function getUpdateFarm($farmId)
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
		$districtList = $defaultData->districtList;
		$provinceList = $defaultData->provinceList;
		
		
		
		$url = 'http://'.getServiceBaseURL().'/api/v1/farms/get-farm/'.$farmId;
			
			
		$farmDetails = sendGetRequest($url, [], 'application/json', \Auth::user()->token);
		//dd($defaultData);
		if($farmDetails->status()!=200)
		{
			return back()->with('error', 'Error logging in. Please try again later');
		}
		
		$farmDetails = $farmDetails->json()['responseData'];
		//dd($defaultData);
		
		
		
		return view('core.authenticated.farmers.update-farm', compact('provinceList', 'districtList', 'farmDetails'));
	}
	
	public function getListFarmsApi(Request $request)
	{
		
		//dd($request->all());
		$start = $request->get('start')/$request->get('length');
		$length = $request->get('length');
		$url = 'http://'.getServiceBaseURL().'/api/v1/farms/list-farms/'.$length.'/'.$start;
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
		$farmList = $defaultData->responseData->farmList;
		$count = $defaultData->responseData->count;
		$farms = [];
		foreach($farmList as $farm)
		{
			$farmEntry = [];
			$link = '<div class="btn-group">
                                    <button class="btn btn-sm btn-danger btn-sm" type="button">Action</button>
                                    <button data-toggle="dropdown" class="btn btn-danger btn-sm dropdown-toggle"
                                            type="button" aria-expanded="false">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul role="menu" class="dropdown-menu">
                                        <li><a href="/update-farm/'.$farm->farm->id.'">Update Farm</a></li>
                                        <li><a href="/admin/payment/approve-fees/'.$farm->farm->id.'">Remove Farm</a></li>
                                    </ul>
                                </div>';
			$farmEntry['farmName'] = $farm->farm->farmName;
			$farmEntry['farmAddress'] = $farm->farm->farmAddress."</br>".$farm->districtName.",</br>".$farm->provinceName;
			$farmEntry['createdAt'] = date('Y, M jS - h:i A', strtotime($farm->farm->createdAt));
			$farmEntry['farmStatus'] = $farm->farm->farmStatus;
			$farmEntry['link'] = $link;
			array_push($farms, $farmEntry);
		}
		
		//dd($defaultData);
		
		return [
			'data'=>$farms,
			'recordsTotal'=>$count[0],
			'recordsFiltered'=>$count[0],
			
		];
	}
	
	
	
    public function index()
    {
        //
		return view('core.authenticated.farmers.list-farms');
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
		$data = $request->except(['_token']);
		$url = 'http://'.getServiceBaseURL().'/api/v1/farms/add-farm';
		$authData = sendPostRequestWithToken($url, $data, 'application/json', \Auth::user()->token);
		
		//dd($authData->json());
		if($authData->status()!=200)
		{
			//dd($authData->json());
			return $authData->json();
		}
		//dd($authData->json());
		$authData = $authData->json();
		
		return $authData;
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
}
