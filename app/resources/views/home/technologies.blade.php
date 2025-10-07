@php
	use App\Models\Product;

	$products = Product::whereHas('product_type', function ($query) {
	    $query->where('name', 'Kit');
	})
	    ->take(5)
	    ->latest()
	    ->get();

	$images = [];

	foreach ($products as $product) {
	    $images[] = $product->image;
	}

	$images[3] = $images[0];
	$images[4] = $images[1];
@endphp

@pushOnce('styles')
	<style>
		.technologies {
			grid-template-columns: 0fr 1.125fr 1fr 1.125fr 0fr;
			width: calc(100% + 16rem);
			translate: -8rem 0;
			-webkit-mask:
				radial-gradient(ellipse 60% 20% at 50% 100%, transparent 99%, black 100%),
				radial-gradient(ellipse 60% 20% at 50% 0%, transparent 99%, black 100%);
			-webkit-mask-composite: destination-out, source-over;
			mask:
				radial-gradient(ellipse 60% 20% at 50% 100%, transparent 99%, black 100%),
				radial-gradient(ellipse 60% 20% at 50% 0%, transparent 99%, black 100%);
			mask-composite: intersect;

			@media (min-width: 640px) {
				grid-template-columns: 1.25fr 1.125fr 1fr 1.125fr 1.25fr;
				width: calc(100% + 8rem);
				translate: -4rem 0;
			}
		}

		.technology {
			aspect-ratio: 0.70;
		}
	</style>
@endpushOnce

<section class="padded-section full-width overflow-hidden sm:pb-6 md:pb-12">
	<div class="text-center">
		<x-heading.main>Le nostre tecnologie</x-heading.main>
		<x-subheading.section class="mt-12">Rendi unica la tua area wellness con docce emozionali e sistemi automatici di
			ultima generazione. Profumi, luci e getti d’acqua studiati per offrire ai tuoi clienti un’esperienza
			indimenticabile.</x-subheading.section>
	</div>

	<div class="fill-width technologies mt-0 grid items-center gap-2 sm:gap-4 md:gap-8">
		@foreach ($images as $image)
			<img
				src="{{ $image }}"
				alt="Technology Image {{ $loop->index + 1 }}"
				class="technology bg-gray-200 object-cover"
			>
		@endforeach
	</div>

	<div class="flex justify-center">
		<x-button
			href="{{ route('technologies') }}"
			variant="secondary"
			class="relative z-10 mt-0 sm:-mt-6 md:-mt-12"
		>Scopri di più</x-button>
	</div>
</section>
