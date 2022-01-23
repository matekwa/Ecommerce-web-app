<?php require_once("../resources/config.php");
    if(!isset($_SESSION["ID"])) redirect("login.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>SwifftShop | House Of Brands,Cool & Legit outfits </title>
	<?php require_once(TEMPLATE_FRONT.DS."metadata.php"); ?>
</head>
<body>
    <?php include (TEMPLATE_FRONT."/user_nav.php"); ?>
	<main>
	
		<div class="container-fluid">
		<!------------------First Slider------------------------------------>
		<div class="row">
			<div class="col-md-12">
				<?php require_once 'carousel.php'; ?>
			</div>
		</div>
		</div>
		<!--------------X----First Slider----X-------------------------------->

		<!---------------------------Best Selling------------------------------------------------->
		<div class="container-fluid p-0" id="bestselling_slider">
				<?php require_once "bestselling_slider.php"; ?>
		</div>
		<!-------------------X--------Best Selling---------------X---------------------------------->

		<!-----------------------------------First Section(New Arrivals)---------------------------------------------------------->
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-3 col-xs-12 newArrivals">
					<div class="newArrivalsTitle"><h5>New Arrivals</h5></div>
					<div class="row">
						<?php get_newarrivals(); ?>
					</div>
				</div>
				<div class="col-md-3 col-xs-12 featured">
					<div class="featuredTitle"><h5>Featured</h5></div>
					<div class="row">
						<?php get_features() ?>
					</div>
				</div>
				<div class="col-md-3 col-xs-12 trending">
					<div class="trendingTitle"><h5>Trending</h5></div>
					<div class="row">
						<?php get_trending_products(); ?>
					</div>
				</div>
				<div class="col-md-3 col-xs-12 partners">
					<div class="partnersTitle"><h5>Partners</h5></div>
					<div class="row">
						<?php get_partnered_products(); ?>
					</div>
				</div>
		</div>
		</div>
<!-----------------X------------------First Section(New Arrivals)-------------------------------------X--------------------->
		<div class="container-fluid hotdeals text-center">
			<div class=" text-center hotDealsTitle"><h5>Hot deals</h5></div>
			<?php require_once("hotdeals.php"); ?>
		</div>
				<!---------------------------suggestions------------------------------------------------->
		<div class="container-fluid p-0">
			<?php require_once("suggestions.php"); ?>
		</div>
		<!-------------------X--------suggestions---------------X---------------------------------->
		<div class="container-fluid">
			<div class="row ribbone1">
				<?php require_once("includes/ribbone.php"); ?>
			</div>
		</div>
		</div>
	</main>
	<?php require_once(TEMPLATE_FRONT.DS."footer.php"); ?>
</body>
</html>