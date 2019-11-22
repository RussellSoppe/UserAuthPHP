

<body>


<?php  

	echo 'Content Here';

	
	if(isset($_GET['register'])){

		include('register.php');

	}elseif(isset($_GET['login'])){

		include('login.php');
	}


/*

$_SERVER - Get or Post creates issues
Could use Get or Post to create a $_SESSION or $_COOKIE but that creates other headaches for tracking - maybe a quick and dirty version but not a great long term control

How to serve only data wanted, what is best way to control modules or views from backend?

*/

?>



</body>

