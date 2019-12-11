<!DOCTYPE html>
<html>
<head>
	<title>User Auth OOP Example</title>
	
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="src/inc/style.css">
	
	<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="inc/style.css">
</head>
<body>

<header id="header">
	<nav id="nav">
		<ul id="nav-ul">
			<li class="nav-li">
				<div class="nav-icon-container">
					<img class="nav-icon" src="src/inc/imgs/home.svg">
				</div>
				<a href="index.php">Home</a>
			</li>

			<?php if(isset($_SESSION['user_auth'])):?>

				<li class="nav-li">
					<div class="nav-icon-container">
						<img class="nav-icon" src="src/inc/imgs/lock-locked.svg">
					</div>
					<a href="<?php echo UserAuthControl::logout(); ?>">Logout</a>
				</li>
		
			<?php  else:?>

				<li class="nav-li">
					<div class="nav-icon-container">
						<img class="nav-icon" src="src/inc/imgs/register.svg">
					</div>
					<a href="index.php?register='true'">Register</a>
				</li>

				<li class="nav-li">
					<div class="nav-icon-container">
						<img class="nav-icon" src="src/inc/imgs/lock-locked.svg">
					</div>
					<a href="index.php?login='true'">Login</a>
				</li>

			<?php  endif; ?>
			
		</ul>
	</nav>
	<section class="title">	
		<h1>Secure User</h1>
	</section>
</header>