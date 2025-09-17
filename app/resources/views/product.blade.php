@pushOnce('styles')
	<link
		rel="stylesheet"
		href="{{ asset('css/legacy/product.css') }}"
	>
@endpushOnce

@pushOnce('scripts')
	<script
		src="{{ asset('js/legacy/product.js') }}"
		defer
	></script>

	@if (app()->environment('production'))
		<!-- Google Tag Manager -->
		<script defer>
			window.dataLayer = window.dataLayer || [];
			window.dataLayer.push({
				event: "view_item",
				ecommerce: {
					items: [{
						item_name: "{{ $product->name }}",
						item_id: "{{ $product->sku() }}",
						price: "{{ number_format($product->price(), 2) }}",
						item_category: "{{ $product->product_type->name ?? '' }}",
						quantity: 1
					}]
				}
			});
		</script>
		<!-- End Google Tag Manager -->
	@endif
@endpushOnce

<x-layouts.legacy-main
	:$title
	:$location
>

	<div class="product-area main-wrap pad-t-4">

		@include('product/images')
		@include('product/data', ['product' => $product])

	</div>

	@include('product/related-products')

</x-layouts.legacy-main>
