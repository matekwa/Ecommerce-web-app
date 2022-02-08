
        var ratedIndex = -1;
        function resetColor(){
            $(".rps i").css("color","#e2e2e2");
        }
        function setStars(max){
        	for (var i = 0; i <= max; i++) {
        		$(".rps i:eq("+ i + ")").css("color","#f7bf17");
        	}
        }
	$(document).ready(function(){
	$(".rpc i,.review-bg").click(function(){
		$(".review-modal").fadeOut();
	})
    $(".opmd").click(function (){
        $(".review-modal").fadeIn();
    })


    $(".rps i").mouseover(function(){
    	resetColor();
    	var currentIndex = parseInt($(this).data("index"));
    	setStars(currentIndex);
    })

    $(".rps i").on("click",function(){
    	 ratedIndex = parseInt($(this).data("index"));
    	localStorage.setItem("rating",ratedIndex);
    	$(".starRateV").val(parseInt(localStorage.getItem("rating")));
    })

    $(".rps i").mouseleave(function(){
    	resetColor();
    	if (ratedIndex != -1) {
    		setStars(ratedIndex);
    	}
    })

    if (localStorage.getItem("rating") != null) {
    	setStars(parseInt(localStorage.getItem("rating")));
    	$(".starRateV").val(parseInt(localStorage.getItem("rating")));
    }

    $(".rpbtn").click(function(){
    	if ($("#rate_message").val() == '') {
    		$(".rate-error").html("Please Fill in you description");
    	} else if ($(".raterName").val() == '') {
    		$(".rate-error").html("Please Enter your name.");
    	} else if (localStorage.getItem("rating") == null) {
    		$(".rate-error").html("Please Select a Star to Rate!");
    	} else{
    		$(".rate-error").html("");
            
            let starRate = document.getElementById('starRateV').value;
            let user_message = document.getElementById('rate_message').value;
            let user_name = document.getElementById('raterName').value;
            let date_review = document.getElementById('rateDate').value;
            let productId = document.getElementById('product_id').value;
            
        let ajax = myAjax("POST", "../resources/functions.php");
        ajax.onreadystatechange = function()
            {
                if (ajaxStatus(ajax) == true){
                  window.location.reload();
                }
            }
        ajax.send("starRate="+starRate+"&user_message="+user_message+"&user_name="+user_name+"&date_review="+date_review+"&productId="+productId);
    	}
    })

})
