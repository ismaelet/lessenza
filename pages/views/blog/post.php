{% block main %}

<div class="page-body main-wrap grid-flow mt-16" data-spacing="700">
	<h1 class="main-post__title title"><?= $post->title ?></h1>

	<section class="main-post__content grid-flow" data-spacing="700">
		<?php if ($post->video_url) { ?>
			<iframe class="main-post__video w-100 aspect-video" src="<?= $post->embeddedVideoUrl() . '?controls=0' ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
		<?php } else { ?>
			<img class="main-post__image" src="<?= $post->clientImage ?>" alt="">
		<?php } ?>

		<div>
			<p class="main-post__date"><?= $post->date ?></p>
		</div>

		<p class="main-post__text"><?= $post->text ?></p>
	</section>

	<aside class="related-posts grid-flow" data-columns="20rem" data-spacing="700">

		<?php foreach ($post->relatedPosts as $key => $post) { ?>

			<a class="related-post load--fade-in js-load" data-direction="bottom" data-delay="<?= $key % 2 ?>" href="<?= $post->clientUrl ?>">
				<div class="related-post__image">
					<img class="image-cover" src="<?= $post->clientImage ?>" alt="" loading="lazy">
				</div>

				<div class="related-post__content grid-flow" data-spacing="200">
					<div class="">
						<p class="related-post__subtitle"><?= $post->date ?></p>
						<h3 class="related-post__title"><?= $post->title ?></h3>
					</div>
					<p class="related-post__text"><?= $post->text(100) ?></p>
				</div>
			</a>

		<?php } ?>

	</aside>
</div>

{% end main %}