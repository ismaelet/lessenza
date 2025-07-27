@props(['location' => null, 'config' => []])

@php

	global $header;

	$user = auth()->user();

	// theme
	$header['theme'] = 'light';
	$header['floating'] = $config['floating'] ?? false;
	$header['sticky'] = false;
	$header['mobile-threshold'] = 1024;

	/*
	 * Elements settings
	 */
	$header['title'] = sys_config('name');
	$header['title-mobile'] = $header['title'];
	$header['login-link'] = [
	    'not-logged' => [
	        'label' => 'Login',
	        'url' => client_url('/login'),
	    ],
	    'logged' => [
	        'label' => $user?->username,
	        'url' => client_url('/profile'),
	    ],
	];

	/*
	 * Links
	 *	filters: mobile, logged, admin, manager
	 */
	$header['links'] = [
	    ['label' => 'Home', 'location' => 'home', 'url' => client_url('/')],
	    ['label' => 'Le Fragranze', 'location' => 'shop', 'url' => client_url('/shop')],
	    ['label' => 'Chi Siamo', 'location' => 'about-us', 'url' => client_url('/about-us')],
	    ['label' => 'Recensioni', 'location' => 'reviews', 'url' => client_url('/reviews')],
	    ['label' => 'Blog', 'location' => 'blog', 'url' => client_url('/blog')],
	    ['label' => 'Video', 'location' => 'videos', 'url' => client_url('/videos')],
	    ['label' => 'Contatti', 'location' => 'contacts', 'url' => client_url('/contacts')],
	    ['label' => 'Gestione', 'location' => 'admin', 'url' => client_url('/admin'), 'admin' => true],
	];

	// dropdowns
	/*$header['dropdowns']['*dropdown-name*'] = [
	['Title', client_url('/link')],
];*/

	// load components
	// include_once '-expands-header/components.php';

@endphp

@pushOnce('styles')
	<style>

	</style>
@endpushOnce

<?php

/*
* Filter navigation items
*/

function header_filter_navigation_items(array $items, bool $isMobileMenu = null) {
	foreach ($items as $key => $item) {
		switch (true) {
			// check mobile filters
			case (isset($item['mobile']) && $item['mobile'] && $isMobileMenu === false):
			case (isset($item['mobile']) && !$item['mobile'] && $isMobileMenu):

				// check logged filter
			case (isset($item['logged']) && $item['logged'] && !logged()):
			case (isset($item['logged']) && $item['logged'] && !logged()):

				// check admin filter
			case (isset($item['admin']) && !is_admin());

				// check manager filter
			case (isset($item['manager']) && !manager()):
				unset($items[$key]);
				break;
		}
	}

	return $items;
}

/*
* Mobile icon
*/
$headerComponent['mobile-icon'] = function () { ?>
<div class="h__mobile-icon js-toggle-mobile-menu">
	<div class="h__mobile-icon-part">
		<div class="h__mobile-icon-line"></div>
	</div>
	<div class="h__mobile-icon-part">
		<div class="h__mobile-icon-line"></div>
	</div>
	<div class="h__mobile-icon-part">
		<div class="h__mobile-icon-line"></div>
	</div>
</div>
<?php };

/*
* Mobile menu
*/
$headerComponent['mobile-menu'] = function () {
	global $header;

	$navigationItemList = header_filter_navigation_items((array) $header['links'], true);
?>

<nav class="h__mobile-navigation">
	<ul class="h__mobile-navigation__links">

		@foreach ($navigationItemList as $link)
			<li class="h__mobile-navigation__link">
				<a href="{{ $link['url'] }}">{{ $link['label'] }}</a>
			</li>
		@endforeach

	</ul>
</nav>

<?php };

/*
* title
*/
$headerComponent['title'] = function () {
	global $header;
?>

<p class="h__title">
	<a href="<?= client_url('/') ?>"><?= $header['title'] ?></a>
</p>

<?php };

/*
* Search bar
*/
$headerComponent['search-bar'] = function () { ?>
<!--  -->
<?php };

$headerComponent['search-icon'] = function () { ?>
<!--  -->
<?php };

/*
* Megamenus
*/
$headerComponent['megamenus'] = function () {
global $header;

if (isset($header['megamenus'])) {
?>

<section class="megamenus">

	<div class="megamenus_backdrop"></div>

	<?php foreach ((array) $header['megamenus'] as $megamenuName => $megamenu) { ?>

	<div
		class="megamenu <?= isset($megamenu['type']) ? 'megamenu--' . $megamenu['type'] : '' ?>"
		id="megamenu-<?= $megamenuName ?>"
	>
		<div class="megamenu-content main-wrap pad-t-2 pad-b-2">

			<?php if (isset($megamenu['type']) && $megamenu['type'] == 'free') {
							foreach ($megamenu['links'] as $megamenulink) {

								if (!isset($megamenuSection['mobile']) || !$megamenuSection['mobile']) { ?>

			<p class="megamenu_link">
				<a href="<?= $megamenulink[1] ?>"><?= $megamenulink[0] ?></a>
			</p>

			<?php }
							}
						} else {
							foreach ($megamenu as $megamenuSection) {

								if (!isset($megamenuSection['mobile']) || !$megamenuSection['mobile']) { ?>

			<div class="megamenu-group gap1 grid">
				<?php if ($megamenuSection['title']) { ?>

				<h3 class="megamenu-title">
					<a href="<?= $megamenuSection['url'] ?>"><?= $megamenuSection['title'] ?></a>
				</h3>

				<?php } ?>

				<div class="megamenu-links gap1 grid">
					<?php foreach ($megamenuSection['links'] as $h_megamenuLink) { ?>
					<p class=""><a href="<?= $h_megamenuLink[1] ?>"><?= $h_megamenuLink[0] ?></a></p>
					<?php } ?>
				</div>
			</div>
			<?php }
							}
						} ?>

		</div>
	</div>

	<?php } ?>

</section>

<?php }
};?>


@pushOnce('styles')
	<link
		rel="stylesheet"
		href="{{ asset('css/legacy/header.css') }}"
	>
@endpushOnce

@pushOnce('scripts')
	<script defer>
		$(function() {
			const header = $("header");
			const headerMainContent = $(".h__main-content");

			// mobile menu
			$(".js-toggle-mobile-menu").on("click", function() {
				header.toggleClass("opened");
			});

			// fix height
			fix_height();

			$(window).on("resize", function() {
				fix_height();
			});

			function fix_height() {
				const headerHeight = headerMainContent.outerHeight();

				header.css("height", headerHeight + "px");
			}
		});
	</script>
@endpushOnce

<header
	class="header"
	data-theme="<?= $header['theme'] ?>"
	data-floating="<?= $header['floating'] ? 'true' : 'false' ?>"
	data-sticky="<?= $header['sticky'] ? 'true' : 'false' ?>"
	data-mobile-threshold="<?= $header['mobile-threshold'] ?>"
>
	<div class="h__wrapper">
		<div class="h__main-content">

			<!-- Header desktop -->
			<div class="h__desktop hidden lg:block">
				<section class="h__bars h-bars--desktop">
					<!-- Top left bar -->
					<div class="h__bar h-bar--desktop">
						<x-navigation.header.search />
					</div>
					<div class="h__bar h-bar--desktop">
						<x-navigation.header.desktop-navigation
							:links="$header['links']"
							:$location
						/>
					</div>
					<div class="h__bar h-bar--desktop">
						<x-navigation.header.profile-icon />
						<livewire:header.cart-icon />
					</div>
				</section>
			</div>

			<!-- Mobile Header -->
			<div class="h__mobile lg:hidden">
				<div class="h__bars h-bars--mobile">
					<div class="h__bar h-bar--mob">
						<x-navigation.header.search />
					</div>
					<div class="h__bar h-bar--mob">
					</div>
					<div class="h__bar h-bar--mob">
						<x-navigation.header.profile-icon />
						<livewire:header.cart-icon />
						<x-navigation.header.mobile-icon />
					</div>
				</div>
			</div>
		</div>

		{{-- Hanging content --}}
		<div class="h__hanging-content">

			<!-- Mobile navigation -->
			<nav class="h__mobile-navigation">
				<ul class="h__mobile-navigation__links">

					<li class="h__mobile-navigation__link">
						<a href="/">Home</a>
					</li>
					<li class="h__mobile-navigation__link">
						<a href="/shop">Le Fragranze</a>
					</li>


					<li class="h__mobile-navigation__link">
						<a href="/about-us">Chi Siamo</a>
					</li>


					<li class="h__mobile-navigation__link">
						<a href="/reviews">Recensioni</a>
					</li>


					<li class="h__mobile-navigation__link">
						<a href="/blog">Blog</a>
					</li>


					<li class="h__mobile-navigation__link">
						<a href="/videos">Video</a>
					</li>


					<li class="h__mobile-navigation__link">
						<a href="/contacts">Contatti</a>
					</li>

				</ul>
			</nav>
		</div>
	</div>
</header>
