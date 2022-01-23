<?php 
	require_once '../resources/config.php';
	 if(!isset($_SESSION["ID"])) redirect("login.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Buy on swifftShop</title>
	<?php require_once(TEMPLATE_FRONT.DS."metadata.php"); ?>
</head>
<body>
<main>
	<?php require_once(TEMPLATE_FRONT.DS."user_nav.php"); ?>
	<div class="container-fluid">
		<?php get_brand_name(); ?>
		<div id="message">
			
		</div>
		<div class="row">
			<?php get_product_to_brands_page();?>
		</div>
	</div>		
</main>
	<?php require_once(TEMPLATE_FRONT.DS."footer.php"); ?>
</body>
</html>