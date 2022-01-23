<?php require_once("../resources/config.php");
    if(!isset($_SESSION["ID"])) redirect("login.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Seller Information - sellercentral</title>
	<?php require_once(TEMPLATE_FRONT.DS."metadata.php"); ?>
</head>
<body>
	<header>
		<?php require_once(TEMPLATE_FRONT.DS."simple_header.php"); ?>
	</header>
	<main>
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<?php include 'sellerSignUp.php'; ?>
					<div class="sellerInformation">
						<form>
							<h4>Seller Information</h4>
							<div class="form-group">
								<label for="First Name">First Name*</label>
								<input type="text" name="firstName" class="form-control">
							</div>
							<div class="form-group">
								<label for="Middle Name">Middle Name</label>
								<input type="text" name="middleName" class="form-control">
							</div>
							<div class="form-group">
								<label for="Last Name">Last Name*</label>
								<input type="text" name="lastName" class="form-control">
								<p><small> Enter your names as they appear on your ID or passport.</small></p>
							</div>
							<div class="form-group">
								<label for="email">Email*</label>
								<input type="email" name="email" class="form-control">
							</div>
							<div class="form-group">
								<label for="password">Password*</label>
								<input type="password" name="password" class="form-control">
							</div>
							<div class="form-group">
								<label for="retype-password">Retype Password*</label>
								<input type="password" name="retypedPassword" class="form-control">
							</div>
							<div class="form-group">
								<label for="phone number">Phone number for verification*</label>
								<input type="number" name="phoneNumber" class="form-control">
							</div>
							<div class="form-group">
								<label for="Method of receiving pin">Receive PIN through*</label><br>
								<label class="radio-inline"><input type="radio" name="SMS">  SMS</label>
								<label class="radio-inline"><input type="radio" name="Call">  Call</label><br>
								<a href="#"><button class="verificationButton">Send SMS</button></a>
							</div><br>
							<div class="checkbox">
								<label><input type="checkbox" name="agreeToTerms">I agree to <a href="#"> terms and conditions</a> of use.</label>
							</div>
						</form>
						<a href="bankAccountInformation.php"><button class="btn-1">Next</button></a>
					</div>
				</div>
				<div class="col-md-6 FAQs">
					<p><b>FAQS</b></p><hr>
					<a href="#">What if I have not received the SMS with the PIN?</a><hr>
					<a href="#">What are the terms and conditions I should Know?</a><hr>
					<a href="#">Is my personal data safe?</a><hr>
					<a href="#">Why should I submit my Email address?</a><hr>
					<a href="#">What is the correct format of the phone number?</a><hr>
					<a href="#">What should I do if I do not have a phone number for verification?</a><hr>
				</div>
			</div>
		</div>
	</main>
	<footer></footer>
	<script src="jquery/jquery-3.4.1.js"></script>
	<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
	<script type="text/javascript" src="slicks/slick-1.8.1/slick/slick.min.js"></script>
	<script type="text/javascript" src="js/homepagejs.js"></script>
</body>
</html>