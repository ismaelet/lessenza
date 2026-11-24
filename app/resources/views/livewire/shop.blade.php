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
				onclick="this.classList.toggle('open'); this.nextElementSibling.classList.toggle('open')"
			>
				{{ __('Filtra la ricerca') }}
				<x-icon-arrow1-right />
			</p>

			<!-- Side bar body -->
			<div id="search-sec">
				<div class="sidebar__body pad-b-1">

					<!-- Searcher -->
					<section class="sidebar__panel">
						<h3 class="sidebar__subtitle">{{ __('Cerca') }}</h3>

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
									placeholder="{{ __('Cerca un prodotto') }}"
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
									{{ __('cancella la ricerca') }}
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
							{{ __('rimuovi i filtri') }}
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
			<x-heading.section>{{ __('Catalogo') }}</x-heading.section>
			<x-eyebrow>
				{{ trans_choice(':count risultato|:count risultati', $productCount, ['count' => $productCount]) }}
			</x-eyebrow>

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
					<p class="sort-bar__text interactive">{{ __('Novità') }}</p>
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
					<p class="sort-bar__text interactive">{{ __('Popolari') }}</p>
				</label>
			</section>
		</section>

		<!-- products -->
		@if ($products->isNotEmpty())

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
				<p class="">{{ __('Nessun prodotto trovato.') }}<br>{{ __('Prova a cambiare i filtri di ricerca.') }}</p>
			</div>
		@endif

		<!-- Pages -->
		@if ($pageCount > 1)
			<nav aria-label="{{ __('Pagine del catalogo') }}" class="mt-12 flex flex-wrap items-center justify-center gap-2">
				<button type="button" wire:click="setPage({{ $page - 1 }})" @disabled($page === 1) class="p-2 disabled:opacity-50">{{ __('Precedente') }}</button>
				@if ($pages[0] > 1)
					<button type="button" wire:click="setPage(1)" class="page_txt">1</button>
					@if ($pages[0] > 2)
						<span aria-hidden="true">…</span>
					@endif
				@endif
				@foreach ($pages as $number)
					<button type="button" wire:click="setPage({{ $number }})" class="page_txt {{ $number === $page ? 'select' : '' }}" @if ($number === $page) aria-current="page" @endif>{{ $number }}</button>
				@endforeach
				@if (end($pages) < $pageCount)
					@if (end($pages) < $pageCount - 1)
						<span aria-hidden="true">…</span>
					@endif
					<button type="button" wire:click="setPage({{ $pageCount }})" class="page_txt">{{ $pageCount }}</button>
				@endif
				<button type="button" wire:click="setPage({{ $page + 1 }})" @disabled($page === $pageCount) class="p-2 disabled:opacity-50">{{ __('Successiva') }}</button>
			</nav>
		@endif

	</div>

</form>
