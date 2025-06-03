@php
	use App\Models\Review;

	$reviews = Review::latest()->get();
@endphp

<section class="slider grid-flow stack-content">
	<!-- Background -->
	<div
		class="slider__background fill-all background-fill responsive-max-1024"
		<?= background_image('slider-background-mobile.webp') ?>
	>
		<div class="slider__overlay fill-all"></div>
	</div>

	<div
		class="slider__background fill-all background-fill responsive-min-1024"
		<?= background_image('slider-background.webp') ?>
	>
		<div class="slider__overlay fill-all"></div>
	</div>

	<!-- Content -->
	<div class="slider__content">
		<!-- Contacts -->
		<div class="slider__contacts contrasting-background responsive-min-1024">
			<div
				class="js-load load--fade-in"
				data-direction="left"
				data-delay="0"
			>
				<a
					class="slider__contact"
					href="<?= sys_config('contact-facebook-link') ?>"
				>
					{!! embed_icon('facebook') !!}
				</a>
			</div>
			<div
				class="js-load load--fade-in"
				data-direction="left"
				data-delay="1"
			>
				<a
					class="slider__contact"
					href="<?= sys_config('contact-instagram-link') ?>"
				>
					{!! embed_icon('instagram') !!}
				</a>
			</div>
			<div
				class="js-load load--fade-in"
				data-direction="left"
				data-delay="2"
			>
				<a
					class="slider__contact"
					href="<?= sys_config('contact-phone-link') ?>"
				>
					{!! embed_icon('phone') !!}
				</a>
			</div>
			<div
				class="js-load load--fade-in"
				data-direction="left"
				data-delay="3"
			>
				<a
					class="slider__contact"
					href="<?= sys_config('contact-email-link') ?>"
				>
					{!! embed_icon('email') !!}
				</a>
			</div>
		</div>

		<!-- Body -->
		<div class="slider__body grid-flow contrasting-background">
			<div
				class="grid-flow"
				data-spacing="700"
			>
				<div
					class="slider__title-wrapper grid-flow center-content"
					data-spacing="200"
				>
					<!-- <h1 class="slider__title js-load load--fade-in" data-direction="bottom">L<span class="fc-primary">’</span>Essenza</h1> -->
					<img
						class="slider__logo js-load load--fade-in mar-b-1"
						data-direction="top"
						data-delay="1"
						src="<?= client_path('slider/logo.svg') ?>"
						alt=""
					>
					<img
						class="slider__title--image js-load load--fade-in"
						data-direction="bottom"
						src="<?= client_path('slider/title.svg') ?>"
						alt=""
					>
					<img
						class="slider__subtitle--image js-load load--fade-in"
						data-direction="bottom"
						data-delay="1"
						src="<?= client_path('slider/subtitle.webp') ?>"
						alt=""
					>
					<!-- <p class="slider__subtitle js-load load--fade-in" data-direction="bottom" data-delay="1">Respira la</p> -->
				</div>

				<div
					class="slider__reviews grid-flow stack-content js-load load--fade-in"
					data-direction="bottom"
					data-delay="2"
				>

					@foreach ($reviews as $key => $review)
						<p
							class="slider__text limit-lines <?= !$key ? 'active' : '' ?> js-review"
							data-lines="4"
						>
							"{{ $review->text }}"
						</p>
					@endforeach

				</div>

			</div>

			<div
				class="js-load load--fade-in"
				data-direction="top"
				data-delay="1"
			>
				<a
					href="<?= client_url('/reviews') ?>"
					class="slider__button button button--auto-width"
				>Tutte le recensioni</a>
			</div>
		</div>

		<!-- Search bar -->
		<form
			class="big-search-bar js-load load--fade-in"
			data-direction="bottom"
			data-delay="1"
			action="shop"
			method="GET"
		>
			<input
				type="text"
				name="search"
				placeholder="Cerca una fragranza"
			>
			<button
				class="button-without-style"
				type="submit"
			>
				{!! embed_icon('search') !!}
			</button>
		</form>

		<!-- Highlight slider -->
		<div class="highlighted-product__slider hidden">
			<div class="highlighted-product__arrow">{!! embed_icon('arrow1-left') !!}</div>
			<h3 class="highlighted-product__title">Novità</h3>
			<h3 class="highlighted-product__name">nome prodotto</h3>
			<div class="highlighted-product__arrow">{!! embed_icon('arrow1-right') !!}</div>
		</div>
	</div>
</section>
