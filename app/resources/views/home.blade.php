@pushOnce('styles')
	<link
		rel="stylesheet"
		href="{{ asset('css/legacy/home.css') }}"
	>
@endpushOnce

@pushOnce('scripts')
	<script
		defer
		src="{{ asset('js/legacy/home.js') }}"
	></script>
@endpushOnce

<x-layouts.legacy-main
	:$locationTag
	:headerConfig="['floating' => true]"
>
	<div class="full-width">
		@include('home/slider')
		@include('home/products')
		{{-- @include('home/history') --}}
		{{-- @include('home/female') --}}
		{{-- @include('home/ethics') --}}
		{{-- @include('home/laboratory') --}}
		{{-- @include('home/newsletter') --}}
	</div>
</x-layouts.legacy-main>
