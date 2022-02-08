<?php
require_once '../../config.php';
if (isset($_GET['delete'])) {
	$delete_image = query("SELECT icon FROM brands WHERE ID=".escape_string($_GET['delete'])."");
	confirm($delete_image);
		$img = get_row($delete_image);
	if ($mg == 0) {
		echo("Logo doesn't exist!").
	} else{
	$row = fetch_array($delete_image);
	$target = UPLOAD_LOGO.DS.$row['slide_image'];
	unlink($target);
	$query = query("DELETE FROM brands WHERE ID=".escape_string($_GET['delete'])."");
	confirm($query);
	set_message("<h4 class='alert alert-danger'>Deleted!</h4>");
	redirect("../../../public/admin/index.php?brands");
} else{
	redirect("../../../public/admin/index.php?brands");
}
}
?>