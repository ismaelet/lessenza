@php

	global $header;

	$user = auth()->user();

	// theme
	$header['theme'] = 'light';
	$header['floating'] = false;
	$header['sticky'] = false;
	$header['mobile-threshold'] = 1024;

	/*
	 * Elements
	 *	- Navigation:
	 *		desktop-navigation: desktop navigation bar
	 *		mobile-icon: the burger icon to open the mobile menu
	 *	- Branding
	 *		logo: the svg or webp logo
	 *		name: the name of the website
	 *	- Profile
	 *		profile-icon: the icon that redirects to he user's profile
 *		profile-link: the button that redirects to he user's profile
	 *	- Ecommerce
	 *		cart-icon: the cart icon
	 *	- Search
	 *		search-icon: inline search icon with expanding search bar
	 *		search-bar: extended search bar
	 *		simple-search-icon: search icon with dropdown search bar
	 *	- Languages
	 *		language-icon: language switcher with dropdown
	 */
	$header['structure'] = [
	    'left' => ['simple-search-icon'],
	    'center' => ['desktop-navigation'],
	    'right' => ['profile-icon', 'cart-icon'],
	    'mobile-left' => ['simple-search-icon'],
	    'mobile-center' => [],
	    'mobile-right' => ['profile-icon', 'cart-icon', 'mobile-icon'],
	    'hanging-content' => [],
	];

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
	    ['label' => 'Video', 'location' => 'video', 'url' => client_url('/videos')],
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
* Desktop navigation bar
*/
$headerComponent['desktop-navigation'] = function () {
	// nav structure
	function generate_nav() {
		$items = generate_nav_items();

		$html = '<!-- Desktop navigation -->
					<nav class="h__nav">
						<ul>
							' . $items . '
						</ul>
					</nav>';

		return $html;
	}

	// nav item list
	function generate_nav_items() {
		global $header;

		$items = [];
		$navigationItemList = header_filter_navigation_items((array) $header['links'], false);

		foreach ($navigationItemList as $item) {
			$items[] = generate_nav_item($item);
		}

		return implode('', $items);
	}

	// nav item
	function generate_nav_item($item) {
		$link = isset($item['url']) ? 'href="' . $item['url'] . '"' : '';
		$title = $item['label'];
		$dropdownIcon = isset($item['drop']) ? '<span class="h__ddown-icon">&#x25BC;</span>' : '';
		$dropdown = isset($item['drop']) ? generate_dropdown($item) : '';
		$dataMegameu = isset($item['megamenu']) ? 'data-function="open-megamenu" data-target="' . $item['megamenu'] . '"' : '';

		// classes
		$classActive = isset($item['url']) ? 'h__link--active' : 'h__link--inactive';
		$classHighlighted =  '';
		$classes = array_filter(['h__link', $classActive, $classHighlighted]);
		$classes = implode(' ', $classes);

		$html = '<li class="' . $classes . '" ' . $dataMegameu . '>
								<a ' . $link . '>
									' . $title . '' . $dropdownIcon . '
								</a>
								' . $dropdown . '
							</li>
							';

		return $html;
	}

	// dropdown
	function generate_dropdown($item) {
		global $header;

		$items = [];

		// dropdown items
		foreach ((array) $header['dropdowns'][$item['drop']] as $dropdownItem) {

			$link = $dropdownItem[1];
			$title = $dropdownItem[0];

			$itemHtml = '
					<p class="h__ddown-link">
						<a href="' . $link . '">' . $title . '</a>
					</p>';

			$items[] = $itemHtml;
		}

		$items = implode('', $items);

		// dropdown structure
		$html = '<div class="h__ddown">
					' . $items . '
				</div>';

		return $html;
	}

	return generate_nav();
};

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

		<?php foreach ($navigationItemList as $link) { ?>

		<li class="h__mobile-navigation__link">
			<a href="<?= $link['url'] ?>"><?= $link['label'] ?></a>
		</li>

		<?php } ?>

	</ul>
</nav>

<?php };

/*
* Logo
*/
$headerComponent['logo'] = function () {
	$svgLogo = true;
	$logo = LOGO_DIR . 'logo.svg';

	if (!file_exists(SERVER_ROOT . $logo)) {
		$svgLogo = false;
		$logo = LOGO_DIR . 'logo-header.webp';
	}
?>

<a
	class="h__logo"
	href="<?= client_url('/') ?>"
>
	<?= $svgLogo ? embed_icon(LOGO_DIR . 'logo') : '<img src="' . client_path($logo) . '" alt="logo">' ?>
</a>

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

$headerComponent['simple-search-icon'] = function () { ?>
<!-- <form class="" action="<?= client_url('/shop#shop') ?>" method="GET" autocomplete="off"> -->
<a
	class="h__nav-icon"
	href="<?= client_url('/shop') ?>"
>
	<?= embed_icon('search') ?>
</a>

<!-- <input type="text" class="h__search-inp" name="search" placeholder="<?= __('Search') ?>"> -->
<!-- </form> -->
<?php };

/*
* Languages
*/
/*$headerComponent['language-icon'] = '

	<div class="h__languages load ld-bot ld-del2">

			<div class="h__language-icon h__language-icon_active background-fill" <?= icon_css('languages/' . $_SESSION['language']) ?>></div>

<div class="h__languages-ddown">

	<?php foreach ($header['languages'] as $h_lang) { ?>

	<a
		href="?lang=<?= $h_lang[1] ?>"
		class="h__language <?= $_SESSION['language'] == $h_lang[1] ? 'active' : '' ?>"
	>

		<div
			class="h__language-icon background-fill"
			<?= icon_css('languages/' . $h_lang[1]) ?>
		></div>

		<p class="h__language-name"><?= $h_lang[0] ?></p>

	</a>

	<?php } ?>

</div>

</div>
';*/

/*
* Theme switch
*/
/*$headerComponent['theme-switch'] = '
<!-- Theme switch -->
<div class="h__theme-switch h__nav-icon">
	<div
		class="light-icon icon-box"
		data-theme="light"
	>
		<?= embed_icon('sun') ?>
	</div>
	<div
		class="dark-icon icon-box"
		data-theme="dark"
	>
		<?= embed_icon('moon') ?>
	</div>
</div>

*/

/*
* Profile icon
*/
$headerComponent['profile-icon'] = function () { ?>
<a
	class="h__nav-icon"
	href="<?= client_url('/profile') ?>"
>
	<?= embed_icon('profile-full') ?>
</a>
<?php };

$headerComponent['profile-button'] = '
	<a class="h__profile h__nav-icon" href="' . client_url('/profile') . '">
		<div class="icon-box">
			' . embed_icon('profile-circle') . '
		</div>

		<p>' . ($user?->firstName ?: 'Profilo') . '</p>
	</a>
';

/*
* Cart icon
*/
$headerComponent['cart-icon'] = function () { ?>

<a
	class="h__nav-icon h__nav-icon--cart <?= cart()->quantity ? 'active' : '' ?> js-cart-data-quantity"
	href="<?= client_url('/cart') ?>"
	data-quantity="<?= cart()->quantity ?>"
>
	<?= embed_icon('bag') ?>
</a>

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
			<div class="h__desktop responsive-min-<?= $header['mobile-threshold'] ?>">
				<section class="h__bars h-bars--desktop">
					<!-- Top left bar -->
					<div class="h__bar h-bar--desktop">
						<?php foreach ($header['structure']['left'] as $h_component) {
						    echo $headerComponent[$h_component]();
						} ?>
					</div>
					<div class="h__bar h-bar--desktop">
						<?php foreach ($header['structure']['center'] as $h_component) {
						    echo $headerComponent[$h_component]();
						} ?>
					</div>
					<div class="h__bar h-bar--desktop">
						<?php foreach ($header['structure']['right'] as $h_component) {
						    echo $headerComponent[$h_component]();
						} ?>
					</div>
				</section>
			</div>

			<!-- Mobile Header -->
			<div class="h__mobile responsive-max-<?= $header['mobile-threshold'] ?>">
				<div class="h__bars h-bars--mobile">
					<div class="h__bar h-bar--mob">
						<?php foreach ($header['structure']['mobile-left'] as $h_component) {
						    echo $headerComponent[$h_component]();
						} ?>
					</div>
					<div class="h__bar h-bar--mob">
						<?php foreach ($header['structure']['mobile-center'] as $h_component) {
						    echo $headerComponent[$h_component]();
						} ?>
					</div>
					<div class="h__bar h-bar--mob">
						<?php foreach ($header['structure']['mobile-right'] as $h_component) {
						    echo $headerComponent[$h_component]();
						} ?>
					</div>
				</div>
			</div>
		</div>

		<div class="h__hanging-content">
			<?php foreach ($header['structure']['hanging-content'] as $h_component) {
			    echo $headerComponent[$h_component]();
			} ?>

			<!-- Mobile navigation -->
			<?= $headerComponent['mobile-menu']() ?>

			<!-- Megamenus -->
			<?= $headerComponent['megamenus']() ?>
		</div>
	</div>
</header>
