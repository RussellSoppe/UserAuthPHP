
<main>

	<?php 	if(!isset($_GET['register']) && !isset($_GET['login'])): ?>

		<section class="background-content-container">	

				<div class="background-content">
					<?php include('elements/securecarousel.php'); ?>	
				</div>

				<?php include('elements/about.php'); ?>

		</section>

	<?php 	endif; ?>


	<?php 	if(isset($_GET['register']) || isset($_GET['login'])): ?>
		<!-- User Process -->
		<section class="background-content-container">	

			<div class="background-content-wrapper">	

				<div class="background-content">
					<?php include('elements/securecarousel.php'); ?>
				</div>

				<?php include('elements/about.php'); ?>

			</div>

				<?php if(isset($_GET['register'])):?>
		
					<?php include('register.php'); ?>

				<?php elseif(isset($_GET['login'])):?>

					<?php include('login.php'); ?>

				<?php endif; ?>

		</section>

	<?php 	endif; ?>

	</section>
	
</main>



