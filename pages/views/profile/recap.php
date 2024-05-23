<?php

use Ecommerce\ViewManager;

use function Ecommerce\customer;
use function Ecommerce\product_card;

?>

{% block content %}

<div class="page-block">
	<!-- Personal data -->
	<section>
		<h2 class="section-title">
			<?= icon_embed('user-circle') ?>
			Account
		</h2>

		<div class="grid-flow" data-spacing="400">
			<div class="grid-flow" data-spacing="0">

				<?php if (!user()->emailIsUsername) { ?>

					<p class="">Username: <span class="fw-semibold"><?= user()->username ?></span></p>

				<?php } ?>

				<?php if (user()->fullName) { ?>

					<p class="">Nome completo: <span class="fw-semibold"><?= user()->fullName ?></span></p>

				<?php } ?>

				<p class="">E-mail: <span class="fw-semibold"><?= user()->email ?></span></p>
			</div>

			<a href="<?= client_url('/profile/data') ?>" class="button button--secondary button--small">Modifica</a>
		</div>
	</section>

	<!-- Addresses -->
	<section>
		<h2 class="section-title">
			<?= icon_embed('address') ?>
			Indirizzi registrati
		</h2>

		<div class="grid-flow" data-spacing="400">

			<?php if (customer()->hasAddress) { ?>

				<div class="addresses grid-flow" data-columns="25rem" data-spacing="700">
					<div class="address">
						<h3 class="subsection-subtitle">Indirizzo di spedizione predefinito</h3>
						<p class="">
							<?= customer()->defaultAddress->fullAddress ?><br>
							-<br>
							<?= customer()->defaultAddress->email ?><br>
							<?= customer()->defaultAddress->phone ?>
						</p>
					</div>

					<div class="address">
						<h3 class="subsection-subtitle">Indirizzo di fatturazione predefinito</h3>
						<p class="">
							<?= customer()->defaultAddress->fullAddress ?><br>
							-<br>
							<?= customer()->defaultAddress->email ?><br>
							<?= customer()->defaultAddress->phone ?>
						</p>
					</div>
				</div>

				<a href="<?= client_url('/address/edit') ?>" class="button button--secondary button--small">Modifica</a>

			<?php } else { ?>

				<p class="">Nessun indirizzo registrato</p>

			<?php } ?>

		</div>
	</section>

	<!-- Orders -->
	<section>
		<h2 class="section-title">
			<?= icon_embed('orders') ?>
			Ordini
		</h2>

		<?= ViewManager::renderCartList() ?>

	</section>
</div>

<?php if ($pageConfig['whishlist']) { ?>

	<div class="page-block">
		<!-- Wishlist -->
		<section>
			<h2 class="section-title">
				<?= icon_embed('love') ?>
				Wishlist
			</h2>

			<?php if ($likes->num_rows) { ?>

				<div class="favorites mar-t-2">
					<div class="favorites-wrap  grid4 gap1">
						<?php while ($row = $likes->fetch_assoc()) product_card($row['itemId']) ?>
					</div>
				</div>

				<?php if ($likesCount > $likesLimit) { ?>

					<p class="show-more">
						<a href="<?= client_url('/wishlist') ?>">Mostra la wishlist</a>
					</p>

				<?php } ?>

			<?php } else { ?>

				<p class="txt-1rem">Nessun prodotto aggiunto alla wishlist</p>

			<?php } ?>

		</section>
	</div>

<?php } ?>

{% end content %}