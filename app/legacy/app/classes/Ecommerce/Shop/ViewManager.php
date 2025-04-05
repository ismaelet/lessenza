<?php

namespace Ecommerce\Shop;

use Ecommerce\ViewManager as EcommerceViewManager;

use function Ecommerce\ecommerce_config;

class ViewManager {

	private $shopSettings = null;

	function __construct(object $shopSettings) {
		$this->shopSettings = $shopSettings;
	}

	public function render() { ?>

		<form class="shop <?= ecommerce_config('shop-page')['sticky-sidebar'] ? 'shop--sticky' : '' ?>" id="shop" action="#shop" method="GET" autocomplete="off">

			<input type="hidden" id="js-itemN" value="<?= $this->shopSettings->productCount ?>">

			<!-- Side bar -->
			<aside class="sidebar">
				<div class="sidebar__content">

					<!-- Mobile dropdonw -->
					<p class="sidebar__open" onclick="$(this).toggleClass('open'); $(this).next().toggleClass('open')">
						Filtra la ricerca
						<?= icon_embed('navigation/arrow1-right') ?>
					</p>

					<!-- Side bar body -->
					<div id="search-sec">
						<div class="sidebar__body pad-b-1">

							<!-- Searcher -->
							<section class="sidebar__panel">
								<h3 class="sidebar__subtitle">Cerca</h3>

								<!-- Module: searcher -->
								<div class="searcher grid-flow" data-spacing="200">
									<div class="searcher__body">
										<input type="text" class="searcher__input js-seacher" name="search" value="<?= $this->shopSettings->search ?>" placeholder="Cerca un prodotto" maxlength="30" autocomplete="off">

										<button type="submit" class="searcher__icon">
											<?= icon_embed('search') ?>
										</button>
									</div>

									<?php if ($this->shopSettings->search) { ?>

										<p class="remove-filter mar-t-05 js-clear-search" data-target="js-seacher">
											<strong>x</strong>
											cancella la ricerca
										</p>

									<?php } ?>

								</div>

							</section>

							<?php if (ecommerce_config('shop-page')['price-range']) { ?>

								<!-- Module: price range -->
								<section class="sidebar__panel">
									<h3 class="sidebar__subtitle">Filtra per prezzo</h3>

									<!-- Module: price range -->
									<div class=" price-range">
										<input type="hidden" id="price-range_val" name="price-range" value="<?= $this->shopSettings->currentPriceRange['min'] . ',' . $this->shopSettings->currentPriceRange['max'] ?>" readonly>

										<div class="price-range_slider mar-b-2" id="price-range_slider" data-min="<?= $this->shopSettings->priceRange['min'] ?>" data-max="<?= $this->shopSettings->priceRange['max'] ?>" data-currentmin="<?= $this->shopSettings->currentPriceRange['min'] ?>" data-currentmax="<?= $this->shopSettings->currentPriceRange['max'] ?>"></div>

										<div class="price-range_footer flex-line">
											<button type="submit" class="price-range_btn pbtn">Filtra</button>
											<p class="price-range_text">Prezzo: € <span id="price-range_min"><?= $this->shopSettings->currentPriceRange['min'] ?></span> — € <span id="price-range_max"><?= $this->shopSettings->currentPriceRange['max'] ?></span></p>
										</div>
									</div>

								</section>

							<?php } ?>

							<!-- Filters -->
							<?php foreach ($this->shopSettings->filters as $filter) { ?>

								<section class="filter sidebar__panel">
									<input type="checkbox" class="filter__checkbox" id="filter-<?= $filter['slug'] ?>" <?= !empty($_GET[$filter['slug']]) || $filter['opened-by-default'] ? 'checked' : '' ?>>

									<label class="filter__header" for="filter-<?= $filter['slug'] ?>">
										<h3 class="filter__title">
											<?= $filter['title'] ?>
										</h3>

										<div class="filter__ddown-icon icon-box">
											<?= icon_embed('navigation/arrow1-down') ?>
										</div>
									</label>

									<div class="filter__ddown">
										<div class="filter__ddown-wrapper">

											<?php foreach ($filter['list'] as $filterItem) { ?>

												<label class="filter-item">
													<input type="checkbox" class="filter-item__checkbox js-filter-type" name="<?= $filter['slug'] ?>" value="<?= $filterItem->id ?>" <?= !empty($_GET[$filter['slug']]) && $_GET[$filter['slug']] == $filterItem->id ? 'checked' : '' ?>>
													<p class="filter-item__name"><?= $filterItem->pluralName ?></p>
												</label>

											<?php } ?>

										</div>
									</div>
								</section>

							<?php } ?>

							<?php if (ecommerce_config('shop-page')['sale-filter']) { ?>

								<!-- Filter promotions -->
								<section class="sidebar__panel">

									<!-- Module: filter promotions -->
									<div class="filter__promotions">
										<label class="cbx">
											<input type="checkbox" name="promotion" value="1" <?= $this->shopSettings->promotion ? 'checked' : '' ?>>
											<div class="icon"></div>
											<p>Mostra solo i prodotti in promozione</p>
										</label>
									</div>

								</section>

							<?php } ?>

							<!-- Remove filters -->
							<?php foreach ($this->shopSettings->filters as $filter) {
								if (!empty($_GET[$filter['slug']])) { ?>

									<p class="remove-filter mar-t-1 js-clear-search" data-target="js-filter-type">
										<strong>x</strong>
										rimuovi i filtri
									</p>

							<?php break;
								}
							} ?>

						</div>
					</div>
				</div>
			</aside>

			<!-- Main content -->
			<div class="shop-content pad-b-4">
				<section class="shop__header">
					<!-- Title -->
					<h2 class="section-title"><?= $this->shopSettings->title ?></h2>
					<p class="section-subtitle"><?= $this->shopSettings->productCount . ($this->shopSettings->productCount == 1 ? ' risultato' : ' risultati') ?></p>

					<!-- Sort products -->
					<section class="sort-bar" x-data>
						<label>
							<input type="radio" class="js-sort" name="sort" value="new" <?= $this->shopSettings->sort == 'new' ? 'checked' : '' ?> @input="$el.closest('form').submit()">
							<p class="sort-bar__text interactive">Novità</p>
						</label>

						<p class="sort-bar__text">&middot;</p>

						<label>
							<input type="radio" class="js-sort" name="sort" value="popular" <?= $this->shopSettings->sort == 'popular' ? 'checked' : '' ?> @input="$el.closest('form').submit()">
							<p class="sort-bar__text interactive">Popolari</p>
						</label>
					</section>
				</section>

				<!-- products -->
				<?php if ($this->shopSettings->products) { ?>

					<section class="shop__body grid-flow stack-content">
						<div class="shop__products grid-flow" data-columns="15rem" data-spacing="700">

							<?php foreach ($this->shopSettings->products as $product) {
								echo EcommerceViewManager::renderProductCard($product);
							} ?>

						</div>

						<div class="shop__loading fill-all js-load load--fade-out" data-load-type="always">
							<?= icon_embed('loading') ?>
						</div>
					</section>

				<?php } else { ?>

					<div class="empty-warning grid-flow center-content">
						<div>
							<?= icon_embed('warning') ?>
						</div>
						<p class="">Nessun prodotto trovato.<br>Prova a cambiare i filtri di ricerca.</p>
					</div>

				<?php } ?>

				<!-- Pages -->

				<?php

				$pageN = ceil($this->shopSettings->productCount / $this->shopSettings->size);

				if ($pageN > 1) {

					$base = $this->shopSettings->page - 2;

					if ($base < 1) $base = 1;

					$top = $base + 4;

					if ($top > $pageN) {
						$top = $pageN;
						$i = $top - 4;
					} else $i = $base;

					if ($i < 1) $i = 1 ?>

					<section id="page-box" class="txt-cen mar-t-3">

						<input type="hidden" id="page-inp" name="page" value="<?= $this->shopSettings->page ?>">

						<?php if ($base > 1) { ?><p class="page_txt disabled">...</p><?php } ?>

						<?php while ($i <= $top) { ?>
							<p class="page_txt clickable <?php if ($i == $this->shopSettings->page) echo 'select disabled' ?>" data-page="<?= $i ?>"><?= $i ?></p>
						<?php $i++;
						} ?>

						<?php if ($pageN > $top) { ?><p class="page_txt disabled">...</p><?php } ?>

						<button type="submit" id="page-btn" class="hidden"></button>

					</section>

				<?php } ?>

			</div>

		</form>

<?php }
}
