<section class="history split-section span-full-width">
	<div class="split-section__image">
		<img
			class="fill-all image-cover"
			src="{{ Vite::image('home/history-image.webp') }}"
			alt=""
		>
	</div>

	<div
		class="split-section__content center-content background-fill grid"
		<?= background_image('home/history-background.webp') ?>
	>
		<div
			class="split-section__body grid"
			data-spacing="700"
		>
			<div>
				<x-subheading.section>La nostra</x-subheading.section>
				<x-heading.section>Storia</x-heading.section>
			</div>

			<p class="page-text">
				Mi chiamo Lucio e sono il compagno di vita di Stefania con la quale nel 2019 ho fondato l’azienda l’Essenza
				S.r.l.s..<br>
				Ho iniziato a lavorare nel 2005 per aziende che si occupano della costruzione di ambienti wellness, piscine ed aree
				termali.<br>
				Ho partecipato alla realizzazione di decine di aree benessere con il ruolo di responsabile tecnico.<br>
				Ho trasmesso in questi ultimi 5 anni la mia passione per il settore a Stefania che, pazientemente, ha preso in mano
				le redini dell’azienda.<br><br>

				<span class="fy-italic">Come mai questa scelta?</span><br><br>

				Nel corso di questi ultimi 20 anni quasi tutti gli hotel hanno investito in un area benessere con cabine e docce
				“emozionali” dotate di <span class="fw-bold">impianti aromatizzanti</span>. Abbiamo pertanto ritenuto interessante
				concentrarci su questo particolare settore, creando una linea di “Essenze” per l’aromatizzazione delle cabine
				wellness come il <span class="fw-bold">Bagno Turco</span>, le <span class="fw-bold">Saune</span> e le <span
					class="fw-bold"
				>Docce emozionali</span>.
			</p>

			<!-- <a class="text-link" href="<?= client_url('/about-us') ?>">leggi di più</a> -->
		</div>
	</div>
</section>
