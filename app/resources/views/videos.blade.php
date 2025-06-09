<x-layouts.legacy-main
	:$title
	:$locationTag
	:headerConfig="['floating' => true]"
>
	<x-page-header
		class="dark"
		:$title
		image="videos-background.webp"
	/>

	<div class="page-body">
		<div class="main-wrap py-20">

			@if ($videos->count())
				<div
					class="grid gap-8"
					data-columns='25rem'
				>

					<?php foreach ($videos as $key => $record) { ?>

					<iframe
						class="w-100 aspect-video"
						src="<?= $record->embeddedVideoUrl() . '?controls=0' ?>"
						frameborder="0"
						allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
						allowfullscreen
					></iframe>

					<?php } ?>

				</div>
			@else
				<div class="grid min-h-80 items-center">
					<p class="text-center text-lg">Non è ancora stato aggiunto nessun video</p>
				</div>
			@endif

		</div>
	</div>
</x-layouts.legacy-main>
