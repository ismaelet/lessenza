{% block main %}

<?= snippet_page_head() ?>

<section class="page-body">
	<div class="main-wrap py-20">

		<?php if ($records) { ?>
			<div class="grid-flow gap-8" data-columns='25rem'>

				<?php foreach ($records as $key => $record) { ?>

					<iframe class="w-100 aspect-video" src="<?= $record->embeddedVideoUrl() . '?controls=0' ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

				<?php } ?>

			</div>

		<?php } else { ?>
			<div class="grid items-center min-h-96">
				<p class="text-center text-lg">Non è ancora stato aggiunto nessun video</p>
			</div>
		<?php } ?>

	</div>
</section>

{% end main %}