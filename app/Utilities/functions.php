<?php
use phpseclib\Crypt\RSA;

/**
 * Generate Primary Key for inserting values
 * @return string
 */
function getServiceBaseURL()
{
	//return "10.71.39.18:8080";
	return "localhost:8082/farmerspay";
}

function primary_key()
{
    $t = microtime(true);
    $micro = sprintf("%06d", ($t - floor($t)) * 1000000);
    $d = new DateTime(date('Y-m-d H:i:s.' . $micro, $t));
    return $d->format("YmdHisu");
}


function sendPostRequest($url, $jsonData, $contentType)
{
	$response = Http::withBody(json_encode($jsonData), 'application/json')
    ->withOptions([
    ])
    ->post($url);
	
	return ($response);
}

function sendPostRequestWithToken($url, $jsonData, $contentType, $token)
{
	//dd($url);
	$response = Http::withHeaders([
            'Authorization' => $token!=null ? 'Bearer '.$token : 'Bearer'
        ])//->withBody(($jsonData), 'application/json')
    ->withBody(json_encode($jsonData), 'application/json')
    ->withOptions([
    ])
    ->post($url);
	
	return ($response);
}

function sendGetRequest($url, $jsonData, $contentType, $token)
{
	//dd((json_encode($jsonData)));
	$response = Http::withHeaders([
            'Authorization' => $token!=null ? 'Bearer '.$token : 'Bearer'
        ])//->withBody(($jsonData), 'application/json')
    ->withOptions([
    ])
    ->get($url, (($jsonData)));
	
	return ($response);
}

function u_logout()
{
    if(\Auth::user())
    {
        \Auth::logout();
        sleep(4);
        \Auth::logout();
	\Session::flush();
    }
}

function sendPostRequest1($url, $jsonData, $contentType)
{
	$ch = curl_init($url);
	

	$curl = curl_init();

	curl_setopt_array($curl, array(
		CURLOPT_URL => $url,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_POSTFIELDS => $jsonData,
		//"username=potzr_staff@gmail.com&encPassword=eyJpdiI6InRLOXJlM0t3cFR6WmNpdVJPWUdxNkE9PSIsInZhbHVlIjoiQTMxNGRFaHhLT3E4UEkwL1dheVV4Zz09IiwibWFjIjoiZmZjMjhmYTdjZTg5NGM3ZDUxYjViY2E4NzVkN2Y1OWYwNDM4M2FiNjA0YTg4M2E0MjY3MzVkYTgzYzE0Mzg4MyJ9&bankCode=PROBASE",
		CURLOPT_HTTPHEADER => array(
			"Content-Type: ".$contentType
		),
	));

	$response = curl_exec($curl);

	dd($response);
	try{
		$header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
		$header = substr($response, 0, $header_size);
		$body = substr($response, $header_size);


		curl_close($curl);

		//dd($body);
		$body = (trim(preg_replace('/\s+/', ' ', $body)));

		//return $body;
		return $response;


	}
	catch(\Exception $e)
	{
		return $e;
	}

}
