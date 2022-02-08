<?php
session_start();
$id = $_SESSION['ID'];
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
# Check if file was posted without any error
if (isset($_FILES['file']['name'])) {
 	$allowed = array('jpg' => 'image/jpg','JPG' => 'image/JPG','JPEG' => 'image/JPEG','png' => 'image/png','PNG' => 'image/PNG','jpeg' => 'image/jpeg' );
 	$imagename = time().'_'. $_FILES['file']['name'];
 	$imagetype = $_FILES['file']['type'];
 	$imagesize = $_FILES['file']['size'];
 	$image_extension = pathinfo($imagename,PATHINFO_EXTENSION);
 	$image_in_temp_location = $_FILES['file']['tmp_name'];
 	$max_size = 5 * 1024 * 1024;
 	if (!array_key_exists($image_extension, $allowed)) {
 		echo"Error: Please select a valid file format!";
 		exit();
 		//Verify Image size (5MB)
 	} elseif ($imagesize > $max_size) {
 		echo "Error: Image is too big!";
 		exit();
 	}

 	//Verify MIME type of the image
 	if (in_array($imagetype, $allowed)) {
 		# CHECK WHETHER THE IMAGE ALREADY EXISTS IN THE UPLOADS FOLDER
 		if (file_exists("uploads/profile_pictures/".$imagename)) {
 			echo $imagename." already exists.";
 			exit();
 		} else {
 			 move_uploaded_file($image_in_temp_location, "uploads/profile_pictures/".$imagename);
 			 $get_previuos_image = query("SELECT user_photo FROM newregisteredusers WHERE ID= '$id'");
 			 confirm($get_previuos_image);
 			 $row = fetch_array($get_previuos_image);
 			 $target = "uploads/profile_pictures/".$row['user_photo'];
 			 unlink($target);

 			 $query = query("UPDATE newregisteredusers SET user_photo='$imagename' WHERE ID = '$id'");
	   		 confirm($query);
 			 echo 'uploaded';
 		}
 	} else{
 		echo "There was a problem uploading your Profile Picture, Try another one!";
 		exit();
 	}
 } else {
 	echo "No File Received,Try Again.";
 } 

 ?>