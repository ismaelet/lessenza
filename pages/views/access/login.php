{% block main %}

<!-- Welcome panel -->
<section class="welcome grid-flow stack-content center-content contrasting-background">
	<div class="welcome_bgr fill-all background-fill" <?= background_image('background') ?>></div>

	<?php if ($loginConfig['welcome-text']) { ?>

		<div class="welcome_content">
			<h1 class="welcome_title">Lorem ipsum<br>eu exercitation</h1>

			<p class="welcome_text">
				In non dolore amet sunt incididunt aliqua aute dolor quis eiusmod. Sunt esse fugiat tempor exercitation eiusmod voluptate eu qui tempor esse dolor tempor irure sint commodo. Nostrud consequat fugiat velit id in culpa ut laboris duis in do duis elit irure labore ut. Laboris deserunt in deserunt exercitation dolore cupidatat occaecat exercitation occaecat dolore excepteur est ut.
			</p>
		</div>

	<?php } ?>

</section>

<!-- Form -->
<form method="POST" class="form pos-rel">

	<!-- Header -->
	<div class="form-head">
		<h2 class="title load--fade-in js-load" data-direction="bottom" data-delay="0">Login</h2>
	</div>

	<!-- Body -->
	<div class="form-body">

		<?php if ($action == 'wishlist') { ?>
			<p class="warning"><?= __('Before adding a product to your wishlist, you have to login.') ?></p>
		<?php } ?>

		<input type="hidden" name="url" value="<?= $_GET['url'] ?? '' ?>">
		<input type="email" name="username" id="username" class="inp clear-error load--fade-in js-load" placeholder="<?= __('E-mail') ?>" required data-direction="bottom" data-delay="1">
		<input type="password" name="password" id="password" class="inp clear-error load--fade-in js-load" placeholder="<?= __('Password') ?>" required data-direction="bottom" data-delay="2">

		<?php if ($error) { ?>

			<p class="error-warning"><?= __('Wrong access data') ?></p>

		<?php } ?>

		<div class="options-bar va-cen">

			<?php if ($loginConfig['stay-connected']) { ?>

				<label class="checkbox load--fade-in js-load" data-direction="top" data-delay="1">
					<input type="checkbox" name="remember" checked>
					<span></span>
					<p class=""><?= __('Stay connected') ?></p>
				</label>

			<?php } ?>

			<?php if ($loginConfig['password-recovery']) { ?>

				<p class="load--fade-in js-load" data-direction="top" data-delay="1"><a href="<?= client_url('/recover') ?>"><?= __('Forgot the password?') ?></a></p>

			<?php } ?>

		</div>
	</div>

	<!-- Footer -->
	<div class="form-footer">
		<!-- Login -->
		<div class="load--fade-in js-load" data-direction="bottom" data-delay="2">
			<button type="submit" class="button" name="submit">Log In</button>
		</div>

		<?php if ($loginConfig['register']) { ?>

			<!-- Register -->
			<div class="load--fade-in js-load" data-direction="bottom" data-delay="3">
				<a href="<?= client_url('/register') ?>" class="button button--secondary"><?= __('Register') ?></a>
			</div>

		<?php } ?>

	</div>
</form>

{% end main %}