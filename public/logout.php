<?php
require_once "../resources/config.php";
//set session data to empty array
$_SESSION = array();
//Expire cookie data files
/*if (isset($_COOKIE['ID']) && isset($_COOKIE['Username']) && isset($_COOKIE['Password'])){
    setcookie('ID',"",strtotime('-5days'),'/');
    setcookie('Username',"",strtotime('-5days'),'/');
    setcookie('Password',"",strtotime('-5days'),'/');
} */
//destroy session variables
session_destroy();
redirect("index.php");

