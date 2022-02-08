  
    ///////////AJAX helper function/////////////////////
function myAjax(method, url) {
    let x;
    try{
    // For Opera 8.0+,Firefox,Safari and chrome
    x = new XMLHttpRequest();
} catch(e){
    try{
        //For Internet Explore Browsers
    x = new ActiveXObject('Msxml2.XMLHTTP');
    } catch{
        try{
        x = new ActiveXObject("Microsoft.XMLHTTP");
            } catch(e){
                //Browser doesn't support AJAX object
                alert("Browser doesn't support JavaScript please get an updated browser.");
            }
    }
}
x.open(method,url,true);
x.setRequestHeader("Content-type","application/x-www-form-urlencoded");
return x;
}

function ajaxStatus(x) {
    if (x.readyState == 4 && x.status == 200) {
        return true;
    }
}



///////////////////////XXX/////////////AJAX helpet function////////XXXS/////////////



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
    	if ($("#rate-field").val() == '') {
    		$(".rate-error").html("Please Fill in you description");
    	} else if ($(".raterName").val() == '') {
    		$(".rate-error").html("Please Enter your name.");
    	} else if (localStorage.getItem("rating") == null) {
    		$(".rate-error").html("Please Select a Star to Rate!");
    	} else{
    		$(".rate-error").html("");

            let form = $(this).closest(".rmp");
            let starRate = form.find(".starRateV").val();
            let user_message = form.find(".rateMsg").val();
            let user_name = form.find(".raterName").val();
            let date = form.find(".rateDate").val();
            let productId = form.find(".productId").val();

        let ajax = myAjax("POST", "../resources/productRating.php");
        ajax.onreadystatechange = function () {
            if (ajaxStatus(ajax) == true) {
                console.log(ajax.responseText);
            }
        }
        ajax.send("starRate="+starRate+"&user_message="+user_message+"&user_name="+user_name+"&date="+date+"&productId="+productId);
    	}
    })

})