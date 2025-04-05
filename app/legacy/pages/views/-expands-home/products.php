<?php

use Ecommerce\ViewManager;

?>

<section class="products padded-section">
	<div class="grid-flow center-content main-wrap" data-spacing="800">
		<div class="fill-width">
			<p class="section-subtitle">Scopri le</p>
			<h2 class="section-title">Fragranze</h2>
		</div>

		<div class="products__video-wrapper grid-flow" data-spacing="800">
			<a class="products__video" href="<?= client_url('/shop') ?>">
				<video class="image-fit" src="<?= client_path('ad.mp4') ?>" autoplay muted loop playsinline></video>
			</a>

			<p class="page-text">Le “Essenze” sono fragranze ricavate in laboratorio principalmente dalla spremitura di olii essenziali in corrente di vapore appositamente trattati ed emulsionati con acqua di fonte e pertanto PRONTI ALL’USO.
				La particolarità delle fragranze prodotte da L’Essenza rispetto agli altri produttori risiede nella totale ASSENZA di ALCOHOL, la BIODEGRADABILITA’ AL 100%, l’ASSENZA DI SCHIUMA, la quasi ASSENZA DI ALLERGENI, la NON OLEOSITA’ che EVITA DANNI ALLE POMPE DOSATRICI degli impianti aroma e quindi EVITA aggravi di COSTI ai gestori per via delle manutenzioni straordinarie.
			</p>
		</div>

		<div class="products__list grid-flow fill-width">

			<?php foreach ($products as $product) {
				echo ViewManager::renderProductCard($product);
			} ?>

		</div>

		<a href="<?= client_url('/shop') ?>" class="button button--secondary">Vedi tutte</a>
	</div>
</section>