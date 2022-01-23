<?php 
    require_once '../resources/config.php';
     if(!isset($_SESSION["ID"])) redirect("login.php");
?>
<!DOCTYPE html>
<html lang="en">
  <title>Blisshop.com</title>
  <?php require_once(TEMPLATE_FRONT.DS."metadata.php"); ?>
    <!-- Page Content -->
  <body>
      <?php require_once(TEMPLATE_FRONT.DS."user_nav.php"); ?>
  <div class="small-container cart-page" id="cart_content">
    <h2 class="text-center">Shopping Cart</h2>
    <div id="message"></div>
    <?php display_message(); ?>
      <table>
          <tr>
            <th>Product</th>
            <th>Quantity</th>
            <th>Subtotal</th>
          </tr>
           <?php cart() ?>
      </table>
      <div class="total-price">
        <table>
          <tr>
            <td><b>Sub-total</b></td>
             <td>
               Ksh.
                <?php
                    echo  isset($_SESSION['pay_price']) ? number_format($_SESSION['pay_price'],2) : $_SESSION['pay_price'] = 0;
                 ?>
             </td>
          </tr>
          <tr>
            <td><b>VAT</b></td>
             <td>Ksh. <?php echo isset($_SESSION['VAT']) ? number_format($_SESSION['VAT'],2) : $_SESSION['VAT'] = 0; ?></td>
          </tr>
          <tr>
            <td><b>Total</b></td>
             <td>Ksh. <?php echo isset($_SESSION['total_with_vat']) ? number_format($_SESSION['total_with_vat'],2) : $_SESSION['total_with_vat'] = 0; ?></td>
          </tr>
        </table>
      </div><br>
          <div class="paymentMethod">
                  <h6 class="text-center lead">Select Payment Method</h6><br>
              <div class="form-group text-center">
                <label class="radio-inline"><input type="radio" name="payment_method" value="M-pesa" id="mpesa" required="required">&nbsp;&nbsp;<img src="../resources/uploads/mpesa.png"></label>&nbsp;&nbsp;&nbsp;&nbsp;
                <label class="radio-inline"><input type="radio" name="payment_method" value="PayPal" id="paypal" required="required" disabled="disabled">&nbsp;&nbsp;<img src="../resources/uploads/paypal.PNG"></label>
                <!--<label class="radio-inline"><input type="radio" name="payment_method" value="Credit-Card" id="credit_card" required="required" disabled="disabled">&nbsp;<img src="../resources/uploads/visa.PNG"></label>-->
                <div id="msg"></div>
              </div>
          </div>
      <div class="checkout_btn">
       <?php echo proceed_to_checkout_btn(); ?>
      </div>
  </div>
           <?php require_once(TEMPLATE_FRONT.DS."footer.php"); ?>
</body>
<script type="text/javascript">
  function verify_payment_method() {
    if (document.getElementById("paypal").checked == true) {
        window.location = "shipping_address.php?payment_method=paypal";
    } else if (document.getElementById("mpesa").checked == true) {
       window.location = "shipping_address.php?payment_method=mpesa";
   } else{
      document.getElementById("msg").innerHTML = "<p style='color:red;'>Select Payment Method!</p>";
   }
  }
</script>
</html>
