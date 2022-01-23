<?php 
    require_once '../resources/config.php';
    require_once '../resources/wishlist.php';
     if(!isset($_SESSION["ID"])) redirect("login.php");
?>
<!DOCTYPE html>
<html lang="en">
  <title>My Wishlist - swifftshop.com</title>
  <?php require_once(TEMPLATE_FRONT.DS."metadata.php"); ?>
  <?php require_once(TEMPLATE_FRONT.DS."user_nav.php"); ?>
    <!-- Page Content -->
   <div class="small-container cart-page" id="cart_content">
    <h2 class="text-center" style="font-family: abel;">Wish List</h2>
    <div id="message"></div>
      <table>
          <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Availability</th>
            <th>Action</th>
          </tr>
           <?php wishlist(); ?>
      </table>
  </div>
        <footer>
           <?php require_once(TEMPLATE_FRONT.DS."footer.php"); ?>
        </footer>
</body>
</html>
