@pushOnce('styles')
	<link
		rel="stylesheet"
		href="{{ asset('css/legacy/shop.css') }}"
	>
@endpushOnce

<x-layouts.legacy-main
	:$title
	:$location
>
	<div class="pt-20">
		<livewire:shop />
	</div>
</x-layouts.legacy-main>
