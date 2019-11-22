<?php  

if(isset($_SESSION['user_auth']) && $_SESSION['user_auth'][0] == true):?>

	<div>Success</div>

<?php elseif(isset($_SESSION['user_auth']) && $_SESSION['user_auth'][0] == false): ?>

	<div class='alert alert-warning'> <?php echo htmlspecialchars($_SESSION['user_auth'][1], ENT_COMPAT, 'UTF-8'); ?>
	</div>

<?php endif;?>

<section class="cred-section">

	<div class="cred-form-container">	
		<form method="post" action="index.php?login=true">
			<div class="cred-title-container">	
				<img src="src/inc/imgs/geardiamondlogo2.svg" width="50px" height="50px">
				<div class="cred-title-text">
					<h2>Login</h2>
				</div>
			</div>
			<table>
				
				<tr class="cred-field">
					<!-- <th><label for="username">Username</label></th> -->
					<td><input type="email" id="username" name="username" placeholder="Username/Email" required></td>
				</tr>
				<tr class="cred-field">
					<!-- <th><label for="password">Password</label></th> -->
					<td><input type="password" id="password" name="password" placeholder="Password" required></td>
				</tr>
				<tr style="display:none">
		            <th><label for="address">Address</label></th>
		            <td><input type="text" id="address" name="address" />
		            <p>Please leave this field blank</p></td>
		        </tr>
			</table>

			<input type="submit" name="login" class="btn btn-primary">

		</form>
	</div>
</section>