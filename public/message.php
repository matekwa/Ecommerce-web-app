<?php 
    require_once("../resources/config.php");
	$message = "No message";
	if (isset($_GET['msg'])) {
		$id = $_GET['id'];
		$msg  = preg_replace("#[^a-z0-9._,() :]#i", '', $_GET['msg']);
		if ($msg == 'activation_failure') {
			$message = "<h2>Activation Error :(</h2> Sorry there seems to have a problem with <span style='font-weight:bold;color:red;'>activation of your account</span>,we will notify you shortly via your e-mail when we figure it out at our end";
		} elseif ($msg == 'activation_success') {
			$message = '<img src="../resources/uploads/tenor.gif" style="width:50%;"></img><br><strong style ="color:blue; font-size:20px;"> Activation sucessfull! </strong></br> <a href = "add_profile_picture.php?u_id=$id">Click here to continue</a>';
		} else{
			$message = $msg;
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	 <?php require_once(TEMPLATE_FRONT.DS."metadata.php"); ?>	
</head>
<body>
<main>
	 <?php require_once(TEMPLATE_FRONT.DS."simple_header.php"); ?>
	<div class="container">
		<div class="row">
			<div class="col-md-6 m-auto">
				<div class="card mt-5">
					<div class="card-body">
							<div class="text-center"><?php  echo $message; ?> </div>
					</divs>
				</div>
			</div>
		</div>
	</div>
</main>>
</body>
</html>
