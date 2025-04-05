<?php

namespace Ecommerce\Cart;

use Structure\DynamicProperties;

use function Ecommerce\cart;
use function Ecommerce\ecommerce_config;

class Renderer {

	use DynamicProperties;

	public const CART_STEPS = ecommerce_config('cart-page')['steps'];

	/*
	* Render methods
	*/
	public static function flowBar() { ?>

		<section class="cart-flow">

			<?php foreach (self::CART_STEPS as $key => $cartStep) { ?>

				<!-- Line -->
				<?php if ($key > 1) { ?>

					<div class="cart-flow__line"></div>

				<?php } ?>

				<!-- Step -->
				<div class="cart-flow__step <?= $key == cart()->step ? 'cart-flow__step--current-step' : '' ?>">
					<a class="cart-flow__circle" href="<?= client_url('/cart?step=' . $key) ?>">

						<?php if ($key >= cart()->step) { ?>

							<p class="cart-flow__number"><?= $key ?></p>

						<?php } else { ?>

							<div class="cart-flow__icon">
								<?= icon_embed('correct') ?>
							</div>

						<?php } ?>

					</a>

					<p class="cart-flow__title"><?= $cartStep[0] ?></p>
				</div>

			<?php } ?>

		</section>
<?php }
}

/*
// cart components
function cart_submit($title) {

	return '
		<button type="submit" class="cart-advance pbtn" name="submit">
			' . $title . '
			<span class="icon" ' . icon_svg('navigation/arrow4-right') . '></span>
		</button>
	';
}

function cart_shop_link() {

	return '
		<a href="' . client_url('/shop') . '">
			<p class="return-link">
				<span class="icon" ' . icon_svg('navigation/double-arrow1-left') . '></span>
				volta para a loja
			</p>
		</a>
	';
}

function cart_data($currentStep) {

	global $cart;

	$cartData = [
		[
			'title' => 'contato',
			'content' => $cart->address->email . ', ' . $cart->address->phone . ', ' . $cart->address->cpf,
			'step' => 2,
		],
		[
			'title' => 'enviar para',
			'content' => str_replace('<br>', ', ', $cart->address->fullAddress),
			'step' => 2,
		],
		[
			'title' => 'método de entrega',
			'content' => $cart->shipping->name . ' &middot <strong>' . $cart->shipping->deliveryDate . '</strong>',
			'step' => 3,
		],
	];

	$cartDataBlock = '<section class="cart-data">';

	foreach ($cartData as $row) if ($row['step'] < $currentStep) {

		$cartDataBlock .= '
			<div class="cart-data-row">
				<div class="cart-data-content">				
					<h3 class="cart-data-title">' . $row['title'] . '</h3>
					<p>' . $row['content'] . '</p>
				</div>
				<p class="cart-data-content">
					<a class="link" href="?step=' . $row['step'] . '">alterar</a>
				</p>
			</div>
		';
	}

	$cartDataBlock .= '</section>';

	return $cartDataBlock;
}

// advance to the next step
function advance_cart() {
	global $customer;

	$cart = $customer->cart;
	$currentStep = View::get('currentStep');

	$cart->advance($currentStep);

	redirect('/cart?step=' . $cart->step);
}
