<?php require_once("../resources/config.php"); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Recover My Password</title>
	<?php require_once(TEMPLATE_FRONT.DS."metadata.php"); ?>
</head>
<body>
<main>
	 <?php require_once(TEMPLATE_FRONT.DS."simple_header.php"); ?>
	<div class="container">
		<div class="row">
			<div class="col-md-6 m-auto">
				<div class="card mt-5">
					<div class="card-title mt-5">
						<h4 class="bg-primary-color text-white text-center py-3 mt-2" >Reset Password</h4> </hr>
					</div>
					<div class="card-body">
						<?php
						reset_password();
						 display_message();?>
						<form method="POST">
							<div class="password_recovery_field">
								<label>Enter Your New Password:</label>
								<input type="password" name="newPassword1" placeholder="New Password" required="required">
							</div>
							<div class="password_recovery_field">
								<label>Confirm Your New Password:</label>
								<input type="password" name="newPassword2"  placeholder="Confirm Password" required="required">
								<span id="warning"></span>
							</div>
							<input type="hidden" name="token2" value="<?php echo token_generator(); ?>">
					</div>
					<div class="card-footer">
						<button class="btn btn-success float-left">Reset</button>
						</form>
						<button  class="btn btn-danger float-right" onclick="cancel()" >Cancel</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
</body>
</html>