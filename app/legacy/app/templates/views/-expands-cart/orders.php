<section class="orders <?= $cart->status ? 'orders_completed' : '' ?>">

	<?php while ($rowOrder = $orders->fetch_assoc()) {
		$order = new Order($rowOrder['id']);
	?>

		<form method="POST" class="order">
			<input type="hidden" name="order-id" value="<?= $order->id ?>">

			<div class="order-body">
				<!-- Image -->
				<img src="<?= client_path($order->item->img()) ?>" alt="" class="order-img image-fill">

				<!-- Name -->
				<div>
					<p class="order-name"><?= $order->name ?></p>
					<?php if ($order->desc) { ?>
						<p class="order-desc"><?= $order->desc ?></p>
					<?php } ?>
					<?php if ($cart->status > 1 && logged()) { ?>
						<p><a href="<?= $order->item->url . '#post-review' ?>" class="link">escrever depoimento</a></p>
					<?php } ?>
				</div>

				<?php if (!$cart->status) { ?>
					<!-- Quantity -->
					<div class="order-quantity">
						<input type="number" class="inp" name="quantity" value="<?= $order->quantity ?>" min="1" max="99" data-quantity="<?= $order->quantity ?>">
					</div>
				<?php } ?>

				<!-- Price -->
				<p class="order-price"><?= $order->discount ? '<strike class="txt-9">' . format_price($order->totalOriginalPrice) . '</strike> ' : '' ?><?= format_price($order->totalPrice) ?></p>

				<?php if (!$cart->status) { ?>
					<div class="order-delete icon-box" onclick="$(this).parent().submit()">
						<?= embed_svg('close') ?>
					</div>
				<?php } ?>
			</div>

			<?php if (!$cart->status) { ?>
				<button type="submit" class="order-update pbtn wid-100 mar-t-05" name="update-quantity">Atualizar</button>
			<?php } ?>

		</form>


	<?php } ?>

</section>