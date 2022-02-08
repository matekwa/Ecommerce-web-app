<?php
require_once '../../config.php';

if (isset($_GET['delete_slide'])) {
	$delete_image = query("SELECT slide_image FROM slides WHERE slide_ID=".escape_string($_GET['delete_slide'])."");
	confirm($delete_image);
	$row = fetch_array($delete_image);
	$target = UPLOAD_DIRECTORY.DS.$row['slide_image'];
	unlink($target);
	$query = query("DELETE FROM slides WHERE slide_ID=".escape_string($_GET['delete_slide'])."");
	confirm($query);
	set_message("<h4 class='alert alert-success'>Slide deleted successfully!</h4>");
	redirect("../../../public/admin/index.php?slides");
} else{
	redirect("../../../public/admin/index.php?slides");
}
?>