{% block content %}

<form method="POST" class="form">

	<?= cart_shop_link() ?>

	<?= cart_data($currentStep) ?>

	<h3 class="section-title mar-t-2">forma de frete</h3>

	<div class="shipping-types">

		<?php $new = true;
		while ($row = $shippingTypes->fetch_assoc()) {

			$shipping = new Shipping($row['id']);

			if (!$cart->shippingId && $new) {
				$checked = true;
				$new = false;
			} else
				$checked = $shipping->id == $cart->shippingId;

		?>

			<label class="shipping-row clickable">

				<div class="shipping-cbx">

					<div class="cbx">
						<input type="checkbox" name="shippingId" value="<?= $shipping->id ?>" <?= $checked ? 'checked' : '' ?>>
						<div class="icon"></div>
					</div>

				</div>

				<div class="shipping-content">
					<h3 class="shipping-name txt-bold"><?= $shipping->name ?></h3>

					<?php if ($user->admin && $shipping->hasAPI) { ?>
						<p class="<?= $shipping->activeAPI ? 'txt-gre' : 'txt-red' ?>"><?= $shipping->activeAPI ? 'API online' : 'API offline' ?></p>
					<?php } ?>

					<p class="txt-1rem">Previsão: <?= $shipping->deliveryDate ?></p>
					<p class="shipping-price mar-t-05 txt-09rem txt-black"><?= format_price($shipping->price) ?></p>
				</div>

			</label>

		<?php } ?>

	</div>

	<div class="flex ha-rig mar-t-2">
		<?= cart_submit('Escolher pagamento') ?>
	</div>

</form>

{% end content %}