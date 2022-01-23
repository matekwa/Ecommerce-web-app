
<!DOCTYPE html>
<html lang="en">
<head>
	<title>sqlyog</title>
    <?php require_once(TEMPLATE_FRONT.DS."metadata.php"); ?>
</head>
<body>
<main>
	<div class="container">
		<div class="row">
			<div class="col-md-6 m-auto">
				<div class="card mt-2 mb-5">
					<div class="card-title mt-5">
						<h4 class="bg-primary-color text-white text-center py-3 mt-2" >Create a new SwiftShop account</h4>
                    </div>
					<div class="card-body" id="createAccountForm">
						<form method="POST" onsubmit="return false" enctype="multipart/form-data" id="form">
                            <div class="form_control">
	                            <label for="Email" style="color: var(--primary-color);font-weight: bold">Email Address*</label>
	                            <input type="email" id="email_to_register" placeholder="Active Email Address" onblur="check_email()">
	                            <i class="fas fa-check-circle"></i>
	                            <i class="fas fa-exclamation-circle"></i>
	                            <small>Error Message</small>
                        	</div>


                            <div class="form_control">
                            	<label for="userName" style="color: var(--primary-color);font-weight: bold">Username*</label>
                            	<input type="text" id="userName" onkeyup ="checkUsername()" maxlength="16" placeholder="Preffered Username" autocomplete="autocomplete" >
                            	<i class="fas fa-check-circle"></i>
	                            <i class="fas fa-exclamation-circle"></i>
	                            <small>Error Message</small>
                            </div>
							<label for="Gender" style="color: var(--primary-color);font-weight: bold">Gender*</label>
                            <select id="gender" class="form-control">
                            	<option value="">-Gender-</option>
								<option value="Male">Male</option>
								<option value="Female">Female</option>
							</select>
							<label for="county" style="color: var(--primary-color);font-weight: bold">County*</label>
							<select id="county" class="form-control">
								<option value="">-Select County-</option>
								<option value="Mombasa">Mombasa</option>
								<option value="Kwale">Kwale</option>
								<option value="Kilifi">Kilifi</option>
								<option value="Tana River">Tana River</option>
								<option value="Lamu">Lamu</option>
								<option value="Taita-Taveta">Taita-Taveta</option>
								<option value="Garissa">Garissa</option>
								<option value="Mandera">Mandera</option>
								<option value="Marsabit">Marsabit</option>
								<option value="Isiolo">Isiolo</option>
								<option value="Meru">Meru</option>
								<option value="Tharaka-Nithi">Tharaka-Nithi</option>
								<option value="Embu">Embu</option>
								<option value="Kitui">Kitui</option>
								<option value="Machakos">Machakos</option>
								<option value="Makueni">Makueni</option>
								<option value="Nyandarua">Nyandarua</option>
								<option value="Nyeri">Nyeri</option>
								<option value="Kirinyaga">Kirinyaga</option>
								<option value="Murang'a">Murang'a</option>
								<option value="Kiambu">Kiambu</option>
								<option value="Turkana">Turkana</option>
								<option value="West Pokot">West Pokot</option>
								<option value="Samburu">Samburu</option>
								<option value="Tranz-Nzoia">Tranz-Nzoia</option>
								<option value="Uasin Gishu">Uasin Gishu</option>
								<option value="Elgeyo-Marakwet">Elgeyo-Marakwet</option>
								<option value="Nandi">Nandi</option>
								<option value="Baringo">Baringo</option>
								<option value="Laikipia">Laikipia</option>
								<option value="Nakuru">Nakuru</option>
								<option value="Narok">Narok</option>
								<option value="Kajiado">Kajiado</option>
								<option value="Kericho">Kericho</option>
								<option value="Bomet">Bomet</option>
								<option value="Kakamega">Kakamega</option>
								<option value="Vihiga">Vihiga</option>
								<option value="Bungoma">Bungoma</option>
								<option value="Busia">Busia</option>
								<option value="Siaya">Siaya</option>
								<option value="Kisumu">Kisumu</option>
								<option value="Homa Bay">Homa Bay</option>
								<option value="Migori">Migori</option>
								<option value="Kisii">Kisii</option>
								<option value="Nyamira">Nyamira</option>
								<option value="Nairobi">Nairobi</option>
							</select>

							 <div class="form_phone_field">
							 	<label for="Phone Number" style="color: var(--primary-color);font-weight: bold">Phone Number</label><br>
							 	<input type="tel" id="phone_number" placeholder="Phone Number"><br>
							 	<span id="er"></span>
							 	<span id="error-msg" class="hide"></span>
                				<span id="valid-msg" class="hide"><i class="fas fa-check-circle">&nbsp;</i>Valid</span>
                				
							 </div>


							 <div class="form_control" >
							 	<label for="userPassword1" style="color: var(--primary-color);font-weight: bold">Password*</label>
							 	<input type="password" id="userPassword1" onkeyup="checkPassword()" placeholder="Account Password" maxlength="16" autocomplete="autocomplete">
							 	<i class="fas fa-check-circle"></i>
	                            <i class="fas fa-exclamation-circle"></i>
	                            <small>Error Message</small>
							 </div>


							 <div  class="form_control">
							 	 <label for="userPassword2" style="color: var(--primary-color);font-weight: bold">Repeat password*</label>
							 	 <input type="password" id="userPassword2" placeholder="Confirm password" maxlength="16" autocomplete="autocomplete">
							 	 <i class="fas fa-check-circle"></i>
	                             <i class="fas fa-exclamation-circle"></i>
	                             <small>Error Message</small>
							 </div>
							<div class="checkbox mt-2">
								<label><input type="checkbox" id="terms" >I accept to <a href="terms_and_condition.php">terms and conditions </a> of use </label>
							</div>
								<span id="warning"></span><br>
							<div id="card_footer">
								<button id="create_account_btn">Submit</button>
								<a href="index.php">Already have an account?</a>
							</div>
						</form>
						<div>
							<span id="warning"></span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
</body>
</html>