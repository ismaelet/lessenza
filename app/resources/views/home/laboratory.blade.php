@pushOnce('styles')
	<link
		rel="stylesheet"
		href="{{ asset('css/legacy/home-laboratory.css') }}"
	>
@endpushOnce

<section class="laboratory padded-section span-full-width">
	<div class="center-content main-wrap grid">
		<x-subheading.section>il nostro</x-subheading.section>
		<x-heading.section>Laboratorio</x-heading.section>

		<p class="laboratory__text page-text mar-t-3">
			E’ alla costante ricerca di un prodotto etico, senza Alcohol, che non provochi schiuma, che non intasi con i residui
			gli impianti dosazione e quindi non produca danni alle pompe dosatrici.<br>
			La pluriennale esperienza nel settore messa a disposizione dei nostri ricercatori ci consentono di ottenere un
			prodotto biodegradabile mettendo un accento sulla salvaguardia dell’ambiente!
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
