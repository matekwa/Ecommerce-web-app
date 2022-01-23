<?php require_once("../resources/config.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>SwiftShop.com</title>
    <?php require_once(TEMPLATE_FRONT.DS."metadata.php"); ?>
</head>
<body>
<main>
    <?php require_once(TEMPLATE_FRONT.DS."simple_header.php"); ?>
    <div class="loginbox">
        <h1 class="">Log in</h1>
        <form id="logInForm" onsubmit="return false">
                    <div class="textbox">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                         <input type="email" placeholder="Email" id="userEmail"><br>
                         <small>Error</small>
                    </div>
                    <div class="textbox">
                        <i class="fa fa-lock" aria-hidden="true"></i>
                        <input type="password" id="passcode" autocomplete="autocomplete" placeholder="Account Password?"><br>
                        <small>Error</small>
                    </div>
            <span id="back"></span>
            <div id="footer_card">
               <div class="textbox">
                    <button id="logInBtn" class="signin_btn">Sign in</button>
               </div>
                <p class="hint-text"><a href="recover.php">Forgot Password?</a></p><br>
                <div class="modal-footer bg-primary-color text-white">Don't have an account? <a href="create_account.php" style="color: yellow">Create one</a></div>
            </div>
        </form>
</div>
</main>
</body>
<script type="text/javascript" src="../resources/login_script.js"></script>
</html>