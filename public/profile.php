<?php require_once("../resources/config.php");
    if(!isset($_SESSION["ID"])) redirect("login.php");
    $mytime = getdate(date("U"));
$date = "$mytime[weekday], $mytime[month], $mytime[mday], $mytime[year]";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Profile Page</title>
	<?php require_once(TEMPLATE_FRONT.DS."metadata.php"); ?>
</head>
<?php
	$profile_id = $_SESSION["ID"];
	$query = query("SELECT * FROM newregisteredusers WHERE ID= '$profile_id' ");
	confirm($query);
	while ($row = fetch_array($query)) {
		$username = $row['Username'];
		$county = $row['County'];
		$phone = $row['phone_number'];
		$email = $row['Email'];
		$profile_pic = $row['user_photo'];
		$gender = $row['Gender'];
		$county = $row['County'];
	}
?>
<body>
    <?php include (TEMPLATE_FRONT."/user_nav.php"); ?>
	<main id="profile-body">
		<div class="profile-container">
			<div class="profile-header">
				<div class="profile-image">
						<form  method="post" action="" enctype="multipart/form-data" id="myform">
							<input type="hidden" id="u_id" value="">
							<!--<input type="file" id="pic" class="my_file" onchange="change_dp()">-->
							<img src="../resources/uploads/profile_pictures/<?php echo($profile_pic);?>" width="200" alt="Profile Picture">
						</form>
				</div>
				<div class="profile-nav-info">
					<h3 class="user-name"><?php echo "$username"; ?></h3>
					<div class="address">
						<p class="county"><?php echo "$county"; ?>,</p>
						<span class="country">Kenya</span>
					</div>
					<small class="text-center" id="warning" style="color: #002b80;font-weight: 600;font-size:15px;"></small>
				</div><!---
				<div class="profile-option">
					<div class="notification">
						<i class="fa fa-bell"></i>
						<span class="alert-message">1</span>
					</div>
				</div> --->
			</div>
			<div class="main-body">
				<div class="left-side">
					<div class="profile-side">
						<p class="mobile-no"><i class="fa fa-phone"></i><?php echo "$phone"; ?></p>
						<p class="user-email"><i class="fa fa-envelope"></i><?php echo "$email"; ?></p>
						<!--<div class="user-bio">
							<h3>Bio</h3>
							<p class="bio">
								Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
								tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
								quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
								consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
								cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
								proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
							</p>
						</div> -->
						<div class="profile-btn">
							<button class="chatbtn"><a href="mailto:complainant@swifftshop.com">
								<i class="fa fa-comment"></i> Report
							</a>
							</button>
							<button class="createbtn"><a href="mailto:customerfeedbacks@swifftshop.com">
								<i class="fa fa-plus"></i>  Feedback
							</a>
							</button>
						</div>
					</div>
				</div>
				<div class="right-side">
					<div class="nav">
						<ul>
							<li class="user-post actv" onclick="tabs(0)">Orders</li>
							<li class="user-reviews" onclick="tabs(1)">Reviews</li>
							<li class="user-settings" onclick="tabs(2)">Settings</li>
						</ul>
					</div>
					<div class="profile-body">
						<div class="profile-orders profile-tab" style="width: 100%;margin: 0!important;">
							 <table class="table table-bordered table-responsive table-striped">
									 <tr>
							            <th>Product</th>
							            <th>Order Number</th>
							            <th>Order Status</th>
							         </tr>
						          	<?php get_orders_to_profile_page(); ?>
						      </table>
						</div>
						<div class="profile-reviews profile-tab">

							<div class="rrb review-page">
									 <table class="table table-bordered table-responsive table-hover table-striped">
										 <tr>
								            <th>Product</th>
								            <th><p>Please Rate our product:</p></th>
								         </tr>
							           <?php 
											$user_id = $_SESSION['ID'];
											$query = query("SELECT * FROM orders WHERE user_id = '$user_id' AND product_review = 0 AND order_status = 4 LIMIT 1");
											confirm($query);
											$result = get_row($query);
											if ($result == 0) {
											echo("No Pending Reviews.");
											}else{
											while ($row = fetch_array($query)) {
												$product_id = $row["product_id"];
												$product_photo = $row["product_photo"];
												$product_name = $row["product_name"];
												$order_number = $row["order_number"];
												$order_date = $row["order_date"];
											$pending_reviews =<<<DELIMETER
														<tr>
														<td>
														  <div class="cart-info">
														      <img src="../resources/uploads/{$product_photo}" style="width:100px; height:100px; padding:5px;">
														      <div style="text-align:left;padding:5px;margin:auto 0;">
														        <p><strong>{$product_name}</strong></p>
														        <small><strong>Order No:</strong> #{$order_number}</small><br>
														        <small><strong>Date:</strong> {$order_date}</small>
														      </div>
														  </div>
														</td>
														  <td class="td">
														  		<div class="rrb" style="margin-top:40px; padding:5px;">
																	<input type="hidden" value="" class="starRateV" id="starRateV">
																	<input type="hidden" value="$date" class="rateDate" id="rateDate">
																	<input type="hidden" value="$product_id" class="productId" id="product_id">
																	<button class="rbtn opmd">Add Review</button>
																</div>
															</td>
														</tr>
															
											DELIMETER;
											echo($pending_reviews);
											}
											}
							            ?>
						      		</table>
						      <div class="review-modal" style="display: none;">
										<div class="review-bg"></div>
										<div class="rmp">
											<div class="rpc">
												<span><i class="fa fa-times"></i></span>
											</div>
											<div class="rps" align="center">
												<i class="fa fa-star" data-index="0" style="display: none;"></i>
												<i class="fa fa-star" data-index="1"></i>
												<i class="fa fa-star" data-index="2"></i>
												<i class="fa fa-star" data-index="3"></i>
												<i class="fa fa-star" data-index="4"></i>
												<i class="fa fa-star" data-index="5"></i>
											</div>
											
											<div class="rptf" align="center">
												<input type="text" class="raterName" placeholder="Enter your name" id="raterName" value="<?php echo($_SESSION['Username']); ?>">
											</div>
											<div class="rptf" align="center">
												<textarea class="rateMsg" id="rate_message" placeholder="Describe your Experience..."></textarea>
											</div>
											<div class="rate-error" align="center"></div>
											<div class="rpsb" align="center">
												<button class="rpbtn" id="post_review">Post Review</button>
											</div>
										</div>
								</div>		
							</div>
						</div>
						<div class="profile-settings profile-tab">
							<div class="edit-container">
								<form method="POST" onsubmit="return false">
									<div class="user-details">
										<div class="input-box">
											<span class="details">Username*</span>
											<input type="text" value="<?php echo("$username"); ?>" disabled="disabled">
										</div>
										<div class="input-box">
											<span class="details">Email*</span>
											<input type="email"  value="<?php echo("$email"); ?>" disabled="disabled">
										</div>
										<div class="input-box">
											<span class="details">Phone Number*</span>
											<input type="number" value="<?php echo("$phone"); ?>" id="phone_number">
										</div>
										<div class="input-box">
											<label for="Gender" class="details">Gender*</label>
				                            <input type="text" id="gender" value="<?php echo($gender) ?>">
										</div>
										<div class="input-box">
											<label for="country" class="details">County*</label>
											<input type="text" id="county" value="<?php echo($county) ?>">
										</div>
										<div class="input-box">
											<span class="details">Old Password*</span>
											<input type="password" id="old_password">
										</div>
										<div class="input-box">
											<span class="details">New Password*</span>
											<input type="password" onkeyup="checkPassword()" onblur="clearPasswordStatus()" maxlength="16" id="userPassword1">
											<span id="passwordStatus"></span>
										</div>
										<div class="input-box">
											<span class="details">Confirm New Password*</span>
											<input type="password" name="new_password2" maxlength="16" id="userPassword2">
										</div>
									</div>
									<div id="error_messages"></div>
									<div class="button">
										<input type="submit" value="Save" onclick="edit_user_details()" id="save_edits_btn">
										<input type="submit" value="Change Password" onclick="edit_user_password()" id="save_edits_btn">
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>
	<?php require_once(TEMPLATE_FRONT.DS."footer.php"); ?>
	<script type="text/javascript" src="../resources/templates/front/js/product_rating.js"></script>
</body>
<script type="text/javascript">
	$('.nav ul li').click(function () {
		$(this).addClass("actv").siblings().removeClass("actv");
	})
	const tabBtn = document.querySelectorAll('.nav ul li');
	const tab = document.querySelectorAll('.profile-tab');
	function tabs(panelIndex){
		tab.forEach(function(node){
			node.style.display = "none";
		});
		tab[panelIndex].style.display = "block";
	}
	tabs(0);
	/*const bio = document.querySelector('.bio');
	function bioText(){
		bio.oldtext = bio.innerText;
		bio.innerText = bio.innerText.substring(0,100) + "...";
		bio.innerHTML += "&nbsp;" + '<span id="see-more" onclick="addLength()">See More</span>';
	}
	bioText();
	function addLength(){
		bio.innerText = bio.oldtext;
		bio.innerHTML +=  "&nbsp;" + '<span id="see-less" onclick="bioText()">See Less</span>';
	}*/
</script>

<script type="text/javascript">
	window.addEventListener("load",function(){
		let id = document.getElementById('u_id').value;
   		 let ajax = myAjax("POST", "../resources/fetch_dp.php");
            ajax.onreadystatechange = function(){
                if (ajaxStatus(ajax) == true){
                	if(ajax.responseText != 0){
                		//const path = "../resources/uploads/profile_pictures/"+ajax.responseText;
                		//document.getElementById("pic").style.background = 'url('+path+')';
                	}else{
                		alert("nothing found");
                	}
                }
            }
            ajax.send("u_id="+id);
	});


       function change_dp(){
                var fd = new FormData();

                var files = $('#pic')[0].files;

                // Check file selected or not
                if(files.length > 0 ){

                    fd.append('file',files[0]);

                    $.ajax({
                        url:'../resources/change_dp.php',
                        type:'post',
                        data:fd,
                        contentType: false,
                        processData: false,
                        success:function(response){
                            if(response == "uploaded"){
 								document.getElementById("warning").innerHTML = "";
                                location.reload();
                            }else{
                              document.getElementById("warning").innerHTML = response;
                            }
                        }
                    });
                }else{
                   document.getElementById("warning").innerHTML = "No File Selected!"; 
                }
      
       }
</script>
</html>