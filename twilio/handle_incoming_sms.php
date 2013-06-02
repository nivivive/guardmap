<?php
	require_once('./include/db.php');

	header('Content-type: text/xml');
	echo '<Response>';

	$phone_number = $_REQUEST['From'];
	$team_number =  $_REQUEST['Body'];

        if (strcmp($team_number,"HELPME") == 0){
                $response = 'Type 1 to report an assault. Type 2 to report whatever. Type 3 to report more stuff.';
        }
	elseif ( (strlen($phone_number) >= 10) && ($team_number > 0) )
	{
	
	//extract data from the post
	extract($_POST);

	//set POST variables
	$url = 'http://google.com';
	$fields = array(
		'time' => urlencode($last_name), //UTC time
		'lat' => urlencode($first_name),
		'long' => urlencode($title),
		'severity' => urlencode($institution)
		);

	//url-ify the data for the POST
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
	$db = new DB();

	$response = $db->save_vote($phone_number, $team_number);
	}
	
	else {
		$response = 'Sorry, I didn\'t understand that. Text the team number to vote. For example, texting 1 will vote for Team 1.';
	}

	echo '<Sms>'.$response.'</Sms>';
	echo '</Response>';
?>