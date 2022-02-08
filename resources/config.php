<?php
ob_start ();
session_start();
//Set a separator for all file paths
defined("DS") ? null : define("DS",DIRECTORY_SEPARATOR);

defined("TEMPLATE_FRONT") ? null : define("TEMPLATE_FRONT",__DIR__.DS."templates/front");

defined("TEMPLATE_BACK") ? null : define("TEMPLATE_BACK",__DIR__.DS."templates/back");

defined("UPLOAD_DIRECTORY") ? null : define("UPLOAD_DIRECTORY",__DIR__.DS."uploads");

defined("UPLOAD_PP") ? null : define("UPLOAD_PP",__DIR__.DS."uploads/profile_pictures");

defined("UPLOAD_LOGO") ? null : define("UPLOAD_LOGO",__DIR__.DS."uploads/brand_logos");
//Defining database path
defined("DB_HOST") ? null : define("DB_HOST","localhost");
defined("DB_USER") ? null : define("DB_USER","root");
defined("DB_PASSWORD") ? null : define("DB_PASSWORD","");
defined("DB_NAME") ? null : define("DB_NAME","swiftshop");

$connection = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
date_default_timezone_set('Africa/Nairobi');
$mytime = getdate(date("U"));
$date = "$mytime[weekday], $mytime[month], $mytime[mday], $mytime[year]";


require_once ('functions.php');
require_once ('cart.php');
if (isset($_SESSION["ID"])) {
	$user_id = $_SESSION["ID"];
	$query = query("SELECT * FROM cart WHERE user_ID='$user_id'");
	confirm($query);
	$cart_items = get_row($query);
	if ($cart_items > 0) {
		$_SESSION['cart_items'] = $cart_items;
	} else{
		$_SESSION['cart_items'] = $cart_items;
	}
}

	