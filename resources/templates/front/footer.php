<footer>
		<script src="../resources/templates/front/jquery/jquery.js"></script>
		<script type="text/javascript" src="../resources/templates/front/slicks/slick-1.8.1/slick/slick.min.js"></script>
		<!------------------------------------------------BOOTSTRAP CDN JS LINK--------------------------------------->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
		<script src="../resources/templates/front/bootstrap/js/bootstrap.bundle.min.js"></script>
		<script src="../resources/templates/front/jquery/aos.js"></script>
		<script src="../resources/templates/front/js/custome_js.js"></script>
		<script src="js/intlTelInput.js"></script>
		 <script src="../resources/templates/front/stylesheet/overlay/dist/loadingoverlay.min.js"></script>
		 <script type="text/javascript">
	        $.LoadingOverlaySetup({
	            image: "../resources/templates/front/stylesheet/loader2.png",
	            imageAnimation: "rotate_right 1.5s"
	        });
	    </script>
		<div class="container-fluid">
			<div class="row footer">
				<div class="col-md-3 col-sm-6 col-xs-12 col-6" data-aos="fade-right" data-aos-delay = "200">
					<h3>Make Money With Us</h3>
					<a href="../public/businessInformation.php"><p>Are you a supplier?</p></a>
					<a href="mailto:logistics@swifftshop.com"><p>Offer Logistic Services</p></a>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-6 col-6" data-aos="fade-in" data-aos-delay = "200">
					<h3>Need Help?</h3>
					<a href="profile.php"><p>Your Account</p></a>
					<?php if (isset($_SESSION['ID']) && $_SESSION['ID'] == 13) {
						echo('<a href="../public/admin"><p>Admin Panel</p></a>');
					} ?>
					<a href="profile.php"><p>Your Orders</p></a>
					<a href="return_policy.php"><p>Returns & Replacements</p></a>
					<a href="mailto:support@swifftshop.com"><p>Contact Us</p></a>
					<a href="Shipping_and_delivery.php"><p>Shipping and Delivery</p></a>
					
				</div>
				<div class="col-md-3 col-sm-6 col-xs-6 col-6 right-0 about_us" data-aos="fade-in" data-aos-delay = "200">
					<h3>About Us</h4>
					<a href="terms_and_condition.php"><p>Terms and Conditions</p></a>
					<a href="privacy_policy.php"><p>Privacy Policy</p></a>
					<p class="user-email"><i class="fa fa-envelope"></i>&nbsp;support@swifftshop.com</p>
					<p class="mobile-no"><i class="fa fa-phone"></i>&nbsp;0745481760</p>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-6 col-6" data-aos="fade-left" data-aos-delay = "200">
						<div class="newsletter">
						<h3>Newsletters</h3>
						<p>Stay Updated Us:</p>
						<div class="form-element">
						<input type="text" id="subscr_email" placeholder="Email"><span onclick="subscribe()"><i class="fas fa-chevron-right"></i></span>
						</div>
						<div id="sent"></div>
						</div><br>
						<div class="move-up">
							<span ><i class="fas fa-arrow-circle-up fa-2x" id="up"></i></span>
						</div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row ribbon3">
				<div class="col-md-4 col-6 social-media-icons">
					<h6>Our Online Communities:</h6>
					<a href="https://web.facebook.com/Swifftshop-Inc-415486682642962/?_rdc=1&_rdr"><i class="fab fa-facebook fa-lg" title="Facebook"></i></a>
					<a href="https://www.instagram.com/swifftshop/"><i class="fab fa-instagram fa-lg" title="Instagram"></i></a>
					<a href="https://www.youtube.com/channel/UC6cJ4wrKw1QNg3auPBOJDvg"><i class="fab fa-youtube fa-lg" title="Youtube"></i></a>
					<a href=""><i class="fab fa-twitter fa-lg" title="Twitter"></i></a>
					<a href="https://www.linkedin.com/in/swifftshop-ltd-23a22920b/"><i class="fab fa-linkedin fa-lg" title="LinkedIn"></i></a>
				</div>
				<div class="col-md-4 col-6">
					<h6>Payment Methods</h6>
					<img src="../resources/uploads/mpesa.png">
				</div>
			</div>
		</div>
		<div class="copyright">
			<hr>
			<p>&copy;2020 - <?php echo date("Y");?>. All rights reserved.</p>
		</div>
		<script type="text/javascript">
			const up = document.querySelector("#up");
			up.addEventListener("click", function(){
				window.scrollTo({
					left:0,
					top:0,
					behavior:"smooth"
				});
			});
		</script>
	</footer>