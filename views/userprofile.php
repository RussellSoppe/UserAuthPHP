
	<section class="user-profile-section">	
		<article class="user-profile-article">	
			<table class="user-profile-table">	
				<h1 class="userprofileheader">Personal Info</h1>
				<tr>				
					<th>First Name</th>				
					<td><?php echo htmlspecialchars($user->getFirstName()); ?></td>
				<tr>				
					<th>Last Name</th>				
					<td><?php echo htmlspecialchars($user->getLastName()); ?></td>
				</tr>
			</table>
			<table class="user-profile-table">	
				<h1 class="userprofileheader">Username/Email</h1>
				<tr>				
					<th>Primary</th>				
					<td><?php echo htmlspecialchars($user->getUserName()); ?></td>
				</tr>
				<tr>					
					<th>Secondary</th>				
					<td></td>
				</tr>
			</table>
		</article>

		<article class="user-profile-article">
			<h1 class="userprofileheader">Change Email/Username</h1>
			<form class="user-profile-form">
				<input id="new-email" type="text" name="new-email" placeholder="New Email">
				<input type="hidden" name="address">
				<input id="new-email-submit" type="submit" name="Set New Email" value="Set New Email" disabled>
			</form>
		</article>

		<article class="user-profile-article">
			<h1 class="userprofileheader">Change Password</h1>
			<form class="user-profile-form">
				<input id="current-password" type="text" name="current-password" placeholder="Current Password">
				<input id="new-password" type="text" name="new-password" placeholder="New Password">
				<input id="new-password-repeat" type="text" name="new-password-repeat" placeholder="Repeat New Password">
				<input type="hidden" name="address">
				<input id="new-password-submit" type="submit" name="Set New Password" value="Set New Password" disabled>
			</form>
		</article>

	</section>

