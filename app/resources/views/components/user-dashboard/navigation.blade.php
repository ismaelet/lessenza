@use('Illuminate\Support\Facades\Route')

@php
	$profileLinks = [
	    1 => [
	        'title' => 'Account',
	        'url' => route('user-dashboard.index'),
	        'location' => 'index',
	        'icon' => 'user-circle',
	    ],
	    2 => ['title' => 'Ordini', 'url' => '/profile/orders', 'location' => 'orders', 'icon' => 'orders'],
	    4 => ['title' => 'I miei dati', 'url' => '/profile/data', 'location' => 'data', 'icon' => 'settings'],
	    5 => ['title' => 'Logout', 'url' => '/logout', 'location' => 'logout', 'icon' => 'logout'],
	];

	$profileLocation = explode('user-dashboard.', Route::currentRouteName())[1];
@endphp

<nav class="profile-nav">
	<input
		type="checkbox"
		class="hidden"
		id="profile-nav-cbx"
	>

	<!-- Title -->
	<label
		class="profile-nav_header"
		for="profile-nav-cbx"
	>
		<h3 class="profile-nav-title flex gap-4 text-neutral-700">
			<x-icon-list class="h-5 w-5" />
			Profilo
		</h3>
	</label>

	<!-- Navigation menu -->
	<ul class="profile-nav-links">

		@foreach ($profileLinks as $profileLink)
			<li class="profile-nav-link <?= $profileLocation == $profileLink['location'] ? 'active' : '' ?>">
				<a href="<?= client_url($profileLink['url']) ?>">
					<p class="flex items-center gap-4">
						<x-dynamic-component
							:component="'icon-' . $profileLink['icon']"
							class="h-5 w-5"
						/>
						<?= $profileLink['title'] ?>
					</p>
				</a>
			</li>
		@endforeach

	</ul>
</nav>
