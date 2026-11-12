@pushOnce('styles')
	@vite('resources/css/storefront/home.css')
@endpushOnce

@pushOnce('scripts')
	@vite('resources/js/storefront/home.ts')
@endpushOnce

<x-layouts.legacy-main
	:$location
	:headerConfig="['floating' => true]"
>
	<div class="full-width">
		@include('home/slider')
		<div class="breakout mt-12 sm:mt-20">
			<x-banners.discount />
		</div>
		@include('home/products')
		@include('home/technologies')
		@include('home/history')
		@include('home/female')
		@include('home/ethics')
		@include('home/laboratory')
		@include('home/newsletter')
	</div>
</x-layouts.legacy-main>
