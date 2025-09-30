@pushOnce('styles')
	<style>
		.product img {
			corner-shape: squircle;
			border-radius: 4rem;
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

	<div class="breakout mb-20 mt-16 sm:mt-24">
		<div class="grid gap-16 md:grid-cols-2">
			@foreach ($products as $product)
				<article class="product md:last:translate-x-1/2">
					<a
						href="{{ $product->url() }}"
						class=""
					>
						<img
							class="aspect-[4/4] w-full object-cover"
							src="{{ $product->image }}"
						/>
					</a>

					<div class="pt-8 text-center">
						<x-heading.component>{{ $product->name }}</x-heading.component>

						<div class="mt-4 leading-loose">{!! $product->description_short !!}</div>

						<div class="flex justify-center">
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
</x-layouts.legacy-main>
