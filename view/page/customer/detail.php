<div class="container">

	<h2>
		<?php
			echo $customer['conLastName'] . ' ' . $customer['conFirstName'];
		?>
	</h2>
	<!-- Three columns of text below the carousel -->
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<?php
			echo '<p>Téléphone : ' . $customer['conPhone'] . '</p>';
			echo '<p>Mail : ' . $customer['conEmail'] . '</p>';

		?>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<a href="index.php?controller=customer&action=list">Retour à la liste des clients</a>
		</div>
	</div>
</div>