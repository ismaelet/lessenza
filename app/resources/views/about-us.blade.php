@pushOnce('styles')
	<link
		rel="stylesheet"
		href="{{ asset('css/legacy/about-us.css') }}"
	>
@endpushOnce

<x-layouts.legacy-main
	:$title
	:$location
	:headerConfig="['floating' => true]"
>
	<x-page-header
		class="dark"
		image="about-us-background.webp"
		:$title
	/>

	<section class="section1 full-width page-section">
		<div
			class="section1__content section__content grid"
			data-spacing="800"
			data-align="center"
			id="female-entrepreneurship"
		>
			<div class="section1__text-block section__text-block grid">
				<div>
					<x-subheading.section
						class="load--fade-in js-load"
						data-delay="1"
						data-direction="top"
					>Imprenditoria</x-subheading.section>
					<x-heading.section
						class="load--fade-in js-load"
						data-delay="0"
						data-direction="top"
					>Femminile</x-heading.section>
				</div>

				<p
					class="load--fade-in js-load"
					data-delay="2"
					data-direction="top"
				>
					Il settore delle SPA e dei Centri Benessere è un mondo quasi esclusivamente seguito degli uomini. L’Essenza va
					contro tendenza dando ampio spazio al lavoro femminile.<br>
					Sono Stefania e sono madre di tre figli: Veronica, Marilena e Giacomo.<br>
					Le due sorelle “Grandi” si sono appassionate al progetto, e mi auguro vogliano proseguire in futuro questo
					splendido percorso.
					Marilena 9 anni, già appassionata di “Essenze”, chiede e ricorda gli effetti benefici delle singole piante e
					prova a combinare le nostre profumazioni.<br>
					Veronica, più artistica, ha voluto prendere parte all’azienda con la scelta del LOGO a Goccia e Corona che ci
					caratterizza.<br><br>
					LUNGA VITA ALLE DONNE!
				</p>
			</div>

			<div class="section1__image-block section__image-block center-content stack-content grid">
				<div
					class="section1__background load--fade-in js-load"
					data-delay="4"
					data-direction="right"
				></div>
				<img
					class="section1__image section__image image-cover load--fade-in js-load"
					data-delay="1"
					data-direction="right"
					src="{{ Vite::image('about-us-stefania.webp') }}"
					alt=""
				>
			</div>
		</div>
	</section>

	<section class="section2 page-section">
		<div class="">
			<div
				class="section2__content section__content grid"
				data-align="center"
			>

				<div class="section2__image-block section__image-block center-content stack-content grid">
					<div
						class="section2__background load--fade-in js-load"
						data-delay="0"
						data-direction="top"
					></div>
					<img
						class="section2__image section__image image-cover load--fade-in js-load"
						data-delay="1"
						data-direction="right"
						src="{{ Vite::image('about-us-lucio.webp') }}"
						alt=""
					>
				</div>

				<div class="section2__text-block section__text-block grid">
					<div>
						<x-subheading.section
							class="load--fade-in js-load"
							data-delay="1"
							data-direction="top"
						>La nostra</x-subheading.section>
						<x-heading.section
							class="load--fade-in js-load"
							data-delay="0"
							data-direction="top"
						>Storia</x-heading.section>
					</div>

					<p
						class="load--fade-in js-load"
						data-delay="1"
						data-direction="top"
					>
						Mi chiamo Lucio e sono il compagno di vita di Stefania con la quale nel 2019 ho fondato l’azienda l’Essenza
						S.r.l.s..<br>
						Ho iniziato a lavorare nel 2005 per aziende che si occupano della costruzione di ambienti wellness, piscine ed
						aree termali.<br>
						Ho partecipato alla realizzazione di decine di aree benessere con il ruolo di responsabile tecnico.<br>
						Ho trasmesso in questi ultimi 5 anni la mia passione per il settore a Stefania che, pazientemente, ha preso in
						mano le redini dell’azienda.<br><br>

						<span class="fy-italic">Come mai questa scelta?</span><br><br>

						Nel corso di questi ultimi 20 anni quasi tutti gli hotel hanno investito in un area benessere con cabine e docce
						“emozionali” dotate di <span class="fw-bold">impianti aromatizzanti</span>. Abbiamo pertanto ritenuto
						interessante concentrarci su questo particolare settore, creando una linea di “Essenze” per l’aromatizzazione
						delle cabine wellness come il <span class="fw-bold">Bagno Turco</span>, le <span class="fw-bold">Saune</span> e
						le <span class="fw-bold">Docce emozionali</span>.
					</p>
				</div>
			</div>
	</section>
</x-layouts.legacy-main>
