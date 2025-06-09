@php
	$femaleImagesDirections = ['left', 'top', 'right', 'bottom'];
@endphp

@pushOnce('styles')
	<link
		rel="stylesheet"
		href="{{ asset('css/legacy/home-female.css') }}"
	>
@endpushOnce

<section class="female padded-section breakout">
	<div class="female__wrapper main-wrap">
		<div
			class="female__content grid"
			data-spacing="800"
		>
			<div>
				<x-subheading.section>Imprenditoria</x-subheading.section>
				<x-heading.section>Femminile</x-heading.section>
			</div>

			<div class="female__text-wrapper">
				<p class="female__text page-text">
					Il settore delle SPA e dei Centri Benessere è un mondo quasi esclusivamente seguito degli uomini. L’Essenza va
					contro tendenza dando ampio spazio al lavoro femminile.<br>
					Sono Stefania e sono madre di tre figli: Veronica, Marilena e Giacomo.<br>
					Le due sorelle “Grandi” si sono appassionate al progetto, e mi auguro vogliano proseguire in futuro questo
					splendido percorso.
					Marilena 9 anni, già appassionata di “Essenze”, chiede e ricorda gli effetti benefici delle singole piante e prova
					a combinare le nostre profumazioni.<br>
					Veronica, più artistica, ha voluto prendere parte all’azienda con la scelta del LOGO a Goccia e Corona che ci
					caratterizza.<br><br>
					LUNGA VITA ALLE DONNE!
				</p>
			</div>

			<x-button
				href="{{ route('about-us') . '#female-entrepreneurship' }}"
				class="button"
			>Leggi di più</x-button>
		</div>

		<div
			class="female__gallery grid"
			data-spacing="700"
		>

			@foreach ($femaleImagesDirections as $id => $direction)
				<img
					class="female__image js-load load--fade-in"
					data-direction="{{ $direction }}"
					data-delay="{{ $id + 1 }}"
					src="{{ Vite::image('home/female-image-' . ($id + 1) . '.webp') }}"
					alt=""
				>
			@endforeach

		</div>
	</div>
</section>
