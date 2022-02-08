<?php
require_once '../../config.php';

if (isset($_GET['id'])) {
	$query = query("DELETE FROM suppliers WHERE ID=".escape_string($_GET['id'])."");
	confirm($query);
	set_message("<h4 class='alert alert-success'>Supplier deleted successfully!</h4>");
	redirect("../../../public/admin/index.php?suppliers");
} else{
	redirect("../../../public/admin/index.php?suppliers");
}
?>