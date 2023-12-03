<footer class="contrasting-background">
	<div class="f__content">
		<div class="grid-flow center-content main-wrap" data-spacing="800">
			<div class="grid-flow center-content" data-spacing="700">

				<!-- Contacts -->
				<div class="f__contacts flex-group" data-spacing="400">

					<?php foreach ($footer['contacts'] as $f_contact) { ?>

						<a class="f__contact" href="<?= $f_contact['link'] ?>">
							<?= icon_embed('contacts/' . $f_contact['slug']) ?>
						</a>

					<?php } ?>

				</div>

				<!-- Navigation -->
				<nav class="f__navigation">
					<ul class="flex-group center-content" data-spacing="700">

						<?php foreach ($footer['links'] as $f_link) { ?>

							<li class="f__link"><a href="<?= $f_link['url'] ?>"><?= $f_link['label'] ?></a></li>

						<?php } ?>

					</ul>
				</nav>
			</div>
		</div>
	</div>

	<!-- Notes -->
	<div class="f__notes">
		<div class="main-wrap">
			<p><?= $footer['notes'] ?></p>
		</div>
	</div>
</footer>