<?php
  session_start();
  $connection = mysqli_connect("localhost","swifftsh_ronald","MatekwaRonald37016568","swifftsh_swifftshop");
  function query($sql){
  global $connection;
  return mysqli_query($connection,$sql);
}

function confirm($result){
  global $connection;
  if (!$result) {
    die("QUERY FAILED:" . mysqli_error($connection));
  }
}

function fetch_array($result){
  return mysqli_fetch_array($result);
}

//Order Numbers generator
function order_number_generator($length){
  $result = "";
  $chars = "0123456789";
  $charsArray = str_split($chars);
  for ($i=0; $i < $length; $i++) { 
    $randItem = array_rand($charsArray);
    $result .= $charsArray[$randItem];
  }
  return $result;
}
  ####################################Order processing scripts#################################
   date_default_timezone_set('Africa/Nairobi');
   $mytime = getdate(date("U"));
   $date = "$mytime[weekday], $mytime[month], $mytime[mday], $mytime[year]";
   $time = date('h:i:sa');

if (isset($_POST['action']) && isset($_POST['action']) == "order") {
  $name = $_POST['username'];
  $email = $_POST['order_email'];
  $phone_number = $_POST['phone_number'];
  $address = $_POST['address'];
  $payment_method = "M-PESA";
  $grand_total = $_POST['grand_total'];
  $user_ID = $_SESSION['ID'];
  $tax = $_POST['VAT'];
  $order_number = order_number_generator(6);
  $item_no = $_POST['items'];
  for ($i=1; $i < $item_no; $i++) {
      $p_id = $_POST["item_id_".$i];
      $seller = query("SELECT seller FROM products WHERE ID = '$p_id'");
      confirm($seller);
      while ($row = fetch_array($seller)) {
        $p_seller = $row['seller'];
      }
      $item_name = $_POST["item_name_".$i];
      $item_photo = $_POST["item_photo_".$i];
      $item_quant = $_POST["quantity_".$i];
      $item_size = $_POST["item_size_".$i];
       $initiate_order = query("INSERT INTO orders(order_number,user_id,product_name,seller,product_photo,qty,product_id,user_name,email,phone,delivery_address,payment_method,amount_paid,transaction_status,transaction_code,order_date,order_status,product_review,order_time,tax,product_size) VALUES('$order_number','$user_ID','$item_name','$p_seller','$item_photo','$item_quant','$p_id','$name','$email','$phone_number','$address','$payment_method','Pending','Pending','Pending','$date','Pending','Pending','$time','$tax','$item_size')");
       confirm($initiate_order);
  }
 # access token
  $consumerKey = 'RkGxJyv9afGdLlsLogk3CHXm3WsBrK0d'; //Fill with your app Consumer Key
  $consumerSecret = 'Ku7b9M92xdDKQXGG'; // Fill with your app Secret

  # define the variales
  # provide the following details, this part is found on your test credentials on the developer account
  $BusinessShortCode = '174379';
  $Passkey = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';  
  
  /*
    This are your info, for
    $PartyA should be the ACTUAL clients phone number or your phone number, format 2547********
    $AccountRefference, it maybe invoice number, account number etc on production systems, but for test just put anything
    TransactionDesc can be anything, probably a better description of or the transaction
    $Amount this is the total invoiced amount, Any amount here will be 
    actually deducted from a clients side/your test phone number once the PIN has been entered to authorize the transaction. 
    for developer/test accounts, this money will be reversed automatically by midnight.
  */
  
  $PartyA = $phone_number; // This is your phone number, 
  $AccountReference = $order_number;
  $TransactionDesc = 'Order Payment';
  $Amount = $grand_total;
 
  # Get the timestamp, format YYYYmmddhms -> 20181004151020
  $Timestamp = date('YmdHis');    
  
  # Get the base64 encoded string -> $password. The passkey is the M-PESA Public Key
  $Password = base64_encode($BusinessShortCode.$Passkey.$Timestamp);

  # header for access token
  $headers = ['Content-Type:application/json; charset=utf8'];

    # M-PESA endpoint urls
  $access_token_url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
  $initiate_url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';

  # callback url
  $CallBackURL = 'http://swifftshop.com/Mpesa_APIs/callback_url.php';  

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

  # header for stk push
  $stkheader = ['Content-Type:application/json','Authorization:Bearer '.$access_token];

  # initiating the transaction
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $initiate_url);
  curl_setopt($curl, CURLOPT_HTTPHEADER, $stkheader); //setting custom header

  $curl_post_data = array(
    //Fill in the request parameters with valid values
    'BusinessShortCode' => $BusinessShortCode,
    'Password' => $Password,
    'Timestamp' => $Timestamp,
    'TransactionType' => 'CustomerPayBillOnline',
    'Amount' => $Amount,
    'PartyA' => $PartyA,
    'PartyB' => $BusinessShortCode,
    'PhoneNumber' => $PartyA,
    'CallBackURL' => $CallBackURL,
    'AccountReference' => $AccountReference,
    'TransactionDesc' => $TransactionDesc
  );

  $data_string = json_encode($curl_post_data);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_POST, true);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
  $curl_response = curl_exec($curl);
  print_r($curl_response);
  echo $curl_response;
}
################################XX####Order processing scripts########XX#########################