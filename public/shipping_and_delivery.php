<?php require_once("../resources/config.php");
    if(!isset($_SESSION["ID"])) redirect("login.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Shipping Poliocy</title>
	<?php require_once(TEMPLATE_FRONT.DS."metadata.php"); ?>
</head>
<body>
	 <?php include (TEMPLATE_FRONT."/user_nav.php"); ?>
	 <div class="container-fluid">
    <hr style="border-color: var(--primary-color);margin-top: 0px;">
        <br>
        <div style="width:100%; height: 63px; text-align: center; margin: 0 auto;">
            <h1 style="color: var(--primary-color);">Delivery Times</h1>
        </div>
        <br>
        <p style="text-align: left; font-size: 17px;">
            <?php $user = $_SESSION['Username'] ?>
          Thank you for stopping by <?php echo $user;?>,
            <br />
            <ul class="funky" style="font-size: 17px; text-align: left;">
                <li>The delivery time starts from the day you place your order to the day we make first attempt to deliver to you.<br> <strong>3 attempts will be done for delivery and the orders will be canceled after 7 days if not collected.</strong></li>
                <li>Business days are from Monday to Friday, and do not include weekends or public holidays.</li>
                <li>We however do attempt delivery on Saturdays. Therefore,your item will generally be available for collection within 1-4 business days.</li>
                <li>We currently do deliveries through the nearest pick-up stations near you,<b>we however do door to door deliveries for customers around Maseno University.</b></li>
                <li><b>Note that we use your shipping and delivery Information to find your nearest pick-up station,therefore ensure the information you give us is correct.</b></li>
            </ul>
        </p>
        <br />
        <br/>
	 </div>
	<?php require_once(TEMPLATE_FRONT.DS."footer.php"); ?>
</body>
</html>