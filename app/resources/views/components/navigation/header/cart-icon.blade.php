<a
	class="h__nav-icon h__nav-icon--cart {{ cart()?->quantity() ? 'active' : '' }} js-cart-data-quantity transition-colors"
	href="{{ client_url('/cart') }}"
	data-quantity="{{ cart()?->quantity() ?? 0 }}"
>
	<x-icon-bag />
</a>
