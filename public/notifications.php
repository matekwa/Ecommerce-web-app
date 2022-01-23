<?php require_once("../resources/config.php");
 if(!isset($_SESSION["ID"])) redirect("login.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>SwiftShop.com</title>
	<?php require_once(TEMPLATE_FRONT.DS."metadata.php"); ?>
</head>
<body>
	 <?php include (TEMPLATE_FRONT."/user_nav.php"); ?>
	 <main>
	 	<div class="container">
	 		<form id="message_form" method="post">
		 		<div class="form-group">
		 			<label>Enter title</label>
		 			<input type="text" name="title" id="title" class="form-control">
		 		</div>
		 		<div class="form-group">
		 			<label>Enter Message</label>
		 			<textarea name="message" id="message" row="5" class="form-control"></textarea>
		 		</div>
		 		<div class="form-group">
		 			<input type="submit" name="submit" id="post" class="btn btn-primary" value="Submit message">
		 		</div>
	 		</form>
	 	</div>
	 </main>
	 <?php require_once(TEMPLATE_FRONT.DS."footer.php"); ?>
 <script type="text/javascript">
	$(document).ready(function(){

		function showunreadnotifications(option=''){
			$.ajax({
					url:"../resources/fetch.php",
					method:"post",
					data:{option: option},
					dataType:'json',
					success: function(data){ 
						$('.notf').html(data.notification);
						if (data.unreadNotifications > 0) {
							$('#notification_count').html(data.unreadNotifications);
						}
					}
				})
		}
		$('#message_form').on('submit',function(event){
			event.preventDefault();
			let formData = $(this).serialize();
			if ($('#title').val() != '' && $('#message') != '') {
				$.ajax({
					url:"../resources/insert.php",
					method:"post",
					data:formData,
					success: function(data){
						$('#message_form')[0].reset();
						showunreadnotifications();
					}
				})
			} else{
				alert ("Gotta fill all the data first");
			}
		})
	});
</script>
</body>
</html>