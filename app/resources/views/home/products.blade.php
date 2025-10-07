@php
	use App\Models\Product;

	$products = Product::inRandomOrder()->take(4)->get();
	$productsSauna = Product::whereIn('product_type_id', [4, 5])
	    ->inRandomOrder()
	    ->get();
@endphp

@pushOnce('styles')
	<style>
		.products-text-wrapper {
			position: relative;
			isolation: isolate
		}

		.products-text-wrapper::before {
			content: "";
			display: block;
			position: absolute;
			top: -1rem;
			bottom: -1rem;
			left: -1rem;
			right: 30%;
			border: 1px solid var(--color-neutral-300);
			z-index: -1;
			clip-path: polygon(0 0, 100% 0, 100% 2rem, 90% 2rem, 90% calc(100% - 2rem), 100% calc(100% - 2rem), 100% 100%, 0 100%);

			@media (min-width: 1024px) {
				top: -2rem;
				bottom: -2rem;
				left: -2rem;
			}
		}

		.products-row {
			padding-block: min(6rem, 20vw);
		}

		.product-image {
			opacity: 0;
			transition: opacity 1s 1s ease-in-out;
		}

		.product-image[data-active="true"] {
			opacity: 1;
			animation-name: zoom-out;
			animation-duration: 5s;
			animation-timing-function: ease-in-out;
			transition: opacity 1s ease-in-out;
		}

		@keyframes zoom-out {
			0% {
				scale: 1.25;
			}

			100% {
				scale: 1;
			}
		}
	</style>
@endpushOnce

@pushOnce('scripts')
	<script defer>
		function cycleImages() {
			const images = document.querySelectorAll('.product-image');
			let currentIndex = 0;

			setInterval(() => {
				images[currentIndex].dataset.active = 'false';
				currentIndex = (currentIndex + 1) % images.length;
				images[currentIndex].dataset.active = 'true';
			}, 5000);
		}

		document.addEventListener('DOMContentLoaded', cycleImages);
	</script>
@endpushOnce

<section class="products full-width">
	<div class="full-width grid">
		<div class="breakout products-row grid items-center gap-x-24 gap-y-8 lg:grid-cols-[max-content_minmax(0,_1fr)]">

			<div class="products__video-wrapper grid justify-items-center gap-16">
				<a
					class="products__video"
					href="{{ route('shop', ['typeId' => 1]) }}"
				>
					<video
						class="w-140 max-w-full lg:max-w-[30vw]"
						src="{{ Vite::asset('resources/videos/ad.mp4') }}"
						autoplay
						muted
						loop
						playsinline
					></video>
				</a>
			</div>

			<div class="grid grid-cols-1 gap-16 px-2 lg:px-0">
				<div class="text-center lg:text-left">
					<x-subheading.section>Scopri le</x-subheading.section>
					<x-heading.section>Fragranze</x-heading.section>
				</div>

				<div class="products-text-wrapper">
					<p class="products-text bg-background-400 leading-[2.2] tracking-wider">Le “Essenze” sono fragranze ricavate in
						laboratorio
						principalmente dalla
						spremitura di olii
						essenziali in corrente di vapore appositamente trattati ed emulsionati con acqua di fonte e pertanto PRONTI
						ALL’USO.
						La particolarità delle fragranze prodotte da L’Essenza rispetto agli altri produttori risiede nella totale ASSENZA
						di ALCOHOL, la BIODEGRADABILITA’ AL 100%, l’ASSENZA DI SCHIUMA, la quasi ASSENZA DI ALLERGENI, la NON OLEOSITA’
						che
						EVITA DANNI ALLE POMPE DOSATRICI degli impianti aroma e quindi EVITA aggravi di COSTI ai gestori per via delle
						manutenzioni straordinarie.
					</p>
				</div>

				<div class="flex justify-center lg:justify-start">
					<x-button
						href="{{ route('shop', ['typeId' => 1]) }}"
						variant="secondary"
					>Vedi tutte</x-button>
				</div>
			</div>

			{{-- <div class="grid grid-cols-2 gap-8 md:grid-cols-4">

				@foreach ($products as $product)
					<x-product-card :$product />
				@endforeach

			</div> --}}
		</div>

		<div class="full-width products-row relative bg-gray-100">

			<img
				src="{{ Vite::image('home/contrast-image.webp') }}"
				alt=""
				class="fill-width absolute inset-0 h-full w-full object-cover opacity-15"
			>

			<div class="breakout grid items-center gap-x-24 gap-y-8 lg:grid-cols-[minmax(0,_1fr)_max-content]">

				<div class="products__video-wrapper grid grid-cols-1 justify-items-center gap-16 lg:col-start-2">
					<a
						class="product-images-container w-140 stack-content grid aspect-square max-w-full grid-rows-[minmax(0,_1fr)] overflow-hidden lg:max-w-[30vw]"
						href="{{ route('shop', ['typeId' => 4]) }}"
					>
						@foreach ($productsSauna as $product)
							<img
								class="product-image h-full w-full object-cover"
								src="{{ $product->image }}"
								alt=""
								data-id="{{ $loop->index }}"
								data-active="{{ $loop->first ? 'true' : 'false' }}"
							>
						@endforeach
					</a>
				</div>

				<div class="relative grid grid-cols-1 gap-16 px-2 lg:row-start-1 lg:px-0">
					<div class="text-center lg:text-left">
						<x-subheading.section>I nostri prodotti</x-subheading.section>
						<x-heading.section>Sauna</x-heading.section>
					</div>

					<div class="products-text-wrapper">
						<p class="products-text leading-[2.2] tracking-wider">Le essenze per sauna sono concentrati aromatici
							a base di oli essenziali naturali, studiati per un utilizzo sicuro ed efficace. Diluiti in acqua, bastano poche
							gocce per sprigionare aromi intensi e trasformare ogni seduta in un autentico momento di benessere.

							La particolarità dei prodotti L’Essenza risiede nell’ALTA RESA, nella QUALITÀ DELLE MATERIE PRIME, nella
							COMPATIBILITÀ CON GLI IMPIANTI e nella VARIETÀ DI FRAGRANZE, che spaziano dal relax profondo alla stimolazione
							dei sensi.

							Un prodotto PRATICO, SICURO e PERFORMANTE, ideale per centri benessere e uso domestico, che rende la tua sauna
							un’esperienza unica e coinvolgente.
						</p>
					</div>

					<div class="flex justify-center lg:justify-start">
						<x-button
							href="{{ route('shop', ['typeId' => 4]) }}"
							variant="secondary"
						>Vedi tutti</x-button>
					</div>
				</div>

				{{-- <div class="grid grid-cols-2 gap-8 md:grid-cols-4">

				@foreach ($products as $product)
					<x-product-card :$product />
				@endforeach

			</div> --}}
			</div>
		</div>
	</div>
</section>
