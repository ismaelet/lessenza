{% block content %}

<div class="page-block">
	<section>
		<h2 class="section-title mar-b-2">
			<?= embed_svg('user-circle') ?>
			I miei dati
		</h2>

		<div class="grid-flow" data-spacing="700">
			<form id="user-data" class="form-inputs grid-flow" data-spacing="400" method="POST">
				<div class="grid-flow" data-spacing="200">
					<?php generate_form($dataInputs, false, $error, $done) ?>
				</div>

				<button type="submit" class="button button--small place-center" name="edit-data">Modifica</button>
			</form>

			<form id="password-edit" class="grid-flow" data-spacing="400" method="POST">
				<h3 class="section-title section-title--small">Modifica la password</h3>
				<div class="grid-flow" data-spacing="200">
					<?php generate_form($passwordInputs, false, $error, $done) ?>
				</div>

				<button type="submit" class="button button--small place-center" name="edit-password">Modifica</button>
			</form>
		</div>
	</section>
</div>

{% end content %}