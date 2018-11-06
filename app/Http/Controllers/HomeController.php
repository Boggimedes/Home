<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Family;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
	private $computername;
	/**
	 * Instantiate a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->computername = "DESKTOP-AU1VFFR";
	}

	public function command(Request $request)
	{
		//{"token":"4dm1uDhUUIHCbQu!", "command":"pause", "data": "api{{TextField}}"}
		$params = $request->all();
		if ($params['token'] !== "4dm1uDhUUIHCbQu!") {
			abort(405);
		}
		$data = empty($params['data']) ? "" : $params['data'];
		if (strpos($data, "for Camille") || strpos($data, "on Camille's pc") || strpos($data, "on the little pc")) {
			$this->computername = "GM-PC";
			$search =["for Camille", "on Camille's pc", "on the little pc"];
			$data = str_replace($search, '', $data);
		}
		\Log::info($params);
		if ($params['command'] === "music") {
			$search =["some ", "some"];
			$data = str_replace($search, '', $data);
		}
		$send = array("computername" => $this->computername, "trigger" => $params['command']);
		if (!empty($data)) $send['params'] = "\"$data\"";
		$data_string = json_encode($send);
		$this->trigger($data_string);
		return response()->json(
			[
				'message'               => 'Command Sent!',
				'command'   => $params['command'],
			]);
	}

	public function stopAll(Request $request)
	{
		$params = $request->all();
		if ($params['token'] !== config('home.secret')) {
			abort(405);
		}
		$data = array("computername" => $this->computername, "trigger" => "stop");
		$data_string = json_encode($data);                                                                                   
		$this->trigger($data_string);                                                                                      

		$data = array("computername" => $this->computername, "trigger" => "Alloff", "params" => "");
		$data_string = json_encode($data);                                                                                   
		$this->trigger($data_string);                          
	}

	public function projOff()
	{
		$data = array("computername" => $this->computername, "trigger" => "stop");
		$data_string = json_encode($data);                                                                                   
		$this->trigger($data_string);                                                                                      

		$data_string = json_encode(array("computername" => $this->computername, "trigger" => "IR", "params" => "Projector Power"));
		for ($i=0; $i < 2; $i++) { 
			$this->trigger($data_string);
			sleep(1);
		}                                               
	}

	public function ir(Request $request)
	{
		$data = $request->all();
		if ($data['token'] !== config('home.secret')) {
			abort(405);
		}
		$params = $data['param1'];
		if (empty($data['repeat']))
		{
			$data['repeat'] = 1;
		}
		$data_string = json_encode(array("computername" => $this->computername, "trigger" => "IR", "params" => $data['param1'] . ' ' . $data['param2']));
		for ($i=0; $i < $data['repeat']; 	$i++) { 
			$this->trigger($data_string);
			sleep(1);
		}                                               
	}

	public function camille()
	{
		$data = array("computername" => "AIO", "trigger" => "Camille");
		$data_string = json_encode($data);                                                                                   
		$this->trigger($data_string);                                                                                      
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	private function trigger($data)
	{
		$ch = curl_init('https://www.triggercmd.com/api/run/triggerSave');                                                                      
		Log::info($data);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			'Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjVhMjMyNmQzNTc4NzVkOGY2NjI0NDAyZiIsImlhdCI6MTUxMjMwOTU4NX0.lMWmALKwA_CpFvmt17zh2XHm0itzqkMKMoBCPs3o44o ',                                                                                
			'Content-Length: ' . strlen($data))                                                                       
		);                                                                                                                   
																													 
		$result = curl_exec($ch);
		Log::info($result);
		return response()->json($data);
	}

	private function setPc($data)
	{
		if (strpos($data, " for Camille") OR strpos($data, " on Camille's pc") OR strpos($data, " on the little pc")) {
			$this->computername = "AIO";
			$search =[" for Camille", " on Camille's pc", " on the little pc"];
			$data = str_replace($search, '', $data);
		}
		return $data;
	}
}
