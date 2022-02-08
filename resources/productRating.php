<?php
session_start();
$conn = mysqli_connect("localhost","root","","swiftshop");
function query($sql){
	global $conn;
	return mysqli_query($conn,$sql);
}

function confirm($result){
	global $conn;
	if (!$result) {
		die("QUERY FAILED:" . mysqli_error($conn));
	}
}

function escape_string($string)
{
	global $conn;
	return mysqli_real_escape_string($conn,$string);
}
function get_row($check){
	return mysqli_num_rows($check);
}
function fetch_array($result){
	return mysqli_fetch_array($result);
}
$POST = filter_var_array($_POST,FILTER_SANITIZE_STRING);
$POST = filter_var_array($_POST,FILTER_SANITIZE_NUMBER_INT);
if (isset($POST['starRate'])) {
	$starRate = escape_string($POST['starRate']);
	$user_message = escape_string($POST['user_message']);
	$user_name = escape_string($POST['user_name']);
	$date_review = escape_string($POST['date']);
	$product_id = escape_string($POST['productId']);
	$user_id = $_SESSION["ID"];

	$query = query("SELECT ID FROM product_rating WHERE product_id = '$product_id' AND user_id = '$user_id'");
	confirm($query);
	$row_exist = get_row($query);
	if ($row_exist == 0) {
		$insert =query("INSERT INTO product_rating(product_id,user_id,user_name,user_message,date_reviewed,user_rate) VALUES('{$product_id}','{$user_id}','{$user_name}','{$user_message}','$date_review','{$starRate}')");
		confirm($insert);
		$product_review = query("UPDATE orders SET product_review = 1 WHERE user_id = '$user_id' AND product_id = '$product_id'");
		confirm($product_review);
		echo('sc');
	} else{
		$update = query("UPDATE product_rating SET user_message='$user_message',date_reviewed='$date_review',user_rate='$starRate' WHERE user_id = '$user_id' AND product_id = '$product_id' LIMIT 1");
		confirm($update);
		echo("updated");
	}

	$query2 = query("SELECT * FROM products WHERE ID = '$product_id' ");
	confirm($query2);
	while($row1 = fetch_array($query2)){
		$query3 = query(SELECT * FROM orders WHERE product_id = '$product_id' AND user_id = '$user_id');
		while($row2 = fetch_array($query3)){
			$qty = $row2['qty'];
		}
		$new_qty_sold = $row1['quant_sold'] + $qty;
		$new_qty_stock = ($row1['Product_quantity'])-($new_qty_sold);

		$query3 = query("UPDATE products SET Product_quantity = '$new_qty_stock',quant_sold = '$new_qty_sold' WHERE ID = '$product_id'");
		confirm($query3);
	}
}
?>