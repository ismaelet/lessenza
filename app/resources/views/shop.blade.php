@pushOnce('styles')
	@vite('resources/css/storefront/shop.css')
@endpushOnce

<x-layouts.legacy-main
	:$title
	:$location
>
	<div class="pt-20">
		<livewire:shop />
	</div>
</x-layouts.legacy-main>
