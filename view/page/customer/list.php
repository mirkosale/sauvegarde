<div class="container">

	<h2>Liste des clients</h2>
	<div class="row">
		<table class=" table table-striped">
		<tr>
			<th>Numéro</th>
			<th>Nom</th>
			<th>Prénom</th>
			<th>Téléphone</th>
			<th></th>
		</tr>
		<?php
		    // Affichage de chaque client
			foreach ($customers as $customer) {
				echo '<tr>';
				echo '<td>' . htmlspecialchars($customer['idContact']) . '</td>';
				echo '<td>' . htmlspecialchars($customer['conLastName']) . '</td>';
				echo '<td>' . htmlspecialchars($customer['conFirstName']) . '</td>';
				echo '<td>' . htmlspecialchars($customer['conPhone']) . '</td>';
				echo '<td><a href="index.php?controller=customer&action=detail&id=' . htmlspecialchars($customer['idContact']) .'"><span class="glyphicon glyphicon-zoom-in" aria-hidden="true"></span></a></td>';
				echo '</tr>';
			}
		?>
		</table>
	</div>
</div>