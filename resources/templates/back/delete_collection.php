<?php
require_once '../../config.php';
if (isset($_GET['delete'])) {
	$query = query("DELETE FROM collection WHERE ID=".escape_string($_GET['delete'])."");
	confirm($query);
	set_message("<h4 class='alert alert-danger'>Deleted!</h4>");
	redirect("../../../public/admin/index.php?collection");
} else{
	redirect("../../../public/admin/index.php?collection");
}
?>