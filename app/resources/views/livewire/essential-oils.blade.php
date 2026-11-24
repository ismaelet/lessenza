<section id="oli" class="oil-catalogue">
    <div class="oil-tools">
        <div class="grid gap-3">
            <x-eyebrow>{{ __('La collezione') }}</x-eyebrow>
            <x-heading.section>{{ __('Le :count fragranze', ['count' => $total]) }}</x-heading.section>
        </div>
        <form
            action="{{ route('essential-oils.index') }}#oli"
            method="GET"
            wire:submit="$refresh"
            role="search"
            class="oil-search"
        >
            <label for="oil-search" class="sr-only">{{ __('Cerca un olio o un profumo') }}</label>
            <x-input
                id="oil-search"
                type="search"
                name="q"
                wire:model.live.debounce.250ms="query"
                placeholder="{{ __('Cerca un olio o un profumo') }}…"
            />
        </form>
    </div>

    @if ($oils->isEmpty())
        <p role="status">{{ __('Nessun olio trovato. Prova con un altro nome o profumo.') }}</p>
    @else
        <div class="product-grid">
            @foreach ($oils as $oil)
                <div wire:key="oil-{{ $oil['slug'] }}">
                    <x-product-card :product="$oil" />
                </div>
            @endforeach
        </div>
    @endif
</section>
