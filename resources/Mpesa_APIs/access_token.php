  <?php
  $url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
  
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $url);
  $credentials = base64_encode('RkGxJyv9afGdLlsLogk3CHXm3WsBrK0d:Ku7b9M92xdDKQXGG');
  curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Basic '.$credentials)); //setting a custom header
  curl_setopt($curl, CURLOPT_HEADER, false);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
  
  $curl_response = curl_exec($curl);
  
  $access_token = json_decode($curl_response)->access_token;
  echo $access_token;
  
  ?>