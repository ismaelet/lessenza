{% block content %}

<form method="POST">
	<!-- Guest -->
	<section class="guest">
		<h2 class="subsection-title">Ordina come ospite</h2>
		<p>Se non ti vuoi registrare puoi procedere qui come ospite.</p>
		<button type="submit" class="pbtn wid-100 mar-t-2" name="advance" formnovalidate>Continua come ospite</button>
	</section>

	<!-- Divisory -->
	<div class="divisory">
		<div class="divisory_line"></div>
		<p class="divisory_text">Oppure</p>
		<div class="divisory_line"></div>
	</div>

	<!-- Login -->
	<section class="login">
		<h2 class="subsection-title">Accedi</h2>

		<div class="form-body grid gap1">
			<input type="hidden" name="url" value="<?= $_GET['url'] ?? '' ?>">
			<div class="form-field">
				<input type="text" name="username" id="username" class="inp clear-error" placeholder="<?= __('Username') ?>" required>
			</div>
			<div class="form-field">
				<input type="password" name="password" id="password" class="inp clear-error" placeholder="<?= __('Password') ?>" required>
			</div>

			<?php if ($error) { ?>
				<p class="error"><?= __('Wrong access data') ?></p>
			<?php } ?>

			<div class="options-bar">
				<label class="cbx blk">
					<input type="checkbox" name="remember" checked>
					<div class="icon"></div>
					<p class="cbx-txt"><?= __('Stay connected') ?></p>
				</label>

				<a href="<?= client_url('/recover') ?>" class="txt-rig">
					<p class=""><?= __('Forgot the password?') ?></p>
				</a>
			</div>
		</div>

		<div class="form-footer mar-t-2">
			<a href="<?= client_url('/register') ?>" class="sbtn br-c3-h"><?= __('Sign up') ?></a>
			<button type="submit" name="submit" id="submit" class="pbtn">Log In</button>
		</div>
	</section>
</form>

{% end content %}