<?php
   require_once '../resources/config.php';
   if(!isset($_SESSION["ID"])) redirect("login.php");
?>
<!DOCTYPE html>
<html lang="en">
  <title>Checkout With Paypal - Complete Order</title>
  <?php require_once(TEMPLATE_FRONT.DS."metadata.php"); ?>
  <?php require_once(TEMPLATE_FRONT.DS."user_nav.php"); ?>
    <!-- Page Content -->
  <body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="px-4 pb-4" id="order_form">
        <h4 class="text-center text-info p-2">*Confirm your order details</h4>
        <div class="jumbotron p-3 mb-2 text-center lead">
            <div class="order_purchase">
              <caption>Order Details</caption><hr>
              <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
              <input type="hidden" name="cmd" value="_cart">
              <input type="hidden" name="business" value="swifftshop@gmail.com">
              <input type="hidden" name="city" value="<?php echo $_GET['county']; ?>">
              <input type="hidden" name="address1" value="<?php echo $_GET['postal_code']; ?>">
              <input type="hidden" name="first_name" value='$_SESSION["Username"]'>
              <input type="hidden" name="tax" value="<?php echo $_SESSION['VAT']; ?>">
              <input type="hidden" name="email" value="<?php echo $_SESSION['Email']; ?>">
              <input type="hidden" name="currency_code" value="USD">
              <input type="hidden" name="upload" value="1">
              <table class="table table-striped table-bordered">
                <tr>
                  <th>Product</th>
                  <th>Photo</th>
                  <th>Piece(s)</th>
                  <th>Price</th>
                </tr>
                      <?php  
                             $delivery_fee = 0;
                             $user_ID = $_SESSION['ID'];
                             $grand_total = 0;
                             $item_quatity = 0;
                             $item_name = 1; 
                             $item_number = 1;
                             $amount = 1;
                             $quantity = 1;

                             $query = query("SELECT * FROM cart WHERE user_ID = '$user_ID'");
                             confirm($query);
                             while($row = fetch_array($query)) {
                               $grand_total += $row['total_price'];
                               $p_id = $row['product_ID'];
                               $product_name = $row["product_name"];
                               $item_quatity = $row['quantity'];
                               $product_photo = $row['product_photo'];
                               $product_size = $row['product_size'];
                               $product_price = number_format($row['total_price']);
                             /*  switch ($item_quatity) {
                                 case '1':
                                   $delivery_fee = 200;
                                   break;
                                 case '2':
                                    $delivery_fee = 190;
                                   break;
                                  case '3':
                                     $delivery_fee = 180;
                                    break;
                                  case '4':
                                     $delivery_fee = 160;
                                    break;
                                    case '5':
                                      $delivery_fee = 150;
                                      break;
                                    case '6':
                                       $delivery_fee = 140;
                                      break;
                                 default:
                                         $delivery_fee = 0;
                                   break;
                               } */

                                 $order_details = <<<DELIMETER
                             <tr>
                                <td>{$product_name}<br>
                                  <small style="color:blue;">Size: {$product_size}</small>
                                </td>
                                <td><img src="../resources/uploads/{$product_photo}" style="width:70px;height:50px;"></td>
                                <td>{$item_quatity}</td>
                                <td><span class="currency">Ksh. </span>{$product_price}</td>
                             </tr>
                                <input type="hidden" name="item_name_{$item_name}" value="{$product_name}">
                                <input type="hidden" name="item_number_{$item_number}" value="{$p_id}">
                                <input type="hidden" name="amount_{$amount}" value="{$row['total_price']}">
                                <input type="hidden" name="quantity_{$quantity}" value="{$item_quatity}">
DELIMETER;
                             echo $order_details;
                             
                             $item_name ++; 
                             $item_number ++;
                             $amount ++;
                             $quantity ++;
                             $logistics = $item_quatity*$delivery_fee;
                             $amount_payable = $grand_total+$logistics+$_SESSION['VAT'];
                             }
                      ?>
              </table>
            </div><hr>
          <h6 class="lead"><b>Delivery Fee: </b><?php if($delivery_fee == 0){echo "<span style='color:green;font-weight:bold;'>Free</span>";}else{echo '<span class="currency">KES </span>'.$logistics;}?></h6>
           <h6 class="lead"><b>VAT: </b><?php echo("KES ".number_format($_SESSION['VAT'],2));?></h6>
          <h5><b>Amont Payable: </b><?= 'KES '.number_format($amount_payable,2);?></h5>
        </div>
            <input type="image" name="upload"
    src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif"
    alt="PayPal - The safer, easier way to pay online">
        </form>
      </div>
    </div>
</div>
  </div>
           <?php require_once(TEMPLATE_FRONT.DS."footer.php"); ?>
</body>
</html>
