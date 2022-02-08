	const form = document.getElementById('form');
	const email = document.getElementById('email_to_register');
	const username = document.getElementById('userName');
	const phone = document.getElementById('phone_number');
	const pass_1 = document.getElementById('userPassword1');
	const pass_2 = document.getElementById('userPassword2');


	form.addEventListener('submit',(e) =>{
		e.preventDefault();

		checkInputs();

		
	    let emailValue = email.value.trim();
        let userName = username.value.trim();
        let pass1 = pass_1.value.trim();
        let pass2 = pass_2.value.trim();
        let gender = document.getElementById('gender').value;
        let county = document.getElementById('county').value;
        let phone_number = phone.value.trim().replace(/[^0-9]/g,"");
        if (gender.length == 0 || county.length == 0){
            document.getElementById("warning").innerHTML ='<p style ="color:#F00;font-weight: bold">Select  Gender and County!</p>';
            
        } else if (isChecked() == false) {
            document.getElementById("warning").innerHTML ='<div style ="color:#F00; font-weight: bold" class="alert alert-info"> Read the terms of use first. </div>';
           
        } else { 
            document.getElementById("card_footer").style.display = "none";
            document.getElementById("warning").innerHTML = '<div class="lds-facebook"><div></div><div></div><div></div></div>';
            let newuser = myAjax("POST", "../resources/functions.php");
            newuser.onreadystatechange = function()
            {
                if (ajaxStatus(newuser) == true){
                    if (newuser.responseText.replace(/^\s+|\s+$/g, "") != "signup_success"){
                        document.getElementById("warning").innerHTML = newuser.responseText;
                        document.getElementById("card_footer").style.display = "block";
                    } else {
                        window.scrollTo(0,0);
                        document.getElementById("createAccountForm").innerHTML = "Thank you <span style='font-weight: bold; font-style: italic'>" + userName + "</span>,check your email inbox at <span style='color: blue'>"+ emailValue + "</span> to activate your account, click on the link we just sent you to log into your account.";
                    }
                }
            }
            newuser.send("e="+emailValue+"&u="+userName+"&p1="+pass1+"&p2="+pass2+"&g="+gender+"&c="+county+"&p_n="+phone_number);
        }

	});

	function checkInputs(){
		//get values from the inputs
		const emailValue = email.value.trim();
		const usernameValue = username.value.trim();
		const phoneValue = phone.value.trim().replace(/[^0-9]/g,"");
		const pass_1Value = pass_1.value;
		const pass_2Value = pass_2.value;

		if (usernameValue === "") {
			//show error
			//add error class
			setErrorFor(username,"Username cannot be empty!");
		} else{
			//add success class
			setSuccessFor(username);
		}

		if (emailValue === "") {
			setErrorFor(email,"Email cannot be empty!");
		} else{
			setSuccessFor(email);
		}

		if (pass_1Value === "") {
			setErrorFor(pass_1,"Password cannot be empty!");
		} else{
			setSuccessFor(pass_1);
		}

		if (pass_2Value === "") {
			setErrorFor(pass_2,"This field cannot be empty!");
		} else if(pass_1Value !== pass_2Value){
			setErrorFor(pass_2,"Passwords does not match!");
			return false;
		} else{
			setSuccessFor(pass_2);
		}

		if (phoneValue ===  "") {
			document.getElementById("er").innerHTML = "<small style='color:red;'><i class='fas fa-exclamation-circle'></i>&nbsp;Cannot be empty</small>";
		} else if(phoneValue.length != 10){
			document.getElementById("er").innerHTML = "<small style='color:red;'><i class='fas fa-exclamation-circle'></i>&nbsp;Please enter correct Phone number!</small>";
			exit();
		}else{
			return true;
		}
	}


	function setErrorFor(input,message){
		const formControl = input.parentElement; //.form_control
		const small = formControl.querySelector('small');
		//add error message inside small
		small.innerText = message;

		//add error class
		formControl.className = 'form_control error';
	}

	function setSuccessFor(input) {
		const formControl = input.parentElement;
		formControl.className = 'form_control success'; 
	}

	function setSuccessUsername(input,message) {
		const formControl = input.parentElement;
		const small = formControl.querySelector('small');
		//add error message inside small
		small.innerText = message;
		formControl.className = 'form_control success_with_small'; 
	}

		function check_email(){
		let emailValue = email.value.trim();
        if (emailValue !== "") {
            let check_email = myAjax("POST", "../resources/functions.php");
            check_email.onreadystatechange =  function()
            {
                if (ajaxStatus(check_email) == true){
                	if (check_email.responseText.replace(/^\s+|\s+$/g, "") === "wrong_format") {
                		setErrorFor(email,"Wrong Email Format!");
                		exit();
                	} else if(check_email.responseText.replace(/^\s+|\s+$/g, "") === "exist") {
                		setErrorFor(email,"Email already in use by other account!");
                		exit();
                	} else{
                		setSuccessFor(email);
                	}
                }
            }
            check_email.send('email='+emailValue);
        } else{
        	setErrorFor(email,"Blank!");
        	exit();
        }
    }

    function checkUsername(){
    let userName =  username.value.trim();
    if (userName !== "") {
        let ajax = myAjax("POST", "../resources/functions.php");
        ajax.onreadystatechange =  function()
			{
			 if (ajaxStatus(ajax) == true){
				if (ajax.responseText.replace(/^\s+|\s+$/g, "") === 'ok') {
						setSuccessUsername(username, userName+" is OK");
                	}else{
                		setErrorFor(username,ajax.responseText);
            
                	}
			}
	}
	ajax.send('username_to_register='+userName);
} else{
	setErrorFor(username,"Blank!");
	exit();
}
}

function checkPassword() {
    let passcode = pass_1.value;
    if (passcode != "") {
        let verifyPass = myAjax("POST", "../resources/functions.php");
        verifyPass.onreadystatechange = function()
		 {
			if (ajaxStatus(verifyPass) == true) {
				if (verifyPass.responseText.replace(/^\s+|\s+$/g, "") === 'ok') {
						setSuccessUsername(pass_1,"Excellent!");
                	} else{
                		setErrorFor(pass_1,verifyPass.responseText);
                		
                	}
			}
		}
		verifyPass.send('passwordVerify='+passcode);
	} else{
		setErrorFor(pass_1,"Blank!");
	}
}