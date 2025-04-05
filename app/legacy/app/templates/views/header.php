<header class="header" data-theme="<?= $header['theme'] ?>" data-floating="<?= $header['floating'] ? 'true' : 'false' ?>" data-sticky="<?= $header['sticky'] ? 'true' : 'false' ?>" data-mobile-threshold="<?= $header['mobile-threshold'] ?>">
	<div class="h__wrapper">
		<div class="h__main-content">

			<!-- Header desktop -->
			<div class="h__desktop responsive-min-<?= $header['mobile-threshold'] ?>">
				<section class="h__bars h-bars--desktop">
					<!-- Top left bar -->
					<div class="h__bar h-bar--desktop">
						<?php foreach ($header['structure']['left'] as $h_component) echo $headerComponent[$h_component](); ?>
					</div>
					<div class="h__bar h-bar--desktop">
						<?php foreach ($header['structure']['center'] as $h_component) echo $headerComponent[$h_component](); ?>
					</div>
					<div class="h__bar h-bar--desktop">
						<?php foreach ($header['structure']['right'] as $h_component) echo $headerComponent[$h_component](); ?>
					</div>
				</section>
			</div>

			<!-- Mobile Header -->
			<div class="h__mobile responsive-max-<?= $header['mobile-threshold'] ?>">
				<div class="h__bars h-bars--mobile">
					<div class="h__bar h-bar--mob">
						<?php foreach ($header['structure']['mobile-left'] as $h_component) echo $headerComponent[$h_component](); ?>
					</div>
					<div class="h__bar h-bar--mob">
						<?php foreach ($header['structure']['mobile-center'] as $h_component) echo $headerComponent[$h_component](); ?>
					</div>
					<div class="h__bar h-bar--mob">
						<?php foreach ($header['structure']['mobile-right'] as $h_component) echo $headerComponent[$h_component](); ?>
					</div>
				</div>
			</div>
		</div>

		<div class="h__hanging-content">
			<?php foreach ($header['structure']['hanging-content'] as $h_component) echo $headerComponent[$h_component](); ?>

			<!-- Mobile navigation -->
			<?= $headerComponent['mobile-menu']() ?>

			<!-- Megamenus -->
			<?= $headerComponent['megamenus']() ?>
		</div>
	</div>
</header>