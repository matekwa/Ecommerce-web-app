<?php 
	require_once 'config.php';
?>

<?php
if (isset($_POST['value'])){
		$qty = $_POST["value"];
		$product_id = escape_string($_POST['product_id']);
		$user_id = $_SESSION["ID"];
		$query = query("SELECT * FROM products WHERE ID= '$product_id'");
		confirm($query);
		while ($row = fetch_array($query)){
			if ($qty > ($row['Product_quantity'])) {
				set_message("<div style='color:white;font-weight:600; background:red;width:350px;margin:2px auto;' class='text-center'>We only have ".$row['Product_quantity']." {$row['Title']}(s) available in stock!</div>");
				exit();
			} else {
				$product_name = $row['Title'];
				$product_price =  $row['Price'];
				$new_quantity = $qty;
				$new_total_price = $product_price*$new_quantity;
				$query3 = query("UPDATE cart SET quantity = '$new_quantity', total_price = '$new_total_price' WHERE product_ID='$product_id' AND user_ID='$user_id' LIMIT 1");
    			confirm($query3);
			}
		}
}


	if (isset($_GET['delete'])) {
		$user_id = $_SESSION["ID"];
		$product_id = $_GET['delete'];
		$_SESSION['product_'.$_GET['delete']] = 0;
		$_SESSION['item_quantity'] -=1;
		$query = query("DELETE FROM cart WHERE product_ID='$product_id' AND user_ID='$user_id' LIMIT 1");
    	confirm($query);
    	$_SESSION["pay_price"] = 0;
    	$_SESSION["VAT"] = 0;
		$_SESSION["total_with_vat"] = 0;
    	set_message("<div class='alert alert-danger text-center'> <a href=''#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>Successfully</strong> deleted from cart.</div>");
		redirect("../public/cart_page.php");
	}

	function cart(){
	$user_id = $_SESSION["ID"];
	$total = 0;
	$quantity = 0;
	$vat_tax = 13;
	$query = query("SELECT * FROM cart WHERE user_ID='$user_id'");
	confirm($query);
	$result = get_row($query);
	if ($result > 0) {
		while ($row = fetch_array($query)) {
		$product_id    = $row['product_ID'];
		$product_name  = $row['product_name'];
		$product_size  = $row['product_size'];
		$product_quantity  = $quantity +=  $row['quantity'];
		$_SESSION["VAT"] = $vat_tax * $product_quantity;
		$product_price = number_format($row['price'],2);
		$total_price = $row['total_price'];
		$_SESSION["pay_price"] = $total += $total_price;
		$_SESSION["total_with_vat"] = $_SESSION["pay_price"] + $_SESSION["VAT"];
		$price_converted = number_format($total_price,2);
		$query2 = query("SELECT * FROM products WHERE ID='$product_id'");
		confirm($query2);
		while ($row2 = fetch_array($query2)) {
			$product_photo = display_photo($row2['product_image']);
			$cID = $row2['category_ID'];
		}
		$product =<<<DELIMETER
		<tr>
      <td>
        <div class="cart-info">
            <a href="single_product.php?id={$product_id}&c_id=$cID"><img src="{$product_photo}" title="Edit"></a>
            <div>
              <p><strong>{$product_name}</strong></p>
              <small><strong>Size:</strong> {$product_size}</small><br>
              <small>Price: Ksh {$product_price}</small><br>
              <a href="../resources/cart.php?delete={$product_id}">Remove</a>
            </div>
        </div>
      </td>
       <td><input type="number" value="{$row['quantity']}" id="$product_id" onchange="change_quantity($product_id)"></td>
        <td>Ksh {$price_converted}</td>
    </tr>
DELIMETER;
echo $product;
		}
} else{
			echo "<div class='text-center' style='color:green;font-weight:bold'>Your cart is Empty.</div></br>";
}
}

	function proceed_to_checkout_btn()
	{
		if (isset($_SESSION['pay_price']) && $_SESSION['pay_price'] >= 1){
			return <<<DELIMETER
		 <a onclick="verify_payment_method()"><i class="far fa-credit-card"></i>&nbsp;Proceed to checkout</a>
		DELIMETER;
		}
	}

?>