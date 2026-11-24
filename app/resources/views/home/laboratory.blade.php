@pushOnce('styles')
	@vite('resources/css/storefront/home-laboratory.css')
@endpushOnce

<section class="laboratory padded-section span-full-width">
	<div class="center-content main-wrap grid">
		<x-eyebrow>{{ __('il nostro') }}</x-eyebrow>
		<x-heading.section>{{ __('Laboratorio') }}</x-heading.section>

		<p class="laboratory__text page-text mar-t-3">
			{{ __('E’ alla costante ricerca di un prodotto etico, senza Alcohol, che non provochi schiuma, che non intasi con i residui gli impianti dosazione e quindi non produca danni alle pompe dosatrici.') }}<br>
			{{ __('La pluriennale esperienza nel settore messa a disposizione dei nostri ricercatori ci consentono di ottenere un prodotto biodegradabile mettendo un accento sulla salvaguardia dell’ambiente!') }}
		</p>
	</div>

	<div class="laboratory__gallery">

		@for ($i = 1; $i <= 5; $i++)
			<img
				class="laboratory__image js-load load--fade-in"
				src="{{ Vite::image('home/laboratory/image-' . $i . '.webp') }}"
				alt=""
				data-direction="bottom"
			>
		@endfor

	</div>
</section>
