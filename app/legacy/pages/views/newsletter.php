<?php if (!$sent) { ?>

	{% block form-body %}

	<div class="form-field">
		<input type="text" data-size="2" name="firstName" placeholder="Nome" required>
		<input type="text" data-size="2" name="lastName" placeholder="Cognome" required>
	</div>

	<div class="form-field">
		<input type="email" data-size="4" name="email" placeholder="Indirizzo e-mail" required>
	</div>

	{% end form-body %}


	{% block form-footer %}

	<button class="button" name="submit">Registrati</button>

	{% end form-footer %}

<?php } else { ?>

	{% block form-body %}

	<p class="confirmation-message">Grazie per la registrazione, riceverai una tanica in omaggio sul tuo primo ordine!</p>

	{% end form-body %}

<?php } ?>