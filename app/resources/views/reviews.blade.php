@pushOnce('styles')
	<link
		rel="stylesheet"
		href="{{ asset('css/legacy/reviews.css') }}"
	>
@endpushOnce

<x-layouts.legacy-main
	:$title
	:$location
	:headerConfig="['floating' => true]"
>
	<x-page-header
		class="dark"
		image="reviews-background.webp"
		:$title
	/>

	<div class="page-body">
		<div class="reviews">

			@foreach ($reviews as $key => $review)
				<div
					class="review load--fade-in js-load"
					data-direction="bottom"
					data-delay="{{ $key % 3 }}"
					data-load-threshold="0"
				>

					@if ($review->hasImage())
						<div class="review__image">
							<img
								class="image-fill"
								src="{{ $review->image() }}"
								alt=""
								loading="lazy"
							>
						</div>
					@endif

					<div
						class="review__content grid"
						data-spacing="400"
					>

						@if ($review->hasIcon())
							<div class="review__icon rounded-full">
								<img
									class="image-fill rounded-[inherit]"
									src="{{ $review->icon() }}"
									alt=""
									loading="lazy"
								>
							</div>
						@endif

						<div class="fa-center">
							<h3 class="review__name text-xl">
								<a
									href="{{ $review->contactUrl }}"
									target="_blank"
								>
									<span>
										{{ $review->name }}
									</span>
									<x-icon-link class="w-[1em]" />
								</a>
							</h3>
							<p class="review__subtitle">{{ $review->location }}</p>
						</div>
						<p class="review__text">{{ $review->text }}</p>
					</div>
				</div>
			@endforeach

		</div>
	</div>
</x-layouts.legacy-main>
