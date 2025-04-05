{% block main %}

<div class="page__header grid-flow center-content pad-v-3">
	<h1 class="title">
		Ordine<br>
		<span class="fw-bold"><?= $cart->idCode ?></span>
	</h1>
</div>

<div class="page__wrapper grid-flow main-wrap" data-spacing="800">

	<div class="page__body grid-flow">
		<div class="page__content grid-flow" data-spacing="800">
			<!-- Page header -->
			<section class="confirmation">
				<div class="confirmation-icon status-color--<?= $cart->statusCode ?>">
					<?= icon_embed($cart->statusIcon) ?>
				</div>
				<div class="confirmation-content">
					<p>Stato dell'ordine:</p>
					<p class="status-name"><?= $cart->statusName ?></p>
				</div>
			</section>

			<!-- Cart data -->
			<section class="client-data page__section">
				<h3 class="subsection-title">Dati dell'ordine</h3>

				<div class="grid-flow" data-columns="15rem" data-spacing="700">
					<div class="grid-flow" data-spacing="700">
						<div class="grid-flow" data-spacing="400">
							<h3 class="subsection-subtitle">Informazioni di contatto</h3>
							<p class="text">
								<?= $cart->address->email ?><br>
								<?= $cart->address->phone ?>
							</p>
						</div>
						<div class="grid-flow" data-spacing="400">
							<h3 class="subsection-subtitle">Indirizzo di spedizione</h3>
							<p class="text">
								<?= $cart->address->fullAddress ?>
							</p>
						</div>
					</div>

					<div class="grid-flow" data-spacing="700">
						<div class="grid-flow" data-spacing="400">
							<h3 class="subsection-subtitle">Forma di pagamento</h3>
							<p><?= $cart->paymentMethod->name ?: '-' ?></p>
						</div>
						<div class="grid-flow" data-spacing="400">
							<h3 class="subsection-subtitle">Tipo di spedizione</h3>
							<div>
								<p><?= $cart->shippingMethod->name ?></p>
								<p class="text"><?= $cart->shippingMethod->deliveryDateString ?></p>
							</div>
						</div>
					</div>
				</div>

				<?php

				use Ecommerce\ViewManager;

				if (false && $cart->statusCode == 'waiting-payment') { ?>

					<div class="back-to-payment mar-t-2 grid ha-cen br-t-1 br-d pad-t-2">

						<?php if ($cart->payment->slug == 'paypal') { ?>

							<a href="<?= client_url('/payment/paypal?id=' . $cart->id) ?>" class="pbtn">Vuoi tornare al pagamento?</a>
							<p class="txt-red txt-cen txt-sbold mar-t-1">Se sei sicuro di aver già pagato, ma l'ordine non è stato confermato,<br> contattaci a <a class="txt-black" href="<?= sys_config('contact-email-link') ?>"><?= sys_config('contact-email') ?></a>, non pagare di nuovo.</p>

						<?php } else if ($cart->payment->slug == 'bank-transfer') { ?>

							<a href="<?= client_url('/payment/bank-transfer?id=' . $cart->id) ?>" class="pbtn">Vuoi rivedere i dati per il bonifico?</a>

						<?php } ?>

						<p class="mar-t-2">I pagamenti effettuati tramite PayPal verranno confermati pochi minuti dopo l'acquisto e quelli tramite bonifico entro 2 giorni lavorativi. In caso il tuo pagamento non risulti confermato dopo un tempo superiore a quello indicato, ti consigliamo di contattarci qui: <a class="txt-bold" href="<?= sys_config('contact-email-link') ?>"><?= sys_config('contact-email') ?></a></p>
					</div>

				<?php } ?>

			</section>
		</div>

		<aside class="page__sidebar">
			<section class="page__section">
				<h3 class="subsection-title">Articoli</h3>
				<?= ViewManager::renderOrderList($cart) ?>
			</section>

			<section class="page__section">
				<h3 class="subsection-title"></h3>
				<?= ViewManager::renderCartRecap($cart) ?>
			</section>
		</aside>
	</div>

	<?php if (logged()) { ?>

		<section class="flex-group center-content">
			<a class="button button--secondary" href="<?= client_url('/profile/orders') ?>">
				Lista degli ordini
				<?= icon_embed('navigation/back') ?>
			</a>
		</section>

	<?php } ?>

</div>

{% end main %}