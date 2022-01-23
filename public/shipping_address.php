<?php
   require_once '../resources/config.php';
   if(!isset($_SESSION["ID"])) redirect("login.php");
?>
<!DOCTYPE html>
<html lang="en">
  <title>Shipping and Delivery Address | swifftshop.com</title>
  <?php require_once(TEMPLATE_FRONT.DS."metadata.php"); ?>
  <?php require_once(TEMPLATE_FRONT.DS."user_nav.php"); ?>
    <!-- Page Content -->
  <body>
  <div class="container">
  <div class="Jumbotron my-5">
    <h3 class="text-center text-gray">Select Your Shipping Address:</h2>
    <form id="shipping_info">
        <input type="hidden" id="payment_method" value="<?php echo($_GET['payment_method']); ?>">
        <div>
            <label for="county" style="color: var(--primary-color);font-weight: bold">Your County*</label>
              <select id="county" class="form-control">
                <option value="">-Select County-</option>
                <option value="Mombasa">Mombasa</option>
                <option value="Kwale">Kwale</option>
                <option value="Kilifi">Kilifi</option>
                <option value="Tana River">Tana River</option>
                <option value="Lamu">Lamu</option>
                <option value="Taita-Taveta">Taita-Taveta</option>
                <option value="Garissa">Garissa</option>
                <option value="Mandera">Mandera</option>
                <option value="Marsabit">Marsabit</option>
                <option value="Isiolo">Isiolo</option>
                <option value="Meru">Meru</option>
                <option value="Tharaka-Nithi">Tharaka-Nithi</option>
                <option value="Embu">Embu</option>
                <option value="Kitui">Kitui</option>
                <option value="Machakos">Machakos</option>
                <option value="Makueni">Makueni</option>
                <option value="Nyandarua">Nyandarua</option>
                <option value="Nyeri">Nyeri</option>
                <option value="Kirinyaga">Kirinyaga</option>
                <option value="Murang'a">Murang'a</option>
                <option value="Kiambu">Kiambu</option>
                <option value="Turkana">Turkana</option>
                <option value="West Pokot">West Pokot</option>
                <option value="Samburu">Samburu</option>
                <option value="Tranz-Nzoia">Tranz-Nzoia</option>
                <option value="Uasin Gishu">Uasin Gishu</option>
                <option value="Elgeyo-Marakwet">Elgeyo-Marakwet</option>
                <option value="Nandi">Nandi</option>
                <option value="Baringo">Baringo</option>
                <option value="Laikipia">Laikipia</option>
                <option value="Nakuru">Nakuru</option>
                <option value="Narok">Narok</option>
                <option value="Kajiado">Kajiado</option>
                <option value="Kericho">Kericho</option>
                <option value="Bomet">Bomet</option>
                <option value="Kakamega">Kakamega</option>
                <option value="Vihiga">Vihiga</option>
                <option value="Bungoma">Bungoma</option>
                <option value="Busia">Busia</option>
                <option value="Siaya">Siaya</option>
                <option value="Kisumu">Kisumu</option>
                <option value="Homa Bay">Homa Bay</option>
                <option value="Migori">Migori</option>
                <option value="Kisii">Kisii</option>
                <option value="Nyamira">Nyamira</option>
                <option value="Nairobi">Nairobi</option>
              </select>
              <div id="status"></div>
        </div>
         <div>
              <label for="Postal Adress" style="color: var(--primary-color);font-weight: bold">Postal Adress(Optional)</label>
              <input type="text" id="postal_code" placeholder="Postal Adress"  autocomplete="autocomplete" class="form-control">
          </div>
          <div class="form_control">
              <label for="Postal Adress" style="color: var(--primary-color);font-weight: bold">Any other Information</label>
             <textarea class="form-control" rows="5" placeholder="Any other Information We Might Need On Your Order Delivery..." id="AOI"></textarea>
          </div>
            <div class="cont_btn">
              <button>Continue <i class="far fa-arrow-right"></i></button>
            </div>
    </form>
  </div>
</div>
  </div>
<?php require_once(TEMPLATE_FRONT.DS."footer.php"); ?>
</body>
<script type="text/javascript">
  $(document).ready(function(){
  
  $('#shipping_info').submit(function(e){
    e.preventDefault();
    let payment = document.getElementById('payment_method').value;
    let county = document.getElementById('county').value;
    let postal_code = document.getElementById('postal_code').value;
    let AOI = document.getElementById('AOI').value;
    if (county.length == 0) {
        document.getElementById("status").innerHTML = "<span style='color:red'>County Is Required!</span>";
        return false;
    } else{
      document.getElementById("status").innerHTML = "";
     if (payment == "paypal") {
       window.location = "paypal.php?county="+county+"&postal_code="+postal_code+"&AOI="+AOI;
     } else{
       window.location = "mpesa.php?county="+county+"&postal_code="+postal_code+"&AOI="+AOI;
     }
    }
  });
});

</script>
</html>
