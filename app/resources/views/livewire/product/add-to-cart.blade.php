<div class="flex flex-wrap gap-4">
	<label class="quantity center-content border-1 grid grow grid-cols-3 rounded border-neutral-300 sm:grow-0">
		<button
			type="button"
			wire:click="updateQuantity({{ $quantity }} - 1)"
			@disabled($quantity <= 1)
			class="quantity__edit quantity__edit--remove"
		>-</button>

		<input
			type="number"
			name="quantity"
			wire:model.live="quantity"
			min="1"
			max="{{ $maxQuantity }}"
			step="1"
		>

		<button
			type="button"
			wire:click="updateQuantity({{ $quantity }} + 1)"
			@disabled($quantity >= 99)
			class="quantity__edit quantity__edit--add"
		>+</button>
	</label>

	<x-button
		class="grow"
		:disabled="!$product->inStock"
		wire:click="addToCart"
	>
		<x-icon-cart class="w-[1.25em]" />
		Aggiungi al carrello
	</x-button>
</div>
