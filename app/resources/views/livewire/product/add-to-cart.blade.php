<form
	class="flex flex-wrap gap-4"
	wire:submit.prevent="addToCart"
	x-data="{ quantity: @entangle('quantity') }"
>
	<label class="quantity center-content border-1 grid grow grid-cols-3 rounded border-neutral-300 sm:grow-0">
		<button
			type="button"
			@click="quantity = Math.max(1, quantity - 1);"
			x-bind:disabled="quantity <= 1"
			class="quantity__edit quantity__edit--remove"
		>-</button>

		<input
			type="number"
			name="quantity"
			wire:model="quantity"
			x-model="quantity"
			min="1"
			max="{{ $maxQuantity }}"
			step="1"
		>

		<button
			type="button"
			@click="quantity = Math.min({{ $maxQuantity }}, quantity + 1);"
			x-bind:disabled="quantity >= {{ $maxQuantity }}"
			class="quantity__edit quantity__edit--add"
		>+</button>
	</label>

	<x-button
		class="relative grow"
		:disabled="!$product->inStock"
		wire:click="addToCart"
	>
		<span
			class="contents"
			wire:loading.class="invisible"
		>
			<x-icon-cart class="w-[1.25em]" />
			Aggiungi al carrello
		</span>

		<x-icon-loading
			class="absolute h-4 w-12"
			wire:loading
		/>
	</x-button>
</form>
