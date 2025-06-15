@if ($product->relatedProducts())
	<section class="related-items">
		<div class="main-wrap">
			<x-heading.component class="">Potrebbero <span
					class="font-medium italic">interessarti</span></x-heading.component>

			<div
				class="mar-t-3 grid"
				data-columns="15rem"
				data-spacing="400"
			>

				@foreach ($product->relatedProducts() as $relatedProduct)
					<x-product-card :product="$relatedProduct" />
				@endforeach

			</div>
		</div>
	</section>
@endif
