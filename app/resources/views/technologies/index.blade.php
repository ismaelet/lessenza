@pushOnce('styles')
	<style>
		.product img {
			corner-shape: squircle;
			border-radius: 2rem;
		}

		.bar {
			top: min(17vw, 16rem);
		}
	</style>
@endpushOnce

<x-layouts.legacy-main :$location>

	<div class="mt-20 grid items-center gap-y-8 text-center sm:text-left lg:grid-cols-2">
		<x-heading.section class="sm:hidden">{{ $title }}</x-heading.section>
		<x-heading.main class="hidden sm:block">{{ $title }}</x-heading.main>
		<p class="text-lg leading-loose">Rendi unica la tua area wellness con docce emozionali e sistemi automatici di ultima
			generazione.
			Profumi, luci e
			getti d’acqua studiati per offrire ai tuoi clienti un’esperienza indimenticabile.</p>
	</div>


	<div class="full-width relative mb-20 mt-16 sm:mt-24">
		<div class="fill-width h-30 bg-primary bar absolute w-full"></div>
		<div class="breakout relative">
			<div class="grid grid-cols-1 gap-16 md:grid-cols-2 xl:grid-cols-3">
				@foreach ($products as $product)
					<article class="product grid grid-cols-1 grid-rows-[auto_1fr] md:last:translate-x-1/2 xl:last:translate-x-0">
						<a
							href="{{ $product->url() }}"
							class=""
						>
							<img
								class="aspect-[4/4] w-full object-cover shadow-2xl"
								src="{{ $product->image }}"
							/>
						</a>

						<div class="grid grid-cols-1 pt-8 text-center">
							<x-heading.component>{{ $product->name }}</x-heading.component>

							<div class="mt-4 leading-loose">{!! $product->description_short !!}</div>

							<div class="flex justify-center self-end">
								<x-button
									href="{{ $product->url() }}"
									variant="secondary"
									class="mt-8 block"
								>Scopri di più</x-button>
							</div>
						</div>
					</article>
				@endforeach
			</div>
		</div>
	</div>
</x-layouts.legacy-main>
