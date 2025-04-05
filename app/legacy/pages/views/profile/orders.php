<?php

use Ecommerce\ViewManager;

?>

{% block content %}

<div class="page-block">
	<section>
		<h2 class="section-title mar-b-2">
			<?= icon_embed('orders') ?>
			I miei ordini
		</h2>

		<?= ViewManager::renderCartList() ?>

	</section>
</div>

{% end content %}