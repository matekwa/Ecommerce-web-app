<?php require_once("../resources/config.php");
    if(!isset($_SESSION["ID"])) redirect("login.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Return Policy | swifftshop.com</title>
	<?php require_once(TEMPLATE_FRONT.DS."metadata.php"); ?>
</head>
<body>
    <?php include (TEMPLATE_FRONT."/user_nav.php"); ?>
<div class="container">
 	 <h3 class="text-center">Returning an Item</h3>
 	 <div> You can initiate a return within 7 days after delivery / collection for Eligible reasons:<br/> 
 	 	<li>Eligible reasons - wrong, damaged, defective, incomplete, or counterfeit items.(Ensure items are reported within the shortest time possible to facilitate an easy return process).</li>
 	 	 <li style="font-weight: bold;">*Change of mind*- You cannot return items if you change your mind,wrong size or you do not like it.We hope you carefully confirm the Item before you place an order.</li><br/>When returning an item, Ensure all seals, tags and accessories are left intact and item is in its original packaging. 
 	 	<br/>
 	 	<li>Note that return fee is covered by the buyer.</li>
 	 	<li>Based on your intrest,the item will be replaced or you will be refunded as soon as return process is complete.</li>
 	 	<li>You can request for a return by calling the number <span style="color:blue;font-weight: 600;font-style: italic;">0745481760</span> or sending us an E-mail at <a href="mailto:returns@swifftshop.com">returns@swifftshop.com</a> indicating your reason for return and the order number.</li>
 	 </div>
</div>
<?php require_once(TEMPLATE_FRONT.DS."footer.php"); ?>
</body>
</html>
