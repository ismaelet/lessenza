@props(['product'])

<div class="product-card">
	<div class="product-card__image-wrapper stack-content grid">
		<a
			href="{{ $product->url() }}"
			class="stack-content"
		>
			<img
				class="product-card__image image-fill"
				src="{{ $product->image }}"
				alt="{{ $product->name }}"
				loading="lazy"
			>
		</a>
	</div>
</div>
