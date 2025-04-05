<nav class="profile-nav">
	<input type="checkbox" class="hidden" id="profile-nav-cbx">

	<!-- Title -->
	<label class="profile-nav_header" for="profile-nav-cbx">
		<h3 class="profile-nav-title flex-group">
			<?= icon_embed('list') ?>
			Profilo
		</h3>
	</label>

	<!-- Navigation menu -->
	<ul class="profile-nav-links">

		<?php foreach ($profileLinks as $profileLink) { ?>

			<li class="profile-nav-link <?= $profileLocation == $profileLink['location'] ? 'active' : '' ?>">
				<a href="<?= client_url($profileLink['url']) ?>">
					<p class="flex-group" data-spacing="400">
						<?= icon_embed($profileLink['icon']) ?>
						<?= $profileLink['title'] ?>
					</p>
				</a>
			</li>

		<?php } ?>

	</ul>
</nav>