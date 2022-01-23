<?php 
	require_once '../resources/config.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Star Rating</title>
	<?php require_once(TEMPLATE_FRONT.DS."metadata.php"); ?>
	<style type="text/css">
		html,body{
			display: grid;
			height: 50%;
			place-items:center;
			text-align: center;
			background: #000;
		}
		header{
			background: #000;
		}
		.container{
			position: relative;
			width: 400px;
			background: #111;
			padding: 20px 30px;
			border: 1px solid #444;
			border-radius: 5px;
			display: flex;
			align-items: center;
			justify-content: center;
			flex-direction: column;
		}
		.container .text{
			font-size: 25px;
			color: #666;
			font-weight: 500;
		}
		.container .edit{
			position: absolute;
			right: 10px;
			top: 5px;
			font-size: 16px;
			color: #666;
			font-weight: 500;
			cursor: pointer;
		}
		.container .edit:hover{
			text-decoration: underline;
		}
		.container .post{
			display: none;
		}
		.container .star-widget input{
			display: none;
		}
		.star-widget label{
			font-size: 40px;
			color: #444;
			padding: 10px;
			float: right;
			transition: all 0.2s ease;
		}
		input:not(:checked) ~ label:hover,
		input:not(:checked) ~ label:hover ~ label{
			color: #fd4;
		}
		input:checked ~ label{
			color: #fd4;
		}
		input#rate-5:checked ~ label{
			color: #fe7;
			text-shadow: 0 0 20px #952;
		}
		input#rate-1:checked ~ form header:before{
			content: "I just hate it 😠";
		}
		input#rate-2:checked ~ form header:before{
			content: "I don`t like it 😒";
		}
		input#rate-3:checked ~ form header:before{
			content: "It is awesome 😄";
		}
		input#rate-4:checked ~ form header:before{
			content: "I just like it 😎";
		}
		input#rate-5:checked ~ form header:before{
			content: "I just love it 😍";
		}
		.container form{
			display: none;
		}
		input:checked~form{
			display: block;
		}
		form header{
			width: 100%;
			font-size: 20px;
			color: #fe7;
			font-weight: 500;
			margin: 5px 0 25px 0;
			text-align: center;
			transition: all 0.2s ease;
		}
		form .textarea{
			height: 100px;
			width: 100%;
			overflow: hidden;
		}
		form .textarea textarea{
			height: 100%;
			width: 100%;
			outline: none;
			color: #eee;
			border: 1px solid #333;
			background: #222;
			padding: 10px;
			font-size: 17px;
			resize: none;
		}
		form .btn{
			height: 45px;
			width: 100%;
			margin: 15px 0;
		}
		form .btn button{
			height: 100%;
			width: 100%;
			border: 1px solid #444;
			outline: none;
			background: #222;
			color: #999;
			font-size: 17px;
			font-weight: 500;
			text-transform: uppercase;
			cursor: pointer;
			transition: all 0.3s ease;
		}
		form .btn button:hover{
			background: #1b1b1b;
		}

		@media only screen and (max-width: 750px){		
		.container{
			width: 300px;
			padding: 15px 20px;
		}
		.container .text{
			font-size: 20px;
		}
		.container .edit{
			right: 10px;
			top: 5px;
			font-size: 13px;
		}
		.star-widget label{
			font-size: 30px;
			padding: 5px;
		}
		form header{
			width: 100%;
			font-size: 15px;
			margin: 50px 0 2px 0;
		}
		form .textarea textarea{
			padding: 5px;
			font-size: 15px;
		}
		form .btn{
			height: 45px;
			width: 100%;
			margin: 13px 0;
		}
		form .btn button{
			font-size: 12px;
		}
	}
	</style>
</head>
<body>
	<div class="container">
		<div class="Post">
			<div class="text">Thanks for rating!</div>
			<div class="edit">Edit</div>
		</div>
		<div class="star-widget">
			<input type="radio" name="rate" id="rate-5">
			<label for="rate-5" class="fa fa-star"></label>
			<input type="radio" name="rate" id="rate-4">
			<label for="rate-4" class="fa fa-star"></label>
			<input type="radio" name="rate" id="rate-3">
			<label for="rate-3" class="fa fa-star"></label>
			<input type="radio" name="rate" id="rate-2">
			<label for="rate-2" class="fa fa-star"></label>
			<input type="radio" name="rate" id="rate-1">
			<label for="rate-1" class="fa fa-star"></label>
			<form action="">
				<header></header>
				<div class="textarea">
					<textarea cols="30" placeholder="Describe.."></textarea>
				</div>
				<div class="btn">
					<button type="button">Post</button>
				</div>
			</form>
		</div>
	</div>
	<script type="text/javascript">
		const btn = document.querySelector("button");
		const post = document.querySelector(".post");
		const widget = document.querySelector(".star-widget");
		const editBtn = document.querySelector(".edit");
		btn.onclick =()=>{
			widget.style.display = "none";
			post.style.display = "block";
			editBtn.onclick =()=>{
			widget.style.display = "block";
			post.style.display = "none";
		}
			return false;
		}
	</script>
</body>
</html>