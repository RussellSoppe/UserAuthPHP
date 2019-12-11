<?php 

session_start();

// Initial Logic and Setup
include('src/config.php');
require_once __DIR__ . '/vendor/autoload.php';

UserAuth::userSession($database);

if(isset($_SESSION['user_auth'])){

	$id = $_SESSION['user_auth'][1];
	$user = new User($id);
}


// Begin Markup
include('views/header.php');

if(isset($_SESSION['user_auth']) && $_SESSION['user_auth'][0]){

	include('views/userprofile.php');

}else{

	include('views/content.php');
	
}

include('views/footer.php');
