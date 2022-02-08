<?php
require_once("../config.php");
  $mpesaResponse = file_get_contents("php://input");

$user_id = $_SESSION['ID'];
$arr = json_decode($mpesaResponse,true);
$result_code = $arr["Body"]["stkCallback"]["ResultCode"];
$amount = $arr["Body"]["stkCallback"]["CallbackMetadata"]["Item"][0]["Value"];
$receipt_number = $arr["Body"]["stkCallback"]["CallbackMetadata"]["Item"][1]["Value"];
$transaction_date = $arr["Body"]["stkCallback"]["CallbackMetadata"]["Item"][3]["Value"];
$phone_number = $arr["Body"]["stkCallback"]["CallbackMetadata"]["Item"][4]["Value"];

if ($result_code == 0) {
	 $complete_order = query("UPDATE orders SET transaction_date='$transaction_date',amount_paid = '$amount',transaction_status = '$result_code',transaction_code='$receipt_number',order_status = 1,preview_status = 0 WHERE phone = '$phone_number' AND user_id='$user_id' LIMIT 1");
 	if(!$complete_order){
			$logFile = "Mpesa_responses.json";
			//Write to file
			$log = fopen($logFile, "a");
			fwrite($log, $mpesaResponse);
			fclose($log);
 	} else {
 	////Get products from orders table to delete them from cart table and wishlist and update stock quantity
 	$query = query("SELECT * FROM orders WHERE user_id = '$user_id'");
 	confirm($query);
 	while ($row = fetch_array($query)){
 		$p_quantity = $row['qty'];
 		$p_id = $row['product_id'];
 		/////////Get product from All products table
 		$product = query("SELECT * FROM products WHERE ID = '$p_id'");
 		confirm($product);
 		while ($row2 = fetch_array($product)) {
 			$stock = $row2['Product_quantity'];
 			$quant_sold += $row2['quant_sold'];
 			$new_stock = ($stock) - ($quant_sold);

 			$update_stock = query("UPDATE products set Product_quantity = '$new_stock',quant_sold = '$quant_sold'");
 			confirm($update_stock);
 		}
 		////XXXXX//Get products from orders table to delete the from cart table and wishlist and update stock quantity//XXXXXXXXX/
 		$clear_cart = query("DELETE * FROM cart WHERE product_ID = '$p_id' AND user_ID = '$user_id'");
 		confirm($clear_cart);
 		$clear_wishlist = query("DELETE * FROM wishlist WHERE product_ID = '$p_id' AND user_id = '$user_id'");
 		confirm($clear_wishlist);
 	}
 	redirect("http://swifftshop.com/thank_you.php?completed&ref_no=$receipt_number");
 			}
} else{
	redirect("http://swifftshop.com/Error.php?unfinished");
}
?>