<?php 
	require_once '../resources/config.php';
	if(!isset($_SESSION["ID"])) redirect("login.php");
	$product_id = $_GET["id"];
	$query = query("SELECT ID FROM product_rating WHERE product_id = '$product_id'");
	confirm($query);
	$num_rows = get_row($query);
	$query1 = query("SELECT SUM(user_rate) As total FROM product_rating WHERE product_id='$product_id'");
	confirm($query1);
	while ($row = fetch_array($query1)) {
		$total = $row['total'];
	}
	$average = '';
	if($num_rows != 0){
		if(is_nan(round($total/$num_rows,1))){
			$average = 0;
		} else{
			$average = round($total/$num_rows,1);
		}
	} else{
		$average = 0;
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Swifftshop | Online shopping for all your cool outfits.</title>
	<?php require_once(TEMPLATE_FRONT.DS."metadata.php"); ?>
</head>
<body>
	<?php require_once(TEMPLATE_FRONT.DS."user_nav.php"); ?>
	<main>
		<?php product_details(); ?>
	<div class="container-fluid p-0">
			<div class="rating-review">
			<div class="tri flex-row">
				<table>
					<tbody>
						<tr class="flex-row">
							<td class="td">
								<div class="rnb rvl">
									<h3><?php echo($average); ?>/5.0</h3>
								</div>
								<div class="pdt-rate">
									<div class="pro-rating">
										<div class="clearfix rating mart8">
											<div class="rating-stars">
												<div class="grey-stars"></div>
												<div class="filled-stars" style="width: <?php echo($average * 20); ?>%"></div>
											</div>
										</div>
									</div>
								</div>
								<div class="rnrn">
									<p class="rars"><?php if($num_rows == 0){echo("No ");}else{echo($num_rows );}?> Reviews</p>
								</div>
							</td>
							<td class="td">
								<?php 
									///////FIVE STAR
											$five = query("SELECT * FROM product_rating WHERE product_id = '$product_id' AND user_rate = 5");
											confirm($five);
											$num_rows_5 = get_row($five);
											$five_star = query("SELECT SUM(user_rate) As total FROM product_rating WHERE product_id='$product_id' AND user_rate = 5");
											confirm($five_star);
											while ($row = fetch_array($five_star)) {
												$total_5 = $row['total'];
											}
											$five_star_av = '';
											if($num_rows_5 != 0){
												if(is_nan(round(($total_5/$total)*100,1))){
													$five_star_av = 0;
												} else{
													$five_star_av = round(($total_5/$total)*100,1);
												}
											} else{
												$five_star_av = 0;
											}
										////////FOUR STAR
											$four = query("SELECT * FROM product_rating WHERE product_id = '$product_id' AND user_rate = 4");
											confirm($four);
											$num_rows_4 = get_row($four);
											$four_star = query("SELECT SUM(user_rate) As total FROM product_rating WHERE product_id='$product_id' AND user_rate = 4");
											confirm($four_star);
											while ($row = fetch_array($four_star)) {
												$total_4 = $row['total'];
											}
											$four_star_av = '';
											if($num_rows_4 != 0){
												if(is_nan(round(($total_4/$total)*100,1))){
													$four_star_av = 0;
												} else{
													$four_star_av = round(($total_4/$total)*100,1);
												}
											} else{
												$four_star_av = 0;
											}
											////////THREE STAR
											$three = query("SELECT * FROM product_rating WHERE product_id = '$product_id' AND user_rate = 3");
											confirm($three);
											$num_rows_3 = get_row($three);
											$three_star = query("SELECT SUM(user_rate) As total FROM product_rating WHERE product_id='$product_id' AND user_rate = 3");
											confirm($three_star);
											while ($row = fetch_array($three_star)) {
												$total_3 = $row['total'];
											}
											$three_star_av = '';
											if($num_rows_3 != 0){
												if(is_nan(round(($total_3/$total)*100,1))){
													$three_star_av = 0;
												} else{
													$three_star_av = round(($total_3/$total)*100,1);
												}
											} else{
												$three_star_av = 0;
											}
											////////TWO STAR
											$two = query("SELECT * FROM product_rating WHERE product_id = '$product_id' AND user_rate = 2");
											confirm($two);
											$num_rows_2 = get_row($two);
											$two_star = query("SELECT SUM(user_rate) As total FROM product_rating WHERE product_id='$product_id' AND user_rate = 2");
											confirm($two_star);
											while ($row = fetch_array($two_star)) {
												$total_2 = $row['total'];
											}
											$two_star_av = '';
											if($num_rows_2 != 0){
												if(is_nan(round(($total_2/$total)*100,1))){
													$two_star_av = 0;
												} else{
													$two_star_av = round(($total_2/$total)*100,1);
												}
											} else{
												$two_star_av = 0;
											}
											////////ONE STAR
											$one = query("SELECT * FROM product_rating WHERE product_id = '$product_id' AND user_rate = 1");
											confirm($one);
											$num_rows_1 = get_row($one);
											$one_star = query("SELECT SUM(user_rate) As total FROM product_rating WHERE product_id='$product_id' AND user_rate = 1");
											confirm($one_star);
											while ($row = fetch_array($one_star)) {
												$total_1 = $row['total'];
											}
											$one_star_av = '';
											if($num_rows_1 != 0){
												if(is_nan(round(($total_1/$total)*100,1))){
													$one_star_av = 0;
												} else{
													$one_star_av = round(($total_1/$total)*100,1);
												}
											} else{
												$one_star_av = 0;
											}
									?>
								<div class="rpb">
									<div class="rnpb">
										<label>5 <i class="fa fa-star"></i></label>
										<div class="ropb">
											<div class="ripb" style="width: <?php echo($five_star_av); ?>%;"></div>
										</div>
										<div class="label">(<?php echo($num_rows_5); ?>)</div>
									</div>
									<div class="rnpb">
										<label>4 <i class="fa fa-star"></i></label>
										<div class="ropb">
											<div class="ripb" style="width: <?php echo($four_star_av); ?>%;"></div>
										</div>
										<div class="label">(<?php echo($num_rows_4); ?>)</div>
									</div>
									<div class="rnpb">
										<label>3 <i class="fa fa-star"></i></label>
										<div class="ropb">
											<div class="ripb" style="width: <?php echo($three_star_av); ?>%;"></div>
										</div>
										<div class="label">(<?php echo($num_rows_3); ?>)</div>
									</div>
									<div class="rnpb">
										<label>2 <i class="fa fa-star"></i></label>
										<div class="ropb">
											<div class="ripb" style="width: <?php echo($two_star_av); ?>%;"></div>
										</div>
										<div class="label">(<?php echo($num_rows_2); ?>)</div>
									</div>
									<div class="rnpb">
										<label>1 <i class="fa fa-star"></i></label>
										<div class="ropb">
											<div class="ripb" style="width: <?php echo($one_star_av); ?>%;"></div>
										</div>
										<div class="label">(<?php echo($num_rows_1); ?>)</div>
									</div>
								</div>
							</td>
							<td class="td">
								
							</td>
						</tr>
					</tbody>
				</table>
				
			</div>
			<div class="bri">
				<div class="uscm">
					<?php 
						$query = query("SELECT * FROM product_rating WHERE product_id='$product_id'");
						confirm($query);
						$num_rows = get_row($query);
						if ($num_rows > 0) {
							while ($row = fetch_array($query)) {
					 ?>
					<div class="uscm-secs">
						<div class="us-img">
							<p><?= substr($row['user_name'],0,1)?></p>
						</div>
						<div class="uscms">
							<div class="us-rate">
								<div class="pdt-rate">
									<div class="pro-rating">
										<div class="clearfix rating  mart8">
											<div class="rating-stars">
												<div class="grey-stars"></div>
												<div class="filled-stars" style="width: <?= $row['user_rate']*20;?>%;"></div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="us-cmt">
								<p><?= $row['user_message'];?></p>
							</div>
							<div class="us-nm">
								<p><i>By <span class="cmnm"><?= $row['user_name'];?></span> on <span class="cmdt"><?= $row['date_reviewed'];?></span></i><br><small style="color: green;"><i class="fas fa-check" style="color: green;"></i> Verified Buyer</small></p>
							</div>
						</div>						
					</div>
					<?php 	}
						}?>
				</div>
			</div>
		</div>
	</div>
	
	 <!-------------------X-----------------Product Rating-----------------------------X--------->


	<!-------------------------SIMILAR PRODUCTS------------------------------------------------>
	<div class="container-fluid similar_products">
			<div class="similar_products_title p-0"><h5>Similar Products</h5></div>
			<div class="row text-center">
				<?php get_similar_products(); ?>
			</div>
		</div>
	</main>

	<?php require_once(TEMPLATE_FRONT.DS."footer.php"); ?>
</body>
<script type="text/javascript">
	let slider = document.getElementById('main_image');
	function change(image) {
		slider.src = image.src;
	}

	function openInfo(evt, Info){
    // Declare all variables
    var i, tabcontent, tablinks;

    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tab_content");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tabcontent.length; i++) {
        tablinks[i].classList.remove("active");
    }

    // Show the current tab, and add an "active" class to the link that opened the tab
    document.getElementById(Info).style.display = "block";
    evt.currentTarget.classList.add("active");
}
</script>
<script type="text/javascript">
	// Get the modal
var modal = document.getElementById('myModal');

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById('main_image');
var modalImg = document.getElementById("img");
var captionText = document.getElementById("caption");
img.onclick = function(){
    modal.style.display = "block";
    modalImg.src = this.src;
    modalImg.alt = this.alt;
    captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
  modal.style.display = "none";
}
$('.image_modal').click(function() {
	$("#myModal").fadeOut();
})
</script>
</html>