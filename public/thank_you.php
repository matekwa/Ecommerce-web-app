<?php 
    require_once '../resources/config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>SwiftShop.com</title>
   <?php require_once(TEMPLATE_FRONT.DS."metadata.php"); ?>
</head>
<body>
<?php require_once(TEMPLATE_FRONT.DS."user_nav.php"); ?>
    <!-- Page Content -->
<div class="container">
      <div class="jumbotron text-center thank_you_page">
            <div class="ok_gif">
              <img src="../resources/uploads/order_check.PNG" width="100px">
            </div><br>
            <span style="color: green; font-weight: 600;">Your Order Was Placed Successfully!</span>
            <table class="table table-bordered table-striped">s
              <tr>
                <td><strong>Product(s) Purchased</strong></td>
                <td><strong>Piece(s)</strong></td>
                <td><strong>Order Date</strong></td>
              </tr>
   <?php
      if (isset($_GET['complete'])) {
          $ref_no = $_GET["ref_no"];
          $user_id = $_SESSION["ID"];
          $query = query("SELECT * FROM orders WHERE user_id ='$user_id' AND order_status = 1 AND transaction_code = '$ref_no'");
          confirm($query);
          while ($row = fetch_array($query)) {
              $order_number = $row['order_number'];
              $product_name = $row['product_name'];
              $product_qty = $row['qty'];
              $email = $row['email'];
              $phone = $row['phone'];
              $delivery_address = $row['delivery_address'];
              $payment_method = $row['payment_method'];
              $amount_paid = number_format($row['amount_paid'],2);
              $order_date = $row['order_date'];

              $order = <<<DELIMETER
                <tr>
                    <td class="text-success">{$product_name}</td>
                    <td>{$product_qty}</td>
                    <td>{$order_date}</td>
                </tr>
DELIMETER;
echo $order;
          }
      } else{
        redirect("../public/checkout.php");
      }
   ?>
   </table> <hr>
      <div class="customer_details">
        <h5>Order Details:</h5><hr>
           <h6 class="lead">Amount paid: <span class="currency">KES </span><?php echo($amount_paid); ?></h6>
          <p class="lead">Payment Method: <?php echo($payment_method); ?></p>
          <p class="lead" >Phone Number: <?php echo($phone); ?></p>
          <p class="lead" >E-mail: <?php echo($email); ?></p>
          <p class="lead" >Deliver Address: <?php echo($delivery_address); ?></p>
          <p class="lead" >Order NO: #<?php echo($order_number); ?></p>
      </div>
      <a href="www.swifftshop.com/index.pp"></a>
   </div>
</div>
<?php require_once(TEMPLATE_FRONT.DS."footer.php"); ?>
</body>
</html>