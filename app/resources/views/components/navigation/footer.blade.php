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
	    sys_config('full-name');

@endphp

@pushOnce('styles')
	<style>
		.f__content {
			padding-block: 3rem;
			background-color: var(--color-secondary-400);
		}

		.f__contact {
			--icon-size: 50%;
			width: 2.5rem;
			aspect-ratio: 1;
			background-color: var(--color-secondary-500);
			border-radius: 50%;
			transition: background-color 0.2s, color 0.2s;
		}

		.f__contact:hover {
			background-color: var(--color-primary-400);
		}

		.f__link {
			font-size: var(--text-300);
			font-weight: var(--fw-medium);
			text-transform: uppercase;
			transition: color 0.2s;
		}

		.f__link:hover {
			color: var(--color-primary-400);
		}

		.f__notes {
			padding-block: 1rem;
			background-color: var(--color-secondary-500);
			color: var(--clr-secondary-200);
			font-size: var(--text-300);
			text-align: center;
		}
	</style>
@endpushOnce

<footer class="contrasting-background dark">
	<div class="f__content">
		<div
			class="center-content main-wrap grid"
			data-spacing="800"
		>
			<div
				class="center-content grid"
				data-spacing="700"
			>

				<!-- Contacts -->
				<div
					class="f__contacts flex-group"
					data-spacing="400"
				>

					@foreach ($footer['contacts'] as $f_contact)
						<a
							class="f__contact grid place-items-center"
							href="<?= $f_contact['link'] ?>"
						>
							<x-dynamic-component
								:component="'icon-' . $f_contact['slug']"
								class="h-1/2 w-1/2"
							/>
						</a>
					@endforeach

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
		<div class="flex items-center justify-center gap-2 px-8">
			<a
				href="https://www.iubenda.com/privacy-policy/11710974"
				class="opacity-50 transition-opacity hover:opacity-100"
				title="Privacy Policy "
			>Privacy Policy</a>

			<span class="opacity-50">
				&middot;
			</span>

			<a
				href="https://www.iubenda.com/privacy-policy/11710974/cookie-policy"
				class="opacity-50 transition-opacity hover:opacity-100"
				title="Cookie Policy "
			>Cookie Policy</a>
		</div>

		<div class="main-wrap">
			<p class="opacity-50"><?= $footer['notes'] ?></p>
		</div>
	</div>
</footer>
