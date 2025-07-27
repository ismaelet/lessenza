@pushOnce('scripts')
	<script defer>
		openCartSidebar = () => {
			document.querySelector('.cart-sidebar').classList.add('active');
		};
	</script>
@endpushOnce

<button
	type="button"
	class="h__nav-icon h__nav-icon--cart {{ $quantity ? 'active' : '' }} js-cart-data-quantity cursor-pointer transition-colors"
	data-quantity="{{ $quantity ?? 0 }}"
	x-data
	@click="openCartSidebar()"
>
	<x-icon-bag />
</button>
