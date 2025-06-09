<section class="female padded-section">
	<div class="female__wrapper main-wrap">
		<div
			class="female__content center-content grid"
			data-spacing="800"
		>
			<div>
				<p class="section-subtitle">Imprenditoria</p>
				<h2 class="section-title">Femminile</h2>
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

			<a
				href="<?= client_url('/about-us#female-entrepreneurship') ?>"
				class="button"
			>Leggi di più</a>
		</div>

		<div
			class="female__gallery grid"
			data-spacing="700"
		>

			<?php for ($i = 1; $i <= 4; $i++) { ?>

			<img
				class="female__image js-load load--fade-in"
				data-direction="<?= $femaleImagesDirections[$i] ?>"
				data-delay="<?= $i ?>"
				src="<?= client_path('female-image-' . $i . '.webp') ?>"
				alt=""
			>

			<?php } ?>

		</div>
	</div>
</section>
