/**Best Selling Slider**/
$('.bestselling_slider').not(".slick-intialized").slick({
	prevArrow:".slider2prev",
	nextArrow:".slider2next",
	slidesToShow:5,
	slidesToScroll:1,
	autoplaySpeed:3000,
	responsive:[
		{
			breakpoint:965,
			settings:{
				slidesToShow:4
			}
		},
		{
			breakpoint:700,
			settings:{
				slidesToShow:3
			}
		},
		{
			breakpoint:520,
			settings:{
				slidesToShow:1
			}
		}
	]
});

/********Third Slider**/
$('.slider3').not(".slick-intialized").slick({
	prevArrow:".slider3prev",
	nextArrow:".slider3next",
	slidesToShow:5,
	slidesToScroll:1,
	autoplaySpeed:3000,
	responsive:[
		{
			breakpoint:768,
			settings:{
				slidesToShow:4
			}
		},
		{
			breakpoint:520,
			settings:{
				slidesToShow:2
			}
		},
		{
			breakpoint:0,
			settings:{
				slidesToShow:1
			}
		}
	]
});


$(document).ready(function(){

	//Animation On Scroll
	AOS.init();


	$(".rpc i,.review-bg").click(function(){
		$(".review-modal").fadeOut();
	})
});
/**************
$('.product1-slider').not(".slick-intialized").slick({
	prevArrow:".prev",
	nextArrow:".next",
});
 ***Product1 Slider**/


/**********
$(function () {
	$('[data-toggle="tooltip"]').tooltip();
});
 ***Tool tips**/



/**************************************Signing Up Jquery*******************

$(document).ready(function() {
	
	$('#userSignUp').click(function(){
		var emailAddress = $('#email').val();
		var emailPassword = $('#password').val();
		
		$.ajax(
		{
			type:'POST',
			url:'userAccount.php',
			data:{email:emailAddress,password:emailPassword},
			success: function(data){
				$('#helloSignUp').html(data);
			}
		})
	})
})
 **********************/