<?php

use function Ecommerce\cart;

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
			case (isset($item['admin']) && !admin());

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
		$classHighlighted = View::$location == $item['location'] ? 'h__link--highlighted' : '';
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

	<a class="h__logo" href="<?= client_url('/') ?>">
		<?= $svgLogo ? icon_embed(LOGO_DIR . 'logo') : '<img src="' . client_path($logo) . '" alt="logo">' ?>
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
	<!-- <form class="" action="<?= client_url('/shop#shop')  ?>" method="GET" autocomplete="off"> -->
	<a class="h__nav-icon" href="<?= client_url('/shop') ?>">
		<?= icon_embed('search')  ?>
	</a>

	<!-- <input type="text" class="h__search-inp" name="search" placeholder="<?= __('Search')  ?>"> -->
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

					<a href="?lang=<?= $h_lang[1] ?>" class="h__language <?= $_SESSION['language'] == $h_lang[1] ? 'active' : '' ?>">

						<div class="h__language-icon background-fill" <?= icon_css('languages/' . $h_lang[1]) ?>></div>

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
						<div class="light-icon icon-box" data-theme="light">
							<?= icon_embed('sun') ?>
						</div>
						<div class="dark-icon icon-box" data-theme="dark">
							<?= icon_embed('moon') ?>
						</div>
					</div>

*/

/*
* Profile icon
*/
$headerComponent['profile-icon'] = function () { ?>
	<a class="h__nav-icon" href="<?= client_url('/profile') ?>">
		<?= icon_embed('profile-full') ?>
	</a>
<?php };

$headerComponent['profile-button'] = '
	<a class="h__profile h__nav-icon" href="' . client_url('/profile') . '">
		<div class="icon-box">
			' . icon_embed('profile-circle') . '
		</div>

		<p>' . ($user->firstName ?: 'Profilo') . '</p>
	</a>
';

/*
* Cart icon
*/
$headerComponent['cart-icon'] = function () { ?>

	<a class="h__nav-icon h__nav-icon--cart <?= cart()->quantity ? 'active' : '' ?> js-cart-data-quantity" href="<?= client_url('/cart') ?>" data-quantity="<?= cart()->quantity ?>">
		<?= icon_embed('bag') ?>
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

				<div class="megamenu <?= isset($megamenu['type']) ? 'megamenu--' . $megamenu['type'] : '' ?>" id="megamenu-<?= $megamenuName ?>">
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

									<div class="megamenu-group grid gap1">
										<?php if ($megamenuSection['title']) { ?>

											<h3 class="megamenu-title ">
												<a href="<?= $megamenuSection['url'] ?>"><?= $megamenuSection['title'] ?></a>
											</h3>

										<?php } ?>

										<div class="megamenu-links grid gap1">
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
};
