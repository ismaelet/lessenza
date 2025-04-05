{% block main %}

<?= snippet_page_head() ?>

<section class="page-body">
	<div class="main-wrap">
		<div class="posts grid-flow">

			<?php foreach ($posts as $key => $post) { ?>

				<div class="post">
					<div class="post__image load--fade-in js-load" data-direction="left" data-delay="3">
						<img class="image-cover" src="<?= $post->clientImage ?>" alt="" loading="lazy">
					</div>

					<a class="post__content grid-flow load--fade-in js-load" data-direction="right" data-delay="1" data-spacing="700" href="<?= $post->clientUrl ?>">
						<div class="">
							<p class="post__subtitle"><?= $post->date ?></p>
							<h3 class="post__title"><?= $post->title ?></h3>
						</div>
						<p class="post__text"><?= $post->text(250) ?></p>
						<p class="post__read-more">continua a leggere</p>
					</a>
				</div>

			<?php } ?>

		</div>
	</div>
</section>

{% end main %}