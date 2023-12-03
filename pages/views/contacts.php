{% block main %}

<?= snippet_page_head() ?>

<!-- Content -->
<div class="main-wrap grid-flow pad-v-7" data-align="top" data-columns="25rem" data-row-spacing="600" data-column-spacing="900">

	<!-- Contacts data -->
	<section class="grid-flow" data-spacing="800">
		<h2 class="section-title"><?= $websiteName ?></h2>

		<p class="fa-justify">
			Se hai dubbi, domande o vuoi richiedere un'informazione, compila il modulo di contatto che trovi in questa pagina oppure usando uno dei link di contatto qui sotto, ti risponderemo nel più breve tempo possibile.
		</p>

		<div class="contacts grid-flow" data-spacing="400">

			<?php foreach ($contacts as $contactSlug => $contact) { ?>

				<div class="contact">
					<a class="contact__icon contrasting-background" href="<?= sys_config('contact-' . $contactSlug . '-link') ?>" target="_blank">
						<?= icon_embed('contacts/' . $contactSlug) ?>
					</a>

					<div class="contact__content">
						<p class="contact__label"><?= $contact ?></p>
						<p>
							<a class="fc-hover-primary" href="<?= sys_config('contact-' . $contactSlug . '-link') ?>" target="_blank"><?= sys_config('contact-' . $contactSlug) ?></a>
						</p>
					</div>
				</div>

			<?php } ?>

		</div>
	</section>

	<!-- Contact form -->
	<section class="contact-form">
		<form method="POST" autocomplete="off">
			<div class="grid-flow" data-spacing="700">
				<div class="grid-flow" data-spacing="400">
					<?php if ($sent) { ?>
						<p class="confirmation">Messaggio inviato, ti risponderemo il più presto possibile.</p>
					<?php } ?>

					<?php if ($error == 'email-bad') { ?>
						<p class="confirmation">Error: email address not recognized. You can write me directly at <?= sys_config('cont-mail_link') ?>, instead of using this form.</p>
					<?php } ?>

					<?php if ($error == 'word-bad') { ?>
						<p class="confirmation">Error: the message didn't pass the spam filter. You can write me directly at <?= sys_config('cont-mail_link') ?>, instead of using this form.</p>
					<?php } ?>

					<div class="animated-field">
						<p class="animated-field__label"><?= __('Name') ?></p>
						<input type="text" name="name" class="animated-field__input" onfocus="$(this).parents('.animated-field').addClass('is-used')" onblur="if (!$(this).val().length) {$(this).parents('.animated-field').removeClass('is-used')}" required>
					</div>

					<div class="animated-field">
						<p class="animated-field__label"><?= __('E-mail address') ?></p>
						<input type="email" name="email" class="animated-field__input" onfocus="$(this).parents('.animated-field').addClass('is-used')" onblur="if (!$(this).val().length) {$(this).parents('.animated-field').removeClass('is-used')}" required>
					</div>

					<div class="animated-field">
						<p class="animated-field__label"><?= __('Text') ?></p>
						<textarea name="text" class="animated-field__input" maxlength="500" onfocus="$(this).parents('.animated-field').addClass('is-used')" onblur="if (!$(this).val().length) {$(this).parents('.animated-field').removeClass('is-used')}" required></textarea>
					</div>
				</div>

				<button type="submit" class="button place-right" name="submit"><?= __('Send') ?></button>
			</div>
		</form>
	</section>
</div>

{% end main %}