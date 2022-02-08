<?php

  /* access token */
  $consumerKey = 'RkGxJyv9afGdLlsLogk3CHXm3WsBrK0d';                # Fill with your app Consumer Key
  $consumerSecret = 'Ku7b9M92xdDKQXGG';             # Fill with your app Secret
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

  /* variables from Test Credentials on your developer account */
  $Initiator = '';                    # Initiator Name (Shortcode 1)
  $SecurityCredential = '';           # SBase64 encoded string of the Security Credential, which is encrypted using M-Pesa public key
  $CommandID = 'BusinessPayBill';                    # possible values are: BusinessPayBill, MerchantToMerchantTransfer, MerchantTransferFromMerchantToWorking, MerchantServicesMMFAccountTransfer, AgencyFloatAdvance
  $SenderIdentifierType = '4';        # Type of organization sending the transaction.
  $Amount = '';
  $PartyA = '';                       # Shortcode 1
  $PartyB = '';                       # Shortcode 2
  $AccountReference = 'BILL PAYMENT';             # Account Reference mandatory for “BusinessPaybill” CommandID.
  $Remarks = 'swifftshop Funds';                      # Anything Goes here/string/int/varchar
  $QueueTimeOutURL = 'http://swifftshop.com/Mpesa_APIs/B2BResultURL.php';              # QueueTimeOutURL
  $ResultURL = 'http://swifftshop.com/Mpesa_APIs/B2BResultURL.php';                    # ResultURL
  $b2bHeader = ['Content-Type:application/json','Authorization:Bearer '.$access_token];

  /* Main B2B API Call Section */
  $b2b_url = 'https://sandbox.safaricom.co.ke/mpesa/b2b/v1/paymentrequest';
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $b2b_url);
  curl_setopt($curl, CURLOPT_HTTPHEADER, $b2bHeader); //setting custom header

  $curl_post_data = array(
    //Fill in the request parameters with valid values
    'Initiator' => $Initiator,
    'SecurityCredential' => $SecurityCredential,
    'CommandID' => $CommandID,
    'SenderIdentifierType' => $SenderIdentifierType,
    'RecieverIdentifierType' => $SenderIdentifierType,
    'Amount' => $Amount,
    'PartyA' => $PartyA,
    'PartyB' => $PartyB,
    'AccountReference' => $AccountReference,
    'Remarks' => $Remarks,
    'QueueTimeOutURL' => $QueueTimeOutURL,
    'ResultURL' => $ResultURL
  );

  $data_string = json_encode($curl_post_data);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_POST, true);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
  $curl_response = curl_exec($curl);
  print_r($curl_response);
  echo $curl_response;
?>
