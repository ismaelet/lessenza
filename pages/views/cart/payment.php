{% block content %}

<form method="POST" class="form">

	<!-- <?= cart_data($currentStep) ?> -->

	<h3 class="subsection-title">Pagamento</h3>

	<!-- Payments -->
	<div class="payments">

		<?php

		while ($paymentRow = $payments->fetch_assoc()) {
			$payment = new Ecommerce\PaymentMethod($paymentRow['id']);
		?>

			<div class="payment <?= $payment->id == $cart->paymentId ? 'active' : '' ?>">

				<!-- Payment header -->
				<label class="payment-header">

					<label class="cbx">
						<input type="checkbox" name="paymentId" value="<?= $payment->id ?>" <?= $payment->id == $cart->paymentId ? 'checked' : '' ?>>
						<div class="icon"></div>
					</label>

					<img class="payment-logo" src="<?= client_path('payment-' . $payment->slug . '.png') ?>" alt="">

					<h3 class="payment-title txt-09rem txt-bold"><?= $payment->name ?></h3>
				</label>

				<!-- Payment body -->
				<div class="payment-body">
					<p><?= $payment->info ?></p>
				</div>

			</div>

		<?php } ?>

	</div>

	<!-- Advance -->
	<div class="cart-footer flex ha-rig mar-t-2">
		<?= cart_submit('Procedi al pagamento') ?>
	</div>

</form>

{% end content %}