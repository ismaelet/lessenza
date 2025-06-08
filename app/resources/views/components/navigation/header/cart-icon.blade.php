<a
	class="h__nav-icon h__nav-icon--cart <?= cart()->quantity ? 'active' : '' ?> js-cart-data-quantity"
	href="<?= client_url('/cart') ?>"
	data-quantity="<?= cart()->quantity ?>"
>
	<?= embed_icon('bag') ?>
</a>
