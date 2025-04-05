{% block main %}

<!-- Welcome panel -->
<section class="welcome grid-flow stack-content center-content contrasting-background">
	<div class="welcome_bgr fill-all background-fill" <?= background_image('background') ?>></div>
</section>

<!-- Form -->
<form method="POST" class="form pos-rel">

	<!-- Header -->
	<div class="form-head">
		<h1 class="title title--register load--fade-in js-load" data-direction="bottom" data-delay="0"><?= View::$title ?></h1>
	</div>

	<!-- Body -->
	<div class="form-body">

		<?= generate_form($inputs, false, $error) ?>

	</div>

	<!-- Footer -->
	<div class="form-footer grid-flow center-content">
		<!-- Register -->
		<div class="load--fade-in js-load" data-direction="bottom" data-delay="2">
			<button type="submit" class="button" name="submit">Registrati</button>
		</div>

		<!-- Back -->
		<div class="load--fade-in js-load" data-direction="bottom" data-delay="3">
			<a href="<?= client_url('/login') ?>" class="button button--secondary"><?= __('Back') ?></a>
		</div>

	</div>
</form>

{% end main %}