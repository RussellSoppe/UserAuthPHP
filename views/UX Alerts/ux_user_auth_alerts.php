<?php  

if(isset($_SESSION['user_auth']) && $_SESSION['user_auth'][0] == true):?>

	<div>Success</div>

<?php elseif(isset($_SESSION['user_auth']) && $_SESSION['user_auth'][0] == false): ?>

	<div class='alert alert-warning'> <?php echo htmlspecialchars($_SESSION['user_auth'][1], ENT_COMPAT, 'UTF-8'); ?>
	</div>

<?php endif;

