@pushOnce('styles')
	<style>
		.content-grid {
			align-items: flex-start;
		}
	</style>
@endpushOnce

<x-layouts.legacy-main>
	<div
		class="grid content-center justify-items-center gap-12 py-20 text-center"
		data-spacing="700"
	>
		<div class="cart-icon border-secondary-200 text-primary grid aspect-square place-items-center rounded-full border-2">
			<x-icon-empty-cart class="w-1/2" />
		</div>

		<div class="grid gap-6">
			<x-heading.section>Il tuo carrello è vuoto</x-heading.section>

			<p class="text--big">Puoi cercare dei prodotti da acquistare qui</p>
		</div>

		<x-button href="{{ route('shop') }}">Catalogo</x-button>
	</div>
</x-layouts.legacy-main>
