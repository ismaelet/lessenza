@props([
    'title' => null,
    'description' => null,
    'thumbnail' => null,
    'location' => null,
    'colorScheme' => null,
    'headerConfig' => [],
])

@push('styles')
	@vite('resources/css/storefront/base.css')
	<style>
		.main-content {
			display: grid;
			grid-template-areas:
				'header'
				'main';
			grid-template-columns: minmax(0, 1fr);
			grid-template-rows: max-content 1fr;
			min-height: 100svh;
		}

		main {
			grid-area: main;
		}
	</style>
@endpush

@pushOnce('scripts')
	@vite('resources/js/storefront/main.ts')
@endpushOnce

<x-layouts.app
	:$title
	:$description
	:$thumbnail
	:$colorScheme
>
	<div class="main-content">
		<x-navigation.header
			:config="$headerConfig"
			:$location
		/>

		<main>
			<div class="content-grid min-h-full">
				{{ $slot }}
			</div>
		</main>
	</div>

	<x-navigation.footer />
	<livewire:cart.sidebar />
</x-layouts.app>
