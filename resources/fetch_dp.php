<?php
    $connection = mysqli_connect("localhost","root","","swiftshop");
function query($sql){
	global $connection;
	return mysqli_query($connection,$sql);
}

function confirm($result){
	global $connection;
	if (!$result) {
		die("QUERY FAILED:" . mysqli_error($connection));
	}
}

function fetch_array($result){
	return mysqli_fetch_array($result);
}

if (isset($_POST['u_id'])) {
	$profile_id = 13;
	$query = query("SELECT user_photo FROM newregisteredusers WHERE ID= '$profile_id' ");
	confirm($query);
	$row = fetch_array($query);
	$picture = $row["user_photo"];
	echo $picture;
} else{
	echo 0;
}