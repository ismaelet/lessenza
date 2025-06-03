@php

	global $header;

	$footer = [];

	// Links
	$footer['links'] = $header['links'];

	// Contacts
	$footer['contacts'] = [
	    ['slug' => 'instagram', 'link' => sys_config('contact-instagram-link')],
	    ['slug' => 'facebook', 'link' => sys_config('contact-facebook-link')],
	    ['slug' => 'phone', 'link' => sys_config('contact-phone-link')],
	    ['slug' => 'email', 'link' => sys_config('contact-email-link')],
	];

	// Notes
	$footer['notes'] =
	    '
	P.IVA ' .
	    sys_config('VAT') .
	    ' | Copyright © ' .
	    getdate()['year'] .
	    ' ' .
	    sys_config('full-name') .
	    '<br>
	Web designer: <a class="" href="mailto:ismaele.tuffanelli@gmail.com">Ismaele Tuffanelli</a>
';

@endphp

@pushOnce('styles')
	<style>
		/*
			* Layout
			*/
		.f__content {
			padding-block: 3rem;
			background-color: var(--clr-secondary-400);
		}

		.f__contact {
			--icon-size: 50%;
			width: 2.5rem;
			aspect-ratio: 1;
			background-color: var(--clr-secondary-700);
			border-radius: 50%;
			color: var(--fc-700);
			transition: background-color 0.2s, color 0.2s;
		}

		.f__contact:hover {
			background-color: var(--clr-primary-400);
			color: var(--clr-neutral-100);
		}

		.f__link {
			font-size: var(--fs-300);
			font-weight: var(--fw-medium);
			text-transform: uppercase;
			transition: color 0.2s;
		}

		.f__link:hover {
			color: var(--clr-primary-400);
		}

		.f__notes {
			padding-block: 1rem;
			background-color: var(--clr-secondary-500);
			color: var(--clr-secondary-200);
			font-size: var(--fs-300);
			text-align: center;
		}
	</style>
@endpushOnce

<footer class="contrasting-background">
	<div class="f__content">
		<div
			class="grid-flow center-content main-wrap"
			data-spacing="800"
		>
			<div
				class="grid-flow center-content"
				data-spacing="700"
			>

				<!-- Contacts -->
				<div
					class="f__contacts flex-group"
					data-spacing="400"
				>

					<?php foreach ($footer['contacts'] as $f_contact) { ?>

					<a
						class="f__contact"
						href="<?= $f_contact['link'] ?>"
					>
						<?= embed_svg('contacts/' . $f_contact['slug']) ?>
					</a>

					<?php } ?>

				</div>

				<!-- Navigation -->
				<nav class="f__navigation">
					<ul
						class="flex-group center-content"
						data-spacing="700"
					>

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
