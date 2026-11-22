@props(['product'])

<article class="product-card">
	<a href="{{ $product->url() }}" class="product-card__link">
		<div class="product-card__image-wrapper">
			<img
				class="product-card__image"
				src="{{ $product->image }}"
				alt="{{ localized_text($product->name) }}"
				loading="lazy"
			>
		</div>
		<div class="product-card__body">
			<x-heading.small-component class="product-card__name">{{ localized_text($product->name) }}</x-heading.small-component>
			<div class="product-card__footer">
				<span><strong class="product-card__price">{{ $product->priceString() }}</strong> <small>{{ __('+ IVA') }}</small></span>
				<span class="product-card__details">{{ __('Scopri →') }}</span>
			</div>
		</div>
	</a>
</article>
