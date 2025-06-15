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
