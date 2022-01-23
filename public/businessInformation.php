<?php require_once("../resources/config.php");
    if(!isset($_SESSION["ID"])) redirect("login.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Swifftshop | Supplier Business Information</title>
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
					<?php display_message(); ?>
					<h2>Please Tell us About Your Business</h2><br>
					<p>*We may require additional information later</p>
					<hr>
					<div class="businessInformation">
						<form>
							<h4>Business Information</h4>
							<div class="form-group">
								<label for="Shop location">Where is your shop located?*</label>
								<select class="form-control" id="shopLocation" required="required">
									<option>-Shop location-</option>
									<option value="Kenya">Kenya</option>
									<option value="Uganda">Uganda</option>
									<option value="Tanzania">Tanzania</option>
									<option value="other African country">Other African Country</option>
									<option value="Abroad">Abroad</option>
								</select>
								<!--<small style="color: blue">Check FAQs section if your country is not in the dropdown list</small>-->
							</div>
							<div class="form-group">
								<label for="Business Name">
									Business name/Shop to display*
								</label>
								<input type="text" id="businessName" class="form-control" placeholder="Shop Name" required="required">
							</div>
							<div class="form-group">
								<label for="address2">Address(Optional)</label>
								<input type="text" id="address" class="form-control" placeholder="Address">
							</div>
							<div class="form-group">
								<label for="postal code">ZIP/Postal code(Optional)</label>
								<input type="text" id="postalCode" class="form-control" placeholder="Postal Code">
							</div>
							<div class="form-group">
								<label for="Region">Region*</label>
								<input type="text" id="region" class="form-control" placeholder="Your region" required="required">
							</div>
							<div class="form-group">
								<label for="City/Town">City/Town*</label>
								<input type="text" id="town" class="form-control" placeholder="City/Town" required="required">
							</div>
							<div class="form-group">
								<label for="VAT registered">VAT Registered*</label>
								<select class="form-control" id="VATregistered" required="required">
									<option value="Yes">Yes</option>
									<option value="No">No</option>
								</select>
							</div>
							<div class="form-group">
								<label for="business registration number">Business Registration Number*</label>
								<input type="text" id="businessRegNumber" class="form-control" required="required">
							</div>
							<div class="form-group">
							<label for="Products category">Choose a category of what you supply</label>
							<select class="form-control" id="supplyCategory" required="required">
								<option>-Supply Category-</option>
								<option value="Clothing Products">Clothing Products</option>
								<option value="Footwear Products">Footwear Products</option>
								<option value="Perfumes and Accessory Products">Perfumes and Accessory Products</option>
								<option value="Clothing,Footwear,Perfumes and Accesory Products">Clothing,Footwear,Perfumes and Accesory Products</option>
								<option value="Other">Other</option>
							</select>
						</div>
						<div id="seller_message"></div>
						</form>
						<button class="btn btn-info btn-block my-10" onclick="buss_Info()" id="busInfo">Next</button>
					</div>
				</div>
				<div class="col-md-6">
				<!--	<p><b>FAQS</b></p><hr>
					<a href="#">What if my country is not listed?</a><hr>
					<a href="#">Is it a must for my business to be VAT registered?</a><hr>
					<a href="#">Why should submit my business name and address?</a><hr>
					<a href="#">Is my business information am submitting safe?</a><hr> -->
				</div>
			</div>
		</div>
	</main><br>
	<?php require_once(TEMPLATE_FRONT.DS."footer.php"); ?>
</body>
</html>