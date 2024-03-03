<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
		return view('core.authenticated.payment-schedule.list-payment-schedules');
    }
	
	
	public function getPaymentScheduleBreakdown($id, $scheduleName)
	{
		return view('core.authenticated.payment-schedule.list-payment-schedule-breakdown', compact('id', 'scheduleName'));
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
		$url = 'http://'.getServiceBaseURL().'/api/v1/farms/list-farm-groups/1000/0';
		$all = $request->all();
		
			
		$defaultData = sendGetRequest($url, $all, 'application/json', \Auth::user()->token);
		//dd($defaultData->status());
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
		
		$farmGroupList = $defaultData->responseData->farmGroupList;
		//dd($farmGroupList);
		
		$monthList = ['JANUARY', 'FEBRUARY', 'MARCH', 'APRIL', 'MAY', 'JUNE', 'JULY', 'AUGUST', 'SEPTEMBER', 'OCTOBER', 'NOVEMBER', 'DECEMBER'];
		return view('core.authenticated.payment-schedule.new-payment-schedule', compact('monthList', 'farmGroupList'));
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
	
	public function createNewPaymentScheduleApi(Request $request)
	{
		$url = 'http://'.getServiceBaseURL().'/api/v1/payment-schedule/create-payment-schedule';
		$all = ($request->except('_token'));
		$createPaymentScheduleRequestData = [];
		$createPaymentScheduleRequestData['scheduleMonth'] = $all['month'];
		$createPaymentScheduleRequestData['scheduleYear'] = $all['year'];
		$createPaymentScheduleRequestData['paymentScheduleBreakdownRequest'] = $all['amountClassification'];
		//dd($createPaymentScheduleRequestData);
		$defaultData = sendPostRequestWithToken($url, $createPaymentScheduleRequestData, 'application/json', \Auth::user()->token);
		//dd($defaultData->status());
		if($defaultData->status()!=200)
		{
			return back()->with('error', 'Error logging in. Please try again later');
		}
		$defaultData = $defaultData->json();
		$defaultData = json_encode($defaultData);
		$defaultData = json_decode($defaultData);
		
		$paymentSchedule = $defaultData->responseData;
		$message = $defaultData->message;
		$responseCode = $defaultData->responseCode;
		
		return [
			'data'=>$paymentSchedule,
			'message' => $message,
			'status'=>$responseCode
		];
	}
	
	
	public function getPaymentScheduleApi(Request $request)
	{
		$start = $request->get('start')/$request->get('length');
		$length = $request->get('length');
		$url = 'http://'.getServiceBaseURL().'/api/v1/payment-schedule/get-payment-schedules/'.$length.'/'.$start;
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
		$paymentScheduleList = $defaultData->responseData->paymentScheduleList;
		$count = $defaultData->responseData->count;
		$workflowList = [];
		foreach($paymentScheduleList as $psl)
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
                                        <li class="liClass"><a href="/administrator/payment-schedule/payment-schedule-breakdown/'.$psl->id.'/'.$psl->scheduleMonth." ".$psl->scheduleYear.'" style="color: #000 !important">Breakdown of Schedule</a></li>
                                        <li class="liClass"><a href="/administrator/payment-schedule/make-payment/'.$psl->id.'" style="color: #000 !important">Make Payment</a></li>
                                        <li class="liClass"><a href="/admin/payment/approve-fees/'.$psl->id.'" style="color: #000 !important">View Payments</a></li>
                                    </ul>
                                </div>';
			$wfuEntry['scheduledDay'] = $psl->scheduleMonth." ".$psl->scheduleYear;
			$wfuEntry['createdByUserName'] = $psl->createdByUserName;
			$wfuEntry['createdAt'] = date('Y, M d h:iA', strtotime($psl->createdAt));
			$wfuEntry['paymentScheduleStatus'] = $psl->paymentScheduleStatus;
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




	
	public function getPaymentScheduleBreakdownApi($id, Request $request)
	{
		//dd($id);
		$start = $request->get('start')/$request->get('length');
		$length = $request->get('length');
		$url = 'http://'.getServiceBaseURL().'/api/v1/payment-schedule/get-payment-schedule-breakdown/'.$id.'/'.$length.'/'.$start;
		$all = $request->all();
			
		
			
		$defaultData = sendPostRequestWithToken($url, $all, 'application/json', \Auth::user()->token);
		//dd($defaultData->status());
		if($defaultData->status()!=200)
		{
			if($defaultData->status()==401)
			{
				$err = [];
				$err['status'] = -1;
				$err['message'] = 'Session expired';
				return response($err, 401);
			}
		}
		
		$defaultData = $defaultData->json();
		$defaultData = json_encode($defaultData);
		$defaultData = json_decode($defaultData);
		//dd($defaultData);
		$paymentScheduleList = $defaultData->responseData->paymentScheduleList;
		$count = $defaultData->responseData->count;
		$workflowList = [];
		$i = 0;
		foreach($paymentScheduleList as $psl)
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
                                        <li class="liClass"><a href="/administrator/payment-schedule/payment-schedule-breakdown/'.$psl->id.'" style="color: #000 !important">Breakdown of Schedule</a></li>
                                        <li class="liClass"><a href="/administrator/payment-schedule/make-payment/'.$psl->id.'" style="color: #000 !important">Make Payment</a></li>
                                        <li class="liClass"><a href="/admin/payment/approve-fees/'.$psl->id.'" style="color: #000 !important">View Payments</a></li>
                                    </ul>
                                </div>';
			$wfuEntry['amountToPay'] = number_format($psl->amountToPay, 2, '.', ',');
			$wfuEntry['id'] = ++$i;
			$wfuEntry['farmGroupName'] = $psl->farmGroupName;
			array_push($workflowList, $wfuEntry);
		}
		
		//dd($workflowList);
		
		return [
			'data'=>$workflowList,
			'recordsTotal'=>$count[0],
			'recordsFiltered'=>$count[0],
			
		];
	}

}
