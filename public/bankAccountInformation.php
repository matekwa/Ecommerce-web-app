<?php require_once("../resources/config.php");
    if(!isset($_SESSION["ID"])) redirect("login.php");

    $reg_no = $_GET['reg_no'];
    $query = query("SELECT * FROM suppliers WHERE business_reg_no = '$reg_no'");
    $exist = get_row($query);
    while ($row = fetch_array($query)) {
    	$_SESSION['reg_no'] = $row['business_reg_no'];
    }
    if (!isset($_GET['reg_no']) || empty($_GET['reg_no']) || $exist == 0 || $_GET['reg_no'] != $_SESSION['reg_no']) {
    	set_message("<span style='color:white;background:red; padding:3px;margin-top:10px;'>Invalid Business Number!</span>");
    	redirect("businessInformation.php");
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Bank Account Information | swifftshop Supplier</title>
	<?php require_once(TEMPLATE_FRONT.DS."metadata.php"); ?>
</head>
<body>
<header>
	<?php require_once(TEMPLATE_FRONT.DS."simple_header.php"); ?>
</header>
<main>
	<div class="container">
		<div class="row" id="bank_account_info">
			<div class="col-md-6">
				<div class="bankAccountInformation">
					<form>
						<h4>Bank Account</h4><hr>
						<div class="form-group">
							<label for="Mpesa registered name">Mpesa Registered Name*</label>
							<input type="text" id="mpesaRegisteredName" class="form-control" required="required">
						</div>
						<div class="form-group">
							<label for="Mode of payment"><b>Mode Of Payment*</b></label>
							<select class="form-control" id="modeOfPayment" required="required">
								<option>-Payment Method-</option>
								<option value="Mpesa">Mpesa</option>
								<option value="Credit-Card">Credit Card</option>
							</select>
							<small style="color:blue;">Choose the method you want to be paid for products sold.</small>
						</div>
						<div class="form-group">
							<label for="Mpesa Phone Number"><b>Mpesa Phone Number*</b></label>
							<input type="Number" id="mpesaPhoneNumber" class="form-control" required="required">
							<small style="color:blue;">If you have selected Mpesa for your payments - Input your Mpesa number here</small>
						</div>
						<div class="form-group">
							<label for="Account Name"><b>Account Name*</b></label>
							<input type="text" id="accountName" class="form-control" required="required">
						</div>
						<div class="form-group">
							<label for="Account Number"><b>Account Number*</b></label>
							<input type="text" id="accountNumber" class="form-control" required="required">
						</div>
						<div class="form-group">
							<label for="Bank Code"><b>Bank*</b></label>
							<input type="text" id="bankName" class="form-control" required="required">
						</div>
						<div id="seller_message"></div>
					</form>
					<button class="btn btn-success btn-block" onclick="bank_info()" id="submitBankInfo">Submit</button>
				</div>
			</div>
			<div class="col-md-6">
			<!--	<p><b>FAQS</b></p><hr>
					<a href="#">What if I do not have a bank account?</a><hr>
					<a href="#">what if I do not have an Mpesa number?</a><hr>
					<a href="#">Why should I include my account name and number?</a><hr>
					<a href="#">How will I receive money when my products are sold on SwifftShop?</a><hr> -->
			</div>
		</div>
	</div>
</main><br>
<?php require_once(TEMPLATE_FRONT.DS."footer.php"); ?>
</body>
</html>