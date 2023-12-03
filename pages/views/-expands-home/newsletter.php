<section class="newsletter main-wrap">
	<form class="newsletter__body js-newsletter-form">
		<div class="newsletter__background background-fill" <?= background_image('newsletter/background') ?>></div>

		<div class="newsletter__title-block contrasting-background">
			<h2 class="newsletter__title section-title">Iscriviti alla<br>Newsletter</h2>
			<p class="newsletter__text">Riceverai subito una tanica in omaggio sul tuo primo ordine online</p>
		</div>

		<div class="newsletter__form-block">
			<div class="newsletter__form">
				<input type="text" name="fullName" class="newsletter__input js-newsletter-fullname" placeholder="Nome e cognome" required>
				<input type="email" name="email" class="newsletter__input js-newsletter-email" placeholder="Indirizzo e-mail" required>
			</div>
		</div>

		<div class="newsletter__button-block">
			<div class="newsletter__button button button--full-width js-newsletter-signup">Iscriviti</div>
			<div class="newsletter__button newsletter__button--success button button--full-width js-newsletter-success">Grazie per esserti iscritto!</div>
		</div>
	</form>
</section>