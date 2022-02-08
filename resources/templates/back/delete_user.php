<?php
require_once '../../config.php';
if (isset($_GET['delete'])) {
	$delete_image = query("SELECT user_photo FROM newregisteredusers WHERE ID=".escape_string($_GET['delete'])."");
	confirm($delete_image);
		$img = get_row($delete_image);
	if ($mg == 0) {
		echo("Profile picture doesn't exist!").
	} else{
	$row = fetch_array($delete_image);
	$target = UPLOAD_PP.DS.$row['slide_image'];
	unlink($target);
	$query = query("DELETE FROM newregisteredusers WHERE ID=".escape_string($_GET['delete'])." ");
	confirm($query);
	set_message("<h4 class='alert alert-success'>User deleted!</h4>");
	redirect("../../../public/admin/index.php?users");
} else{
	redirect("../../../public/admin/index.php?users");
}
}
?>