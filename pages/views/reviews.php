{% block main %}

<?= snippet_page_head() ?>

<section class="page-body">
	<div class="main-wrap">
		<div class="reviews">

			<?php foreach ($reviews as $key => $review) { ?>

				<div class="review load--fade-in js-load" data-direction="bottom" data-delay="<?= $key % 3 ?>" data-load-threshold="0">

					<?php if ($review->hasImage) { ?>

						<div class="review__image">
							<img class="image-fill" src="<?= $review->clientImage ?>" alt="" loading="lazy">
						</div>

					<?php } ?>

					<div class="review__content grid-flow" data-spacing="400">

						<?php if ($review->hasIcon) { ?>

							<div class="review__icon">
								<img class="image-fill" src="<?= $review->clientIcon ?>" alt="" loading="lazy">
							</div>

						<?php } ?>

						<div class="fa-center">
							<h3 class="review__name">
								<a href="<?= $review->contactUrl ?>" target="_blank">
									<span>
										<?= $review->name ?>
									</span>
									<?= icon_embed('link') ?>
								</a>
							</h3>
							<p class="review__subtitle"><?= $review->location ?></p>
						</div>
						<p class="review__text"><?= $review->text ?></p>
					</div>
				</div>

			<?php } ?>

		</div>
	</div>
</section>

{% end main %}