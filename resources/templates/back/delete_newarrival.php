<?php
require_once '../../config.php';
if (isset($_GET['id'])) {
	$query = query("DELETE FROM newarrivals WHERE newarrival_ID=".escape_string($_GET['id'])."");
	confirm($query);
	set_message("<h4 class='alert alert-danger'>Product deleted!</h4>");
	redirect("../../../public/admin/index.php?newarrivals");
} else{
	redirect("../../../public/admin/index.php?newarrivals");
}
?>