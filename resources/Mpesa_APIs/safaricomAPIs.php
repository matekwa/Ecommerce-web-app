<?php

//Access token function
function generate_access_token($value=''){
	$consumerKey = 'RkGxJyv9afGdLlsLogk3CHXm3WsBrK0d'; //Fill with your app Consumer Key
	$consumerSecret = 'Ku7b9M92xdDKQXGG'; // Fill with your app Secret

	$headers = ['Content-Type:application/json; charset=utf8'];

	$url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';

	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($curl, CURLOPT_HEADER, FALSE);
	curl_setopt($curl, CURLOPT_USERPWD, $consumerKey.':'.$consumerSecret);
	$result = curl_exec($curl);
	$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
	$result = json_decode($result);

	$access_token = $result->access_token;

	return $access_token;
}

//Function to register validation and confirmation URLS
function register_urls(){
	$url = 'https://sandbox.safaricom.co.ke/mpesa/c2b/v1/registerurl';

	$access_token = generate_access_token(); 
	$shortCode = '490494'; 

	$confirmationUrl = 'http://swifftshop.com/resources/Mpesa_APIs/confirmation.php';
	$validationUrl = 'http://swifftshop.com/resources/Mpesa_APIs/validation.php';
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$access_token)); //setting custom header


	$curl_post_data = array(
	  //Fill in the request parameters with valid values
	  'ShortCode' => $shortCode,
	  'ResponseType' => 'Completed',
	  'ConfirmationURL' => $confirmationUrl,
	  'ValidationURL' => $validationUrl
	);

	$data_string = json_encode($curl_post_data);

	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

	$curl_response = curl_exec($curl);

	return $curl_response;
}

//Function to simulate C2B transaction
function simulateC2B($amount,$phone){
	 $url = 'https://sandbox.safaricom.co.ke/mpesa/c2b/v1/simulate';
    
    $access_token = generate_access_token();    
    $ShortCode  = '490494';
    $amount     = $amount;
    $msisdn     = $_phone; // phone number paying 
    $billRef    = 'mrfmrk'; // This is anything that helps identify the specific transaction. Can be a clients ID, Account Number, Invoice amount, cart no.. etc

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$access_token));


    $curl_post_data = array(
           'ShortCode' => $ShortCode,
           'CommandID' => 'CustomerPayBillOnline',
           'Amount' => $amount,
           'Msisdn' => $msisdn,
           'BillRefNumber' => $billRef
    );

    $data_string = json_encode($curl_post_data);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
    $curl_response = curl_exec($curl);

    echo $curl_response;
}

