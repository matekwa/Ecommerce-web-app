<?php
	header("Content-Type:application/json");

	$response = '{
		"ResultCode":0;
		"ResultDesc":"Confirmation received successfully"
	}';
	//Data
	$mpesaResponse = file_get_contents("php://input");

	//Log into file
	$logFile = "M_PESAValidation.txt";
	$jsonMpesaResponse = json_encode($mpesaResponse,true);
	//Write to file
	$log = fopen($logFile, "a");
	fwrite($log, $mpesaResponse);
	fclose($log);

	echo $response;
?>