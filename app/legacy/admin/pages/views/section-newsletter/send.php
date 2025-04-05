{% block content %}

<form class="panel grid-flow" data-spacing="700" method="POST">
	<div class="panel__header">
		<h1 class="panel__title">Invia una newsletter</h1>
	</div>

	<div class="panel__body grid-flow mar-v-1" data-spacing="400">

		<?php if ($sent) { ?>

			<p class="confirmation-message">Newsletter inviata</p>

		<?php } ?>

		<input type="text" name="title" value="<?= $title ?>" placeholder="Titolo della newsletter">
		<textarea name="text" id="" rows="15" placeholder="Testo HTML della newsletter"><?= $emailContent ?></textarea>
	</div>

	<div class="panel__footer">
		<button type="submit" class="button" name="send">
			Invia
			<?= icon_embed('send-email') ?>
		</button>
	</div>
</form>

{% end content %}