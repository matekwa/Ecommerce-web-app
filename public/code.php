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
		<?php
		 code_validation();?>
		<div class="row">
			<div class="col-md-6 m-auto">
				<div class="card mt-5">
					<div class="card-title mt-5">
						<h4 class="bg-primary-color text-white text-center py-3 mt-2" >Enter Code</h4> </hr>
					</div>
					<div class="card-body">
						<?php  display_message();?>
							<form method="POST">
								<div class="password_recovery_field">
									<label>Enter the code we send you:</label>
									<input type="text" name="recovery-code" maxlength="6" minlength="6" placeholder="### ###" required="required">
								</div>
					</div>
					<div class="card-footer">
						<button  class="btn btn-success float-left" >Send Code</button>
						
						</form>
						<button  onclick="cancel()" class="btn btn-danger float-right">Cancel</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
</body>
</html>