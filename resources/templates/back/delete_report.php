<?php
require_once '../../config.php';
if (isset($_GET['delete'])) {
	$query = query("DELETE FROM reports WHERE report_ID=".escape_string($_GET['delete'])."");
	confirm($query);
	set_message("<h4 class='alert alert-danger'>Report deleted!</h4>");
	redirect("../../../public/admin/index.php?reports");
} else{
	redirect("../../../public/admin/index.php?reports");
}
?>