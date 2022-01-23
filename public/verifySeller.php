<?php require_once("../resources/config.php");
    if(!isset($_SESSION["ID"])) redirect("login.php");
    $Username = $_SESSION['Username'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Email Verification - Sell on SwiftShop</title>
	<?php require_once(TEMPLATE_FRONT.DS."metadata.php"); ?>
</head>
<body>
<header>
	<?php require_once(TEMPLATE_FRONT.DS."simple_header.php"); ?>
</header>
<main>
	<div class="container">
		<div class="card text-center">
			<div class="Verification_check">
				<img src="../resources/uploads/ok.PNG">
			</div>
			<div class="message">
				<h6>Thank you <?php echo($Username); ?> for your intrest to be our supplier,We`ll review your information and back to you as soon as possible</h6>
			</div>
		</div>
	</div>
</main>
</body>
</html>