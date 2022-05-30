<div class="container">

	<h2>Contact</h2>
	<!-- Three columns of text below the carousel -->
	<div class="row">
		<div class="col-lg-5 col-md-6 col-sm-8 col-xs-12">
			<form method="post" action="?controller=home&action=check">
				<div class="form-group">
					<label for="firstName">Prénom</label>
					<input type="text" name="firstName" class="form-control" id="firstName" />
				</div>
				<div class="form-group">
					<label for="lastName">Nom</label>
					<input type="text" name="lastName" class="form-control" id="lastName" />
				</div>
				<div class="form-group">
					<label for="answer">Question, remarque</label>
					<textarea id="answer" class="form-control" name="answer"></textarea>
				</div>
				<button type="submit" class="btn btn-default" name="submitButton">Envoyer le formulaire</button>
			</form>
		</div>
	</div>

