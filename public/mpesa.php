  <?php
       require_once '../resources/config.php';
       if(!isset($_SESSION["ID"])) redirect("login.php");
       if ($_SESSION['pay_price'] == 0) {
          redirect("index.php");
       }
    ?>
 <!DOCTYPE html>
<html lang="en">
  <head>
   
    <title>Checkout with M-Pesa - Complete your order with M-PESA</title>
  <?php require_once(TEMPLATE_FRONT.DS."metadata.php"); ?>
  <?php require_once(TEMPLATE_FRONT.DS."user_nav.php"); ?>
    <!-- Page Content -->
    <style type="text/css">
      #error-msg{color: #ea4335;}
      #valid-msg{color: #34a853;}
    </style>
  </head>
  
  <body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="px-4 pb-4" id="order_form">
        <h4 class="text-center text-info p-2">*Confirm your order details.</h4>
        <div class="jumbotron p-3 mb-2 text-center">
          <form action="" method="POST" id="placeOrder">
                <div class="lead order_purchase">
                    <caption>Order Details</caption><hr>
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
                                     $allItems = '';
                                     $item_quatity = 0;
                                    
                                     $item_name = 1; 
                                     $item_id = 1;
                                     $amount = 1;
                                     $quantity = 1;
                                     $item_size = 1;
                                     $item_photo = 1;

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
                                        <input type="hidden" name="item_id_{$item_id}" value="{$p_id}">
                                        <input type="hidden" name="amount_{$amount}" value="{$row['total_price']}">
                                        <input type="hidden" name="quantity_{$quantity}" value="{$item_quatity}">
                                        <input type="hidden" name="item_size_{$item_size}" value="{$product_size}">
                                        <input type="hidden" name="item_photo_{$item_photo}" value="{$product_photo}">
DELIMETER;

                                     $item_name++; 
                                     $item_id++;
                                     $amount++;
                                     $quantity++;
                                     $item_size++;
                                     $item_photo++;

                                     echo $order_details;
                                     }
                                    $logistics = $item_quatity*$delivery_fee;
                                    $amount_payable = $grand_total + $logistics + $_SESSION['VAT'];
                              ?>
                      </table>
                </div><hr>
    
              <h6 class="lead"><b>Delivery Fee: </b><?php if($delivery_fee == 0){echo "<span style='color:green;font-weight:bold;'>Free</span>";}else{echo '<span class="currency">KES </span>'.$logistics;}?></h6>
              <h6 class="lead"><b>VAT: </b><?php echo("KES ".number_format($_SESSION['VAT'],2));?></h6>
              <h5><b>Amont Payable: </b><?= 'KES '.number_format($amount_payable,2);?></h5>
            </div>
            
              <input type="hidden" name="grand_total" value="<?= $amount_payable;?>">
              <input type="hidden" name="items" value="<?php echo $item_size; ?>">
              <input type="hidden" name="username" id="username" value="<?php echo $_SESSION['Username']; ?>">
              <input type="hidden" name="order_email" value="<?php echo $_SESSION['Email']; ?>">
              <input type="hidden" name="VAT" value="<?php echo $_SESSION['VAT']; ?>">
              <input type="hidden" name="address" value="<?php echo $_GET['county'].",".$_GET['postal_code'].",".$_GET['AOI']; ?>">

                <div class="form-group text-center">
                <input type="tel" name="phone_number" required="required" id="phone" onkeyup="clear_warning()"><br>
                 <span id="warning" class="text-center" style="color: red;"></span>
                <span id="error-msg" class="hide"></span>
                <span id="valid-msg" class="hide"><i class="fas fa-check-circle"></i>&nbsp;Valid</span>
              </div>

               <div id="orderBtn" class="form-group text-center">
                  <input type="submit" id="btn" name="submit" value="Place Order" class="btn btn-success" style="background:var(--primary-color);border: 1px solid white;">
               </div>

            
              <!-----------------Modal------------------------------------>
              <div class="payment-processing-modal" style="display: none;">
                  <div class="payment-processing-bg"></div>
                  <div class="payment-processing-content">
                    <div class="mpesa_image text-center" style="margin: 20px auto;">Please Wait</div><hr>
                     <div class="spiner"></div>
                     <div id="processing_text" class="text-center"><p>Sending...</p></div>
                  </div>
              </div>

        </form>
      </div>
    </div>
</div>
</div>
<?php require_once(TEMPLATE_FRONT.DS."footer.php"); ?>
 
 <script type="text/javascript">
   let input = document.querySelector("#phone");
   let errMsg = document.querySelector("#error-msg");
   let validMsg = document.querySelector("#valid-msg");
   let btn =  document.querySelector("#btn");

        //Error message based on the code returned from getValidationError
        var ErrorMap = ["Invalid Number!","Invalid Country Code!","Number too Short!","Number Too Long!"];
        var intl = window.intlTelInput(input, {
          initialCountry: "auto",
          geoIpLookup: function(success,failure) {
            $.get("https://ipinfo.io", function () {},"jsonp").always(function(resp){
              var countryCode = (resp && resp.country) ? resp.country : "KE";
              success(countryCode);
            });
          },
          utilsScript:"js/utils.js"
        });
  var reset = function(){
    input.classList.remove("error");
    errMsg.innerHTML = "";
    errMsg.classList.add("hide");
    validMsg.classList.add("hide");
  }

  //Validate on blur
  input.addEventListener('keyup',function(){
    reset();
    if (input.value.trim()) {
      if(intl.isValidNumber()){
          validMsg.classList.remove("hide");
          btn.classList.remove("hide");
      } else{
         input.classList.add("error");
         var errorCode = intl.getValidationError();
         errMsg.innerHTML = ErrorMap[errorCode];
         errMsg.classList.remove("hide");
         btn.classList.add("hide");
      }
    }
  });
  ////Reset on keyup/change event
input.addEventListener("change",reset);
input.addEventListener("blur",reset);
 </script>
<script>

  function clear_warning(){
    document.getElementById("warning").innerHTML = "";
  }
//////////////////////////////////////////Order processing Scripts///////////////////////////
$(document).ready(function(){
  
  $('#placeOrder').submit(function(e){
    e.preventDefault();
    let number = document.getElementById('phone').value;
    let res = number.replace(/[^0-9]/g,"");
    let username = document.getElementById('username').value
    if (res == "") {
      document.getElementById('warning').innerHTML = "Your Phone number is necessary!";
    } else{
    //Open Processing Modal
         $('.payment-processing-modal').fadeIn()
         $.ajax({
      url:'../resources/orderprocess.php',
      method:'post',
      data:$('form').serialize()+"&action=order&phone_number="+res,
      success:function(data) {
       $(".payment-processing-modal").fadeOut();
       if(data == 'success'){
          window.scrollTo(0,0);
          document.getElementById('order_form').innerHTML = '<div class="jumbotron text-center"><img src="../resources/uploads/brand_logos/confirmation.PNG"></img><p>Hello <span style="font-weight:bold;">'+username+'</span> Thanks a lot for placing an order with us. You`ve picked an amazing product. We`ll contact you shortly via the phone number <span style="font-weight:bold; color:green">'+res+'</span>  on how you gonna make your order payments. <br>We`d love to hear your thoughts once you`ve got your hands on it! <br> Thanks once again! <br><br> <span style="font-style:italic">-Swifftshop Team</span></p><a href="index.php">Continue Shopping</a></div>';
       } else{
          window.scrollTo(0,0);
          document.getElementById('order_form').innerHTML = '<div class="jumbotron text-center"><img src="../resources/uploads/brand_logos/error.PNG" width="200px"></img><p>Oops! Your order was usuccessful! Please try again.<br><br><a href="cart_page.php">Try again</a></p></div';
       }
      }
     
    });
     }
  });
});
///////////////////////////////XX///////////Order processing Scripts/////////XX//////////////
</script>
</body>
</html>
