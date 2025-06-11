<form
	class="shop shop--sticky"
	id="shop"
	action="#shop"
	method="GET"
	autocomplete="off"
>

	<input
		type="hidden"
		id="js-itemN"
		value="{{ $productCount }}"
	>

	<!-- Side bar -->
	<aside class="sidebar">
		<div class="sidebar__content">

			<!-- Mobile dropdonw -->
			<p
				class="sidebar__open"
				onclick="$(this).toggleClass('open'); $(this).next().toggleClass('open')"
			>
				Filtra la ricerca
				<x-icon-arrow1-right />
			</p>

			<!-- Side bar body -->
			<div id="search-sec">
				<div class="sidebar__body pad-b-1">

					<!-- Searcher -->
					<section class="sidebar__panel">
						<h3 class="sidebar__subtitle">Cerca</h3>

						<!-- Module: searcher -->
						<div
							class="searcher grid"
							data-spacing="200"
						>
							<div class="searcher__body">
								<input
									type="text"
									class="searcher__input js-seacher"
									name="search"
									value="{{ $search }}"
									placeholder="Cerca un prodotto"
									maxlength="30"
									autocomplete="off"
									wire:model.live.debounce.250ms="search"
								>

								<button
									type="submit"
									class="searcher__icon"
								>
									<x-icon-search />
								</button>
							</div>

							@if ($search)
								<p
									class="remove-filter mar-t-05 js-clear-search"
									data-target="js-seacher"
									@click="$wire.set('search', null)"
								>
									<strong>x</strong>
									cancella la ricerca
								</p>
							@endif

						</div>

					</section>

					<!-- Filters -->
					@foreach ($filters as $filter)
						<x-shop.filter
							:filter="$filter"
							:typeId="$typeId"
						/>
					@endforeach

					<!-- Remove filters -->
					@if ($typeId)
						<p
							class="remove-filter mar-t-1 js-clear-search"
							data-target="js-filter-type"
							@click="$wire.set('typeId', null)"
						>
							<strong>x</strong>
							rimuovi i filtri
						</p>
					@endif

				</div>
			</div>
		</div>
	</aside>

	<!-- Main content -->
	<div class="shop-content pad-b-4">
		<section class="shop__header">
			<!-- Title -->
			<x-heading.section>Catalogo</x-heading.section>
			<x-subheading.section>
				{{ $productCount . ($productCount == 1 ? ' risultato' : ' risultati') }}
			</x-subheading.section>

			<!-- Sort products -->
			<section class="sort-bar">
				<label>
					<input
						type="radio"
						class="js-sort"
						name="sort"
						value="new"
						wire:model.live="sort"
						@checked($sort == 'new')
					>
					<p class="sort-bar__text interactive">Novità</p>
				</label>

				<p class="sort-bar__text">&middot;</p>

				<label>
					<input
						type="radio"
						class="js-sort"
						name="sort"
						value="popular"
						wire:model.live="sort"
						@checked($sort == 'popular')
					>
					<p class="sort-bar__text interactive">Popolari</p>
				</label>
			</section>
		</section>

		<!-- products -->
		@if ($products)

			<section class="shop__body stack-content relative grid items-start">
				<div
					class="shop__products grid"
					data-columns="15rem"
					data-spacing="700"
				>

					@foreach ($products as $product)
						<x-product-card :$product />
					@endforeach

				</div>

				<x-icon-loading
					class="absolute left-1/2 top-1/2 w-16 -translate-x-1/2 -translate-y-1/2"
					wire:loading
				/>
			</section>
		@else
			<div class="empty-warning center-content grid">
				<div>
					<x-icon-warning />
				</div>
				<p class="">Nessun prodotto trovato.<br>Prova a cambiare i filtri di ricerca.</p>
			</div>
		@endif

		<!-- Pages -->
		@if ($pageCount > 1)
			$base = $this->shopSettings->page - 2;

			if ($base <
				1)
				$base=1;
				$top=$base
				+
				4;
				if
				($top
			> $pageN) {
				$top = $pageN;
				$i = $top - 4;
				} else $i = $base;

				if ($i <
					1)
					$i=1
					?
				>

					<section
						id="page-box"
						class="txt-cen mar-t-3"
					>

						<input
							type="hidden"
							id="page-inp"
							name="page"
							value="<?= $this->shopSettings->page ?>"
						>

						<?php if ($base > 1) { ?><p class="page_txt disabled">...</p><?php } ?>

						<?php while ($i <= $top) { ?>
						<p
							class="page_txt clickable <?php if ($i == $this->shopSettings->page) {
							    echo 'select disabled';
							} ?>"
							data-page="<?= $i ?>"
						><?= $i ?></p>
						<?php $i++;
						} ?>

						<?php if ($pageN > $top) { ?><p class="page_txt disabled">...</p><?php } ?>

						<button
							type="submit"
							id="page-btn"
							class="hidden"
						></button>

					</section>
		@endif

	</div>

</form>
