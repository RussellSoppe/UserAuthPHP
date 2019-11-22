<?php
session_start();
include('src/config.php');

if(isset($_POST['register'])){
	$_SESSION['user_register'] = UserProcess::registerNewUser($_POST, $database);
}

if(isset($_POST['login'])){
	$_SESSION['user_auth'] = UserProcess::loginUser($_POST, $database);
}


include('views/header.php');

include('views/content.php');

include('views/footer.php');

