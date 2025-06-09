<?php

use Ecommerce\Cart\Renderer;
use Ecommerce\ViewManager;

use function Ecommerce\cart;
use function Ecommerce\ecommerce_config;

?>

{% extends main %}

{% block main %}

<input type="hidden" data-cart-page="true">

<!-- Header -->
<div class="page-header grid stack-content center-content">
	<?php if (ecommerce_config('cart-page')['header-background']) { ?>
		<div class="page-header__background fill-all background-fill" <?= background_image('/app/templates/assets/cart/header-background') ?>></div>
	<?php } ?>

	<div class="main-wrap">
		<h1 class="page-header__title section-title">Carrello</h1>
	</div>
</div>

<div class="main-wrap">

	<!-- Flow bar -->
	<?php if (ecommerce_config('cart-page')['flow-bar']) {
		Renderer::flowBar();
	} ?>

	<!-- Page body -->
	<div class="page-body">
		<!-- Page content -->
		<div class="page-content">

			{% place content %}

		</div>

		<!-- Side bar -->
		<aside class="sidebar">

			<label class="sidebar__header">
				<input type="checkbox" class="sidebar__checkbox hidden" checked>
				<div class="sidebar__icon"><?= embed_svg('navigation/arrow1-down') ?></div>
				<h3 class="sidebar__menu">Dettagli dell'ordine</h3>
			</label>

			<div class="sidebar__body">

				<div class="sidebar__content">

					<!-- Orders -->
					<div class="sidebar__wrapper">
						<h2 class="subsection-title">Articoli</h2>
						<section class="orders">
							<?= ViewManager::renderOrderList() ?>
						</section>
					</div>

					<!-- Coupon -->
					<?php if (ecommerce_config('cart-page')['coupon-option']) { ?>

						<section class="coupon">
							<div class="sidebar__wrapper">

								<?php if (cart()->usedCoupon) { ?>

									<p class="add-coupon-text link inlb txt-1rem clickable">aggiungi un codice sconto</p>

									<form class="add-coupon <?= true ? 'visible' : '' ?>" method="POST">
										<input type="text" class="inp inp-nospace coupon_inp <?= ($error) ? 'coupon_inp--error' : '' ?>" name="coupon" value="<?= isset($_POST['coupon']) ? strtoupper($_POST['coupon']) : '' ?>" placeholder="Codice sconto">
										<button type="submit" class="add-coupon-btn pbtn pbtn--auto-width" name="add-coupon">Aggiungi</button>
									</form>

									<?php if ($error) { ?>

										<p class="coupon_error txt-red txt-sbold txt-cen mar-t-1">
											<?php switch ($error) {
												case 'coupon-invalid':
													echo 'Codice sconto insistente';
													break;
												case 'coupon-not-started':
													echo 'Questo codice sconto non è attivo';
													break;
												case 'coupon-expired':
													echo 'Questo codice sconto è scaduto';
													break;
												case 'coupon-used':
													echo 'È possibile usare questo codice sconto solo una volta';
													break;
												case 'coupon-min-price':
													echo 'I prodotti non raggiungono il valore minimo necessario per poter usare il codice sconto';
													break;
												case 'coupon-empty':
													echo 'Non hai inserito un codice sconto valido';
													break;
												default:
													echo 'C\'è stato un errore nell\'aggiunta del codice sconto';
											} ?>
										</p>

									<?php }
								} else { ?>

									<form method="POST">
										<h3 class="coupon-code">Codice sconto: <strong><?= cart()->coupon->code ?></strong></h3>
										<button type="submit" class="coupon_remove ebtn ebtn--red mar-t-05" name="remove-coupon">rimuovi il codice sconto</button>
									</form>

								<?php } ?>

							</div>
						</section>

					<?php } ?>

					<!-- Recap -->
					<div class="sidebar__wrapper">
						<?= ViewManager::renderCartRecap() ?>
					</div>
				</div>
			</div>
		</aside>
	</div>
</div>

{% end main %}