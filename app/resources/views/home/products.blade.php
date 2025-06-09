@php
	use App\Models\Product;

	$products = Product::latest()->take(4)->get();
@endphp

@pushOnce('styles')
	<link
		rel="stylesheet"
		href="{{ asset('css/legacy/home-products.css') }}"
	>
@endpushOnce

<section class="products padded-section full-width">
	<div class="breakout grid gap-16">
		<div class="text-center">
			<x-subheading.section>Scopri le</x-subheading.section>
			<x-heading.section>Fragranze</x-heading.section>
		</div>

		<div class="products__video-wrapper grid gap-16">
			<a
				class="products__video"
				href="{{ route('shop') }}"
			>
				<video
					class="image-fit"
					src="{{ Vite::asset('resources/videos/ad.mp4') }}"
					autoplay
					muted
					loop
					playsinline
				></video>
			</a>

			<p class="page-text">Le “Essenze” sono fragranze ricavate in laboratorio principalmente dalla spremitura di olii
				essenziali in corrente di vapore appositamente trattati ed emulsionati con acqua di fonte e pertanto PRONTI ALL’USO.
				La particolarità delle fragranze prodotte da L’Essenza rispetto agli altri produttori risiede nella totale ASSENZA
				di ALCOHOL, la BIODEGRADABILITA’ AL 100%, l’ASSENZA DI SCHIUMA, la quasi ASSENZA DI ALLERGENI, la NON OLEOSITA’ che
				EVITA DANNI ALLE POMPE DOSATRICI degli impianti aroma e quindi EVITA aggravi di COSTI ai gestori per via delle
				manutenzioni straordinarie.
			</p>
		</div>

		<div class="grid grid-cols-2 gap-8 md:grid-cols-4">

			@foreach ($products as $product)
				<x-product-card :$product />
			@endforeach

		</div>

		{{-- <a
			href="{{ route('shop') }}"
			class="button button--secondary"
		>Vedi tutte</a> --}}
	</div>
</section>
