<?php
require_once '../../config.php';
if (isset($_GET['delete'])) {
	$query = query("DELETE FROM category WHERE ID=".escape_string($_GET['delete'])."");
	confirm($query);
	set_message("<h4 class='alert alert-danger'>category deleted!</h4>");
	redirect("../../../public/admin/index.php?categories");
} else{
	redirect("../../../public/admin/index.php?categories");
}
?>