<?php 
	require_once 'config.php';
?>
<?php 

	if (isset($_GET['delete'])){
		$user_id = $_SESSION['ID'];
		$query = query("DELETE FROM wishlist WHERE user_id=$user_id AND product_id=".escape_string($_GET['delete']));
		confirm($query);
		set_message("<h6 class='alert alert-success text-center'>Removed from wishlist successfully!</h6>");
		redirect("../public/wishlistpage.php");
	}

	function wishlist(){
			$user_id = $_SESSION["ID"];
			$query = query("SELECT * FROM wishlist WHERE user_id = $user_id");
			confirm($query);
			$result = get_row($query);
			if ($result == 0) {
			echo "<div class='text-center' style='color:green;font-weight:bold'>Currently you do not have any product(s) in your Wishlist :( </div></br> <div class='go_shopping_btn'><a href='index.php'>Go Shopping</a></div>";
			} else{
			while ($row = fetch_array($query)) {
			$product_id = $row["product_ID"];
			$query2 = query("SELECT * FROM products WHERE ID = $product_id");
			while ($row2 = fetch_array($query2)) {
				$product_title = $row2['Title'];
				$product_price = $row2['Price'];
				$product_photo = display_photo($row2['product_image']);
				$product_quantity = $row2['Product_quantity'];
				if($product_quantity > 10){
					$quantity = "<span style='color:green;'>In stock</span>";
				} else{
					$quantity = $product_quantity .' remaining';
				}
				$product = <<<DELEMETER
				<tr>
            <td>
              <div class="cart-info">
                  <img src="{$product_photo}" alt="{$product_title}"></a>
                  <div>
                    <p><strong>{$product_title}</strong></p>
                    <small>Price: Ksh {$product_price}</small><br>
                    <a href="../resources/wishlist.php?delete={$row2['ID']}">Remove</a>
                  </div>
              </div>
            </td>
             <td>Ksh {$product_price}</td>
              <td>{$quantity}</td>
              <td><button class="btn btn-info mx-3" onclick="add_wish_to_cart({$row2['ID']})"><span><i class="fa fa-shopping-cart" style="color:#fff;"></i></span></button>
				</td>
          </tr>
DELEMETER;
				echo $product;
			}
		}
	}
}
?>