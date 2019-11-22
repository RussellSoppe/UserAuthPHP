<?php  

if(isset($_SESSION['user_register']) && $_SESSION['user_register'][0] == true):?>

	<div>Success</div>

<?php elseif(isset($_SESSION['user_register']) && $_SESSION['user_register'][0] == false): ?>

	<div class='alert alert-warning'> <?php echo htmlspecialchars($_SESSION['user_register'][1], ENT_COMPAT, 'UTF-8'); ?>
	</div>

<?php endif;?>

<section class="cred-section">	
	<div class="cred-form-container">	
		<form method="post" action="index.php?register=true">

			<table>
				<div class="cred-title-container">	
					<img src="src/inc/imgs/geardiamondlogo2.svg" width="50px" height="50px">
					<div class="cred-title-text"><h2>Register</h2></div>
				</div>
				<tr class="cred-field">
					<!-- <th><label for="firstname">First Name</label></th> -->
					<td><input type="text" id="firstname" name="firstname" placeholder="First Name" required></td>
				</tr>
				<tr class="cred-field">
					<!-- <th><label for="lastname">Last Name</label></th> -->
					<td><input type="text" id="lastname" name="lastname" placeholder="Last Name"required></td>
				</tr>
				<tr class="cred-field">
					<!-- <th><label for="Email">Email</label></th> -->
					<td><input type="email" id="Email" name="username" placeholder="Email"required></td>
				</tr>
				<tr class="cred-field">
					<!-- <th><label for="password">Password</label></th> -->
					<td><input type="password" id="password" name="password" placeholder="Password"required></td>
				</tr>
				<tr class="cred-field">
					<!-- <th><label for="re-password">Re-enter Password</label></th> -->
					<td><input type="password" id="re-password" name="re-password" placeholder="Re-enter Password"required></td>
				</tr>
				<tr style="display:none">
		            <th><label for="address">Address</label></th>
		            <td><input type="text" id="address" name="address" />
		            <p>Please leave this field blank</p></td>
		        </tr>
			</table>

			<input type="submit" name="register" class="btn btn-primary">

		</form>
	</div>
</section>