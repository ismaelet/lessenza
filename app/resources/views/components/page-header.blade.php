@props(['title', 'image'])

@pushOnce('styles')
	<style>
		.page-head {
			height: min(26rem, 80vw);
			background-color: hsla(0, 0%, 50%);
		}

		.page-head__background {
			opacity: 0.6;
		}
	</style>
@endpushOnce

<section {{ $attributes->merge(['class' => 'page-head stack-content center-content grid']) }}>
	<div
		class="page-head__background fill-all background-fill"
		{!! background_image($image) !!}
	></div>

	<div class="page-head__content main-wrap">
		<x-heading.main class="page-header-title">{{ $title }}</x-heading.main>
	</div>
</section>
