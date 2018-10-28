<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Family;
use Illuminate\Support\Facades\Log;

class FamilyController extends Controller
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

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return response()->json('$user3');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function command(Request $request)
	{
		$params = $request->all();
		$data = empty($params['data']) ? "" : $params['data'];
		if(strpos($data, "for Camille") OR strpos($data, "on Camille's pc") OR strpos($data, "on the little pc")) {
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
		if(!empty($data)) $send['params'] = "\"$data\"";
		$data_string = json_encode($send);
		$this->trigger($data_string);
	}

	/**
	 * Send a trigger command to play a movie.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function play($data)
	{
		$data = array("computername" => $this->computername, "trigger" => "play", "params" => "\"$data\"");
		$data_string = json_encode($data);
		return $this->trigger($data_string);
	}

	public function pause()
	{
		$data = array("computername" => $this->computername, "trigger" => "pause", "params" => "");
		$data_string = json_encode($data);
		$this->trigger($data_string);
	}

	/**
	 * Send a trigger command to play a movie.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function resume($data)
	{
		$data = $this->setPc($data);
		$data = array("computername" => $this->computername, "trigger" => "resume", "params" => "\"$data\"");
		$data_string = json_encode($data);
		$this->trigger($data_string);
	}

	/**
	 * Send a trigger command to play a movie.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function netflixMovie($data)
	{
		$data = $this->setPc($data);
		$data = array("computername" => $this->computername, "trigger" => "netflixMovie", "params" => "\"$data\"");
		$data_string = json_encode($data);
		$this->trigger($data_string);
	}

	/**
	 * Send a trigger command to play a movie.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function netflixShow($data)
	{
		$data = $this->setPc($data);
		$data = array("computername" => $this->computername, "trigger" => "netflixShow", "params" => "\"$data\"");
		$data_string = json_encode($data);
		$this->trigger($data_string);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function restart($data)
	{
		$data = $this->setPc($data);
		$data = array("computername" => $this->computername, "trigger" => "restart", "params" => "\"$data\"");
		$data_string = json_encode($data);                                                                                   
		$this->trigger($data_string);                                                                                      
	}
	public function stop()
	{
		$data = array("computername" => $this->computername, "trigger" => "stop");
		$data_string = json_encode($data);                                                                                   
		$this->trigger($data_string);                                                                                      
	}

	public function stopAll()
	{
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

	public function movieTime()
	{
		$data = array("computername" => $this->computername, "trigger" => "Movietime", "params" => "");
		$data_string = json_encode($data);
		$this->trigger($data_string);
	}

	public function ir(Request $request)
	{
		$data = $request->all();
		$params = $data['param1'];
		if(empty($data['repeat']))
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
		if(strpos($data, " for Camille") OR strpos($data, " on Camille's pc") OR strpos($data, " on the little pc")) {
			$this->computername = "AIO";
			$search =[" for Camille", " on Camille's pc", " on the little pc"];
			$data = str_replace($search, '', $data);
		}
		return $data;
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  char  $username
	 * @return \Illuminate\Http\Response
	 */
	public function show($username)
	{
		return response()->json('$user2');
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
