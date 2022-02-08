<?php
require_once '../../config.php';

if (isset($_GET['id'])) {
	$product_ID = $_GET['id'];
	$delete_image = query("SELECT product_image,sub_image_1,sub_image_2,sub_image_3 FROM products WHERE ID=".escape_string($_GET['id'])."");
	confirm($delete_image);
	$img = get_row($delete_image);
	if ($mg == 0) {
		echo("Product Pictures don't exist!").
	} else{
	$row = fetch_array($delete_image);
	$target = UPLOAD_DIRECTORY.DS.$row['slide_image'];
	unlink($target);
	$query = query("DELETE FROM products WHERE ID=".escape_string($_GET['id'])."");
	confirm($query);
	$check_newarrivals = query("SELECT * FROM newarrivals WHERE Product_ID='$product_ID'");
	confirm($check_newarrivals);
	$check_features = query("SELECT * FROM features WHERE Product_ID='$product_ID'");
	confirm($check_features);
	$check_trending = query("SELECT * FROM trending_products WHERE product_ID='$product_ID'");
	confirm($check_trending);
	$check_partner_products = query("SELECT * FROM partnered_products WHERE product_ID='$product_ID'");
	confirm($check_partner_products);
	if (get_row($check_newarrivals) => 1) {
		$delete_newarrival = query("DELETE FROM newarrivals WHERE Product_ID='$product_ID");
		confirm($delete_newarrival);
	} elseif (get_row($check_features) => 1 ) {
		$delete_feature = query("DELETE FROM features WHERE Product_ID='$product_ID");
		confirm($delete_feature);
	} elseif (get_row($check_trending) => 1) {
		$delete_trending = query("DELETE FROM trending_products WHERE product_ID='$product_ID");
		confirm($delete_trending);
	} elseif (get_row($check_partner_products) => 1 ) {
		$delete_partnered = query("DELETE FROM partnered_products WHERE product_ID='$product_ID");
		confirm($delete_partnered);
	}
	set_message("<h4 class='alert alert-success'>Product deleted successfully!</h4>");
	redirect("../../../public/admin/index.php?products");
} else{
	redirect("../../../public/admin/index.php?products");
}
}
?>