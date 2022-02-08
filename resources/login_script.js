 const form = document.getElementById('logInForm');
    const email = document.getElementById('userEmail');
    const password = document.getElementById('passcode');

    form.addEventListener('submit',(e) =>{
        e.preventDefault();

        if (checkInputs() != false) {

            let Email = email.value.trim();
            let pass = password.value.trim();
           
            document.getElementById('footer_card').style.display = "none";
            document.getElementById('back').innerHTML = '<div class="lds-facebook"><div></div><div></div><div></div></div>';
            let login = myAjax("POST", "../resources/functions.php");
            login.onreadystatechange = function () {
                if (ajaxStatus(login) == true) {
                    if (login.responseText.replace(/^\s+|\s+$/g, "")  === "login_failed"){
                        document.getElementById('status').innerHTML = '<span style="color:red">Log In Failure!Try again</span>';
                        document.getElementById('footer_card').style.display = "block";
                        document.getElementById('back').innerHTML = 'none';
                        return false;
                    } else if(login.responseText.replace(/^\s+|\s+$/g, "") === "wrong_email"){
                        setErrorFor(email,"This E-mail does not exist in our system!");
                        return false;
                    } else if(login.responseText.replace(/^\s+|\s+$/g, "") === "password_mismatch"){
                        setErrorFor(password,"Wrong Password!");
                        return false;
                    }else {
                        window.location = "index.php?welcome";
                    }
                }
            }
            login.send("email_to_login="+Email+"&pass_to_log_in="+pass);
        } else{
            return false
        }
    });

        function checkInputs(){
        //get values from the inputs
        const emailValue = email.value.trim();
        const passwordValue = password.value.trim();

        if (emailValue === "") {
            //show error
            //add error class
            setErrorFor(email,"Email cannot be empty!");
            return false;
        } else if(/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(emailValue) == false) {
            setErrorFor(email,"Wrong E-mail Format!");
        } else{
            //add success class
            setSuccessFor(email);
        }

        if (passwordValue === "") {
            setErrorFor(password,"Password cannot be blank!");
            return false;
        } else{
            setSuccessFor(password);
        }
    }

    function setErrorFor(input,message){
        const login = input.parentElement; //.form_control
        const small = login.querySelector('small');
        //add error message inside small
        small.innerText = message;

        //add error class
        login.className = 'textbox error';
         document.getElementById('footer_card').style.display = "block";
         document.getElementById('back').innerHTML = "";
    }

    function setSuccessFor(input) {
        const formControl = input.parentElement;
        formControl.className = 'textbox success'; 
    }