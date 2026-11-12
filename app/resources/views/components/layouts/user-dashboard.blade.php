@props([
    'title' => null,
    'location' => null,
])

@pushOnce('styles')
	@vite('resources/css/storefront/user-dashboard.css')
@endpushOnce

<x-layouts.legacy-main
	:$title
	:$location
>
	<div class="page-body breakout">

		<x-user-dashboard.navigation />

		<div class="page-content">
			{{ $slot }}
		</div>

	</div>
</x-layouts.legacy-main>
