@pushOnce('styles')
	<link
		rel="stylesheet"
		href="{{ asset('css/legacy/blog.css') }}"
	>
@endpushOnce

<x-layouts.legacy-main
	:$title
	:$location
	:headerConfig="['floating' => true]"
>
	<x-page-header
		class="dark"
		image="blog-background.webp"
		:$title
	/>

	<section class="page-body">
		<div class="main-wrap">
			<div class="posts grid">

				@foreach ($posts as $key => $post)
					<div class="post">
						<div
							class="post__image load--fade-in js-load"
							data-direction="left"
							data-delay="3"
						>
							<img
								class="image-cover"
								src="{{ $post->image() }}"
								alt=""
								loading="lazy"
							>
						</div>

						<a
							class="post__content load--fade-in js-load grid"
							data-direction="right"
							data-delay="1"
							data-spacing="700"
							href="{{ $post->url() }}"
						>
							<div class="">
								<p class="post__subtitle">{{ $post->date() }}</p>
								<h3 class="post__title text-3xl font-medium text-neutral-700">{{ $post->title }}</h3>
							</div>
							<p class="post__text">{{ $post->snippet(250) }}</p>
							<p class="post__read-more">continua a leggere</p>
						</a>
					</div>
				@endforeach

			</div>
		</div>
	</section>

</x-layouts.legacy-main>
