<?php

	$consumerKey = 'RkGxJyv9afGdLlsLogk3CHXm3WsBrK0d'; //Fill with your app Consumer Key
	$consumerSecret = 'Ku7b9M92xdDKQXGG'; // Fill with your app Secret
	$headers = ['Content-Type:application/json; charset=utf8'];
	$access_token_url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
	$curl = curl_init($access_token_url);
	curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($curl, CURLOPT_HEADER, FALSE);
	curl_setopt($curl, CURLOPT_USERPWD, $consumerKey.':'.$consumerSecret);
	$result = curl_exec($curl);
	$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
	$result = json_decode($result);
	$access_token = $result->access_token;
	curl_close($curl);

	/* Reversal Request */
	$reversal_url = 'https://sandbox.safaricom.co.ke/mpesa/reversal/v1/request';

	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $reversal_url);
	curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$access_token)); //setting custom header

	$curl_post_data = array(
	  //Fill in the request parameters with valid values
	  'Initiator' => '',
	  'SecurityCredential' => '',
	  'CommandID' => 'TransactionReversal',
	  'TransactionID' => '',
	  'Amount' => '',
	  'ReceiverParty' => '',
	  'RecieverIdentifierType' => '11',
	  'ResultURL' => 'http://swifftshop.com/Mpesa_APIs/reverse_ResultURL.php',
	  'QueueTimeOutURL' => 'http://swifftshop.com/Mpesa_APIs/reverse_ResultURL.php',
	  'Remarks' => 'OUT OF STOCK',
	  'Occasion' => 'Web Purchase'
	);

	$data_string = json_encode($curl_post_data);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
	$curl_response = curl_exec($curl);
	print_r($curl_response);
	echo $curl_response;

?>
