<?php

use Ecommerce\ViewManager;

if ($relatedProducts) { ?>

	<section class="related-items">
		<div class="main-wrap">
			<div class="related-items_header">
				<h2 class="section-title section-title--small">Potrebbero <span class="fy-italic fw-medium">interessarti</span></h2>
			</div>

			<div class="grid mar-t-3" data-columns="15rem" data-spacing="400">

				<?php foreach ($relatedProducts as $relatedProduct) {
					echo ViewManager::renderProductCard($relatedProduct);
				} ?>

			</div>
		</div>
	</section>

<?php } ?>