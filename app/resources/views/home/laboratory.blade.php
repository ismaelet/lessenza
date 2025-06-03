<section class="laboratory padded-section">
	<div class="grid-flow center-content main-wrap">
		<p class="section-subtitle">il nostro</p>
		<h2 class="laboratory__title section-title">Laboratorio</h2>

		<p class="laboratory__text page-text mar-t-3">
			E’ alla costante ricerca di un prodotto etico, senza Alcohol, che non provochi schiuma, che non intasi con i residui gli impianti dosazione e quindi non produca danni alle pompe dosatrici.<br>
			La pluriennale esperienza nel settore messa a disposizione dei nostri ricercatori ci consentono di ottenere un prodotto biodegradabile mettendo un accento sulla salvaguardia dell’ambiente!
		</p>
	</div>

	<div class="laboratory__gallery">

		<?php for ($i = 1; $i <= 5; $i++) { ?>

			<img class="laboratory__image js-load load--fade-in" src="<?= client_path('laboratory/image-' . $i) ?>" alt="" data-direction="bottom">

		<?php } ?>

	</div>
</section>