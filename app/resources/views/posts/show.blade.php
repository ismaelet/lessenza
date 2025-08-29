@pushOnce('styles')
	<link
		rel="stylesheet"
		href="{{ asset('css/legacy/post.css') }}"
	>
@endpushOnce

<x-layouts.legacy-main
	:$title
	:$location
>
	<div class="page-body main-wrap mt-16 grid pb-32">
		<x-heading.section-small
			class="mb-12 xl:col-span-2"
			size="small"
		>{{ $post->title }}</x-heading.section-small>

		<section
			class="main-post__content grid"
			data-spacing="700"
		>
			@if ($post->video_url)
				<iframe
					class="main-post__video w-100 aspect-video"
					src="{{ $post->embeddedVideoUrl() . '?controls=0' }}"
					frameborder="0"
					allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
					allowfullscreen
				></iframe>
			@else
				<img
					class="main-post__image"
					src="{{ $post->image() }}"
					alt=""
				>
			@endif

			<div>
				<p class="main-post__date">{{ $post->date() }}</p>
			</div>

			<p class="main-post__text">{!! nl2br($post->text) !!}</p>
		</section>

		<aside
			class="related-posts grid content-start"
			data-columns="20rem"
			data-spacing="700"
		>

			@foreach ($post->relatedPosts() as $key => $relatedPost)
				<a
					class="related-post load--fade-in js-load"
					data-direction="bottom"
					data-delay="{{ $key % 2 }}"
					href="{{ $relatedPost->url() }}"
				>
					<div class="related-post__image">
						<img
							class="image-cover"
							src="{{ $relatedPost->image() }}"
							alt=""
							loading="lazy"
						>
					</div>

					<div
						class="related-post__content grid"
						data-spacing="200"
					>
						<div class="">
							<p class="related-post__subtitle">{{ $relatedPost->date() }}</p>
							<h3 class="related-post__title text-neutral-700">{{ $relatedPost->title }}</h3>
						</div>
						<p class="related-post__text">{{ $relatedPost->snippet(100) }}</p>
					</div>
				</a>
			@endforeach

		</aside>
	</div>

</x-layouts.legacy-main>
