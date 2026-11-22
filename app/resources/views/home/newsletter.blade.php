@pushOnce('styles')
	@vite('resources/css/storefront/home-newsletter.css')
@endpushOnce

<section class="newsletter main-wrap">
	<form class="newsletter__body js-newsletter-form dark">
		<div
			class="newsletter__background background-fill"
			<?= background_image('home/newsletter-background.webp') ?>
		></div>

		<div class="newsletter__title-block contrasting-background">
			<x-heading.section class="newsletter__title">{{ __('Iscriviti alla') }}<br>Newsletter</x-heading.section>
			<p class="newsletter__text">{{ __('Riceverai subito una tanica in omaggio sul tuo primo ordine online') }}</p>
		</div>

		<div class="newsletter__form-block">
			<div class="newsletter__form">
				<input
					type="text"
					name="fullName"
					class="newsletter__input js-newsletter-fullname transition-colors"
					placeholder="{{ __('Nome e cognome') }}"
					required
				>
				<input
					type="email"
					name="email"
					class="newsletter__input js-newsletter-email transition-colors"
					placeholder="{{ __('Indirizzo e-mail') }}"
					required
				>
			</div>
		</div>

		<div class="newsletter__button-block">
			<x-button class="newsletter__button button button--full-width js-newsletter-signup w-full">{{ __('Iscriviti') }}</x-button>
			<x-button
				class="newsletter__button newsletter__button--success button button--full-width js-newsletter-success w-full"
			>{{ __('Grazie per esserti iscritto!') }}</x-button>
		</div>
	</form>
</section>
