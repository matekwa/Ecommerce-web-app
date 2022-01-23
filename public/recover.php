<?php require_once("../resources/config.php"); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Re-set Forgotten Account Password</title>
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
						<h4 class="bg-primary-color text-white text-center py-3 mt-2" >Recover my Password</h4>
					</div>
					<div class="card-body">
						<?php display_message();?>
						<form>
							<div class="password_recovery_field">
								<label>Enter the E-mail you created an account with:</label>
								<input type="email" id="email_to_be_recovered" placeholder="E-mail address" autocomplete="autocomplete">
								<span id="warning"></span>
							</div>
							<input type="hidden" id="token" value="<?php echo token_generator(); ?>">
						</form>
						<div class="recovery_btns">
							<button onclick="send_email()" class="btn btn-success">Send Password</button>
							<button onclick="cancel()" class="btn btn-danger">Cancel</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
</body>
<script type="text/javascript">
	function send_email() {
		let email_to_be_recovered = document.getElementById('email_to_be_recovered').value.trim();
		let token = document.getElementById('token').value.trim();
		if (email_to_be_recovered.length == 0) {
			document.getElementById('warning').innerHTML = "Enter Email!";
			return false;
		} else{
            let ajax = myAjax("POST", "../resources/functions.php");
            ajax.onreadystatechange = function(){
                if (ajaxStatus(ajax) == true){
                document.getElementById('warning').innerHTML = ajax.responseText; 
            }
        }
            ajax.send("token="+token+"&email_to_be_recovered="+email_to_be_recovered);
	}
}
</script>
</html>