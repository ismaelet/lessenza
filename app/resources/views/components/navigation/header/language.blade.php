<div class="language-switcher" x-data="{ open: false }" @click.outside="open = false" @keydown.escape.window="open = false">
    <button type="button" class="language-switcher__trigger" @click="open = !open" :aria-expanded="open.toString()" aria-label="{{ __('Cambia lingua') }}">
        <x-language-flag :locale="app()->getLocale()" />
        <span class="sr-only">{{ app()->getLocale() === 'en' ? 'English' : 'Italiano' }}</span>
    </button>
    <div class="language-switcher__dropdown" x-show="open" x-transition style="display: none">
        @foreach (['it' => 'Italiano', 'en' => 'English'] as $locale => $label)
            <form method="POST" action="{{ route('language', $locale) }}">
                @csrf
                <input type="hidden" name="return_to" value="{{ request()->getRequestUri() }}" />
                <button type="submit" class="language-switcher__option" @if (app()->getLocale() === $locale) aria-current="true" @endif lang="{{ $locale }}">
                    <x-language-flag :$locale />
                    <span>{{ $label }}</span>
                </button>
            </form>
        @endforeach
    </div>
</div>
