<x-layouts.legacy-main>

	<div class="main-wrap center-content grid">
		<div
			class="center-content grid"
			data-spacing="800"
		>
			<x-heading.section>Ordine confermato</x-heading.section>
			<p class="max-width--768">
				Vi ringraziamo per il Vostro ordine, a breve elaboreremo la richiesta e vi contatteremo per informarvi come
				effettuare il pagamento.
			</p>

			<div
				class="center-content max-width--480 grid"
				data-spacing="400"
			>
				@if (auth()->check())
					<x-button
						href="{{ route('user-dashboard.orders') }}"
						class=""
					>I Miei Ordini</x-button>
				@endif

				<x-button
					href="{{ route('shop') }}"
					class=""
					variant="secondary"
				>Torna al Negozio</x-button>
			</div>
		</div>
	</div>

</x-layouts.legacy-main>
