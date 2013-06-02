<?php
	require_once('./include/db.php');

	header('Content-type: text/xml');
	echo '<Response>';

	$phone_number = $_REQUEST['From'];
	$text =  $_REQUEST['Body'];
	
	if (isset($text))
	{
		$array = explode(', ', $text, 2);
		$crime = $array[0];
		$address = str_replace(" ", "+", $array[1]);
		$json = file_get_contents("http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false&region=$region");
		$json = json_decode($json);
		$lat = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
		$long = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
		
		//extract data from the post
		extract($_POST);
	
		$url = 'http://guard-map.herokuapp.com/api/push';
		date_default_timezone_set("UTC");
		$fields = array(
		'time' => urlencode(date("Y-m-d H:i:s",time())), //UTC time
		'lat' => urlencode($lat),
		'long' => urlencode($long),
		'severity' => urlencode(10) //urlencode($crime) //fix later
		);
		
		foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
		rtrim($fields_string, '&');

		//open connection
		$ch = curl_init();

		//set the url, number of POST vars, POST data
		curl_setopt($ch,CURLOPT_URL, $url);
		curl_setopt($ch,CURLOPT_POST, count($fields));
		curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

		//execute post
		$result = curl_exec($ch);

		//close connection
		curl_close($ch);
		
		$response = urlencode($fields_string);
	}
	else 
	{
		$response = "Hate life";
	}
	echo '<Sms>'.$response.'</Sms>';
	echo '</Response>';
?>