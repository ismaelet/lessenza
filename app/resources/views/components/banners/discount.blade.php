@props([
    'size' => 'base',
])

@pushOnce('styles')
	<style>
		.discount-banner {
			clip-path: polygon(0 0, calc(100% - 1.5rem) 0, calc(100% - 1.5rem) 1.5rem, 100% 1.5rem, 100% 100%, 0 100%);

			&[data-size="base"] {
				@media (min-width: 640px) {
					clip-path: polygon(0 0, calc(100% - 2rem) 0, calc(100% - 2rem) 2rem, 100% 2rem, 100% 100%, 0 100%);
				}
			}
		}
	</style>
@endpushOnce

<div
	class="group relative text-center text-red-700 data-[size='sm']:text-base sm:text-lg"
	data-size="{{ $size }}"
>
	<p class="discount-banner rounded-xl border-2 border-red-600 px-8 py-4">
		Più acquisti, meno spendi! Sconto di <span class="font-bold">5€</span> a tanica per più di 6 pezzi, <span
			class="font-bold"
		>10€</span> per ordini superiori a 12 pezzi e <span class="font-bold">15€</span> per ordini superiori a 22 taniche
		anche miste.
	</p>

	<x-icon-discount
		class="absolute right-0 top-0 w-12 -translate-y-[1rem] translate-x-[1rem] group-data-[size='sm']:w-12 group-data-[size='sm']:-translate-y-4 group-data-[size='sm']:translate-x-4 sm:w-16 sm:-translate-y-[1.5rem] sm:translate-x-[1.5rem]"
	/>
</div>
