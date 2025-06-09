@pushOnce('styles')
	<link
		rel="stylesheet"
		href="{{ asset('css/legacy/home-newsletter.css') }}"
	>
@endpushOnce

<section class="newsletter main-wrap">
	<form class="newsletter__body js-newsletter-form dark">
		<div
			class="newsletter__background background-fill"
			<?= background_image('home/newsletter-background.webp') ?>
		></div>

		<div class="newsletter__title-block contrasting-background">
			<x-heading.section class="newsletter__title">Iscriviti alla<br>Newsletter</x-heading.section>
			<p class="newsletter__text">Riceverai subito una tanica in omaggio sul tuo primo ordine online</p>
		</div>

		<div class="newsletter__form-block">
			<div class="newsletter__form">
				<input
					type="text"
					name="fullName"
					class="newsletter__input js-newsletter-fullname transition-colors"
					placeholder="Nome e cognome"
					required
				>
				<input
					type="email"
					name="email"
					class="newsletter__input js-newsletter-email transition-colors"
					placeholder="Indirizzo e-mail"
					required
				>
			</div>
		</div>

		<div class="newsletter__button-block">
			<x-button class="newsletter__button button button--full-width js-newsletter-signup w-full">Iscriviti</x-button>
			<x-button
				class="newsletter__button newsletter__button--success button button--full-width js-newsletter-success w-full"
			>Grazie
				per esserti iscritto!</x-button>
		</div>
	</form>
</section>
