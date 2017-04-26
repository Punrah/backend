<?php
// API access key from Google API's Console
define( 'API_ACCESS_KEY', 'AAAAbGygPzQ:APA91bEt_eQ65Vd6z_-lG1qFZYexatk-rYF-SMDUC4rzh1fp09GxE1pfDoRE9NgStnIK1cAsig18KAJIVtq9RL9ZvuxzagEDa3BJHm_nPtKR5igdZAbzN8KcGDWsKtZCZjpOoQumig9MR_Bwhw9vaRJNWE1FHrCF2A' );
$registrationIds = array( $_GET['id'] );
// prep the bundle
$msg = array
(
	'message' 	=> 'here is a message. message',
	'title'		=> 'This is a title. title',
	'subtitle'	=> 'This is a subtitle. subtitle',
	'tickerText'	=> 'Ticker text here...Ticker text here...Ticker text here',
	'vibrate'	=> 1,
	'sound'		=> 1,
	'largeIcon'	=> 'large_icon',
	'smallIcon'	=> 'small_icon'
);
$fields = array
(
	'registration_ids' 	=> $registrationIds,
	'data'			=> $msg
);
 
$headers = array
(
	'Authorization: key=' . API_ACCESS_KEY,
	'Content-Type: application/json'
);
 
$ch = curl_init();
curl_setopt( $ch,CURLOPT_URL, 'https://android.googleapis.com/gcm/send' );
curl_setopt( $ch,CURLOPT_POST, true );
curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
$result = curl_exec($ch );
curl_close( $ch );
echo $result;