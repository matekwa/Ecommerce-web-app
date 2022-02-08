<?php
session_start();
$connection = mysqli_connect("localhost","root","","swiftshop");
    function last_id()
{
  global $connection;
  return mysqli_insert_id($connection);
}
function redirect($location)
{
  header("location:$location");
}

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

function get_row($check){
  return mysqli_num_rows($check);
}

function escape_string($string)
{
  global $connection;
  return mysqli_real_escape_string($connection,$string);
}

function fetch_array($result){
  return mysqli_fetch_array($result);
}
//Randome String generator
function randomStringGenerator($length){
  $result = "";
  $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
  $charsArray = str_split($chars);
  for ($i=0; $i < $length; $i++) { 
    $randItem = array_rand($charsArray);
    $result .= $charsArray[$randItem];
  }
  return $result;
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
  //$account_no = $_POST['acc_no'];
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
       $initiate_order = query("INSERT INTO orders(order_number,user_id,product_name,seller,product_photo,qty,product_id,user_name,email,phone,delivery_address,payment_method,amount_to_pay,order_date,order_status,product_review,order_time,tax,product_size) VALUES('$order_number','$user_ID','$item_name','$p_seller','$item_photo','$item_quant','$p_id','$name','$email','$phone_number','$address','$payment_method','$grand_total','$date','1','0','$time','$tax','$item_size')");
       confirm($initiate_order);
  }
  $to = 'matekwaronald@gmail.com';
  $from = '$email';
  $subject = "New Order!";
  $message = '<!DOCTYPE html><html><head><meta charset="UTF-8"><title>New Order</title></head><body style="margin:0px; font-family:Tahoma, Geneva, sans-serif;"><div style="padding:20px; background:#45ccb8; font-size:30px; color:yellow;">New Order!</div><div style="padding:24px; font-size:17px; font-family:sans-serif;">Hello Ronald!<br/><br />New Order From '.$name.':<br /><br /><br>Order No:#'.$order_number.'<br> Shipping Address:'.$address.' <br>Phone Number:'.$phone_number.'<br/><br /></div></body></html>
';
  $headers = 'From: $from\n';
  $headers .= 'Content-Type: text/html; charset = iso-8859-1\n';
  $mail = mail($to, $subject, $message, $headers);
  if ($mail) {
     echo "success";
       $id = query("SELECT product_ID FROM orders WHERE user_ID = '$user_ID'");
       confirm($id);
       $exist = get_row($id);
       if ($exist >= 1) {
          while ($pID = fetch_array($id)) {
         $productID = $pID["product_ID"];
       }
         $empty_cart = query("DELETE FROM cart WHERE product_ID = '$productID' AND user_ID = '$user_ID'");
        confirm($empty_cart);
       } 
      $_SESSION["VAT"] = 0; 
      $_SESSION["pay_price"] = 0;
      $_SESSION["total_with_vat"] = 0;
  } else {
    echo "0";
    exit();
  } 
    echo "success";
    $id = query("SELECT product_ID FROM orders WHERE user_ID = '$user_ID'");
       confirm($id);
       $exist = get_row($id);
       if ($exist >= 1) {
          while ($pID = fetch_array($id)) {
         $productID = $pID["product_ID"];
      
         $empty_cart = query("DELETE FROM cart WHERE product_ID = '$productID' AND user_ID = '$user_ID'");
        confirm($empty_cart);
       } 
      $_SESSION["VAT"] = 0; 
      $_SESSION["pay_price"] = 0;
      $_SESSION["total_with_vat"] = 0;
    }
}
 