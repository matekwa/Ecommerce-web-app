<?php
	require_once("../resources/config.php");
	if (isset($_GET['id']) && isset($_GET['e']) && isset($_GET['u']) && isset($_GET['p']) && isset($_GET['v']) ) {
		//Immah sanitize incoming $_GET variables and connect to the database also
				$user_id = preg_replace('#[^0-9]#i', '', $_GET['id']);
				$email = mysqli_real_escape_string($connection, $_GET['e']);
				$username = preg_replace("#[^a-zA-Z0-9._]#i", '', $_GET['u']);
				$password =  mysqli_real_escape_string($connection, $_GET['p']);
				$validationcode = $_GET['v'];

		//Evaluate the length of the incoming $_GET variables
		if ($user_id == "" || strlen($username)<3 || strlen($email)<5 || strlen($password) < 3){
				//Log these issues into a text file and email to yourself
				header("location:message.php?msg=A problem occured with activation string length,please try again.");
				exit(); 
			}

		//We check the credentials against the database
		$query = query("SELECT * FROM newregisteredusers WHERE validation_code='$validationcode' AND ID='$user_id' AND Email='$email' AND Username='$username' AND Password='$password'");
		confirm($query);
		$numRows = get_row($query);
		//Evaluate for a match in the database(0 = no match, 	1 = there's a match)
		if ($numRows == 0) {
			//Log this attempt to a text file and email the details to yourself
			header("location:message.php?msg=Your credentials are not matching anything in our system");
			exit();
		} else {
		//If a match was found then we can activate
		$query2 = query("UPDATE newregisteredusers SET Active ='1',validation_code='0' WHERE ID='$user_id' AND Email='$email' AND Password='$password' ");
		confirm($query2);
		header("location:message.php?msg=activation_success&id=$user_id");
	}

		/*/Double check if active is set to '1'
		$query3 = ("SELECT * FROM newregisteredusers WHERE ID='$user_id' AND Active='1'");
		confirm($query3);
		$row = get_row($query3);
		//Send back to message.php activation status
		if ($row == 0) {
			//Log this issue of activate = '0'
			header("location:message.php?msg=activation_failure");
			exit();
		} elseif ($row > 0) {
			//Everything went out successfull and activation is confirmed
			header("location:message.php?msg=activation_success");
			exit();
		} else {
		//You can log any issues of missing $_GET variables here
		header("location:message.php?msg=Missing_GET_variables");
		exit();
	} */
}
?>