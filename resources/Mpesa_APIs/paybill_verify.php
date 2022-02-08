<?php
    require_once '../config.php';
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
  $account_no = $_POST['acc_no'];
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
 