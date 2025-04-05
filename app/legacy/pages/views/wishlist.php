{% block main %}

<div class="page-content main-wrap pad-b-5">

	<h1 class="">
		Wishlist
		<?php if ($likes->num_rows) { ?>
			<span style="font-size: .9em;">(<?= $likes->num_rows ?>)</span>
		<?php } ?>
	</h1>

	<?php if ($likes->num_rows) { ?>
		<div class="favorites">
			<?php while ($row = $likes->fetch_assoc()) product_card($row['itemId'], 2) ?>
		</div>
	<?php } else { ?>
		<h3 class="empty txt-cen txt-1rem">Nessun prodotto aggiunto alla wishlist</h3>
		<a href="<?= client_url('/shop') ?>" class="sbtn push-center block mar-t-4">Esplora i nostri prodotti</a>
	<?php } ?>
</div>

{% end main %}