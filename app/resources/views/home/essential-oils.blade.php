<section class="home-oils full-width" aria-labelledby="home-oils-title">
    <div class="breakout home-oils__inner">
        <div class="home-oils__intro">
            <div>
                <x-eyebrow>{{ __('Novità 2027') }}</x-eyebrow>
                <x-heading.section id="home-oils-title">{{ __('Oli essenziali') }}</x-heading.section>
                <p class="home-oils__tagline">{{ __('L’essenza più pura del tuo rituale in sauna.') }}</p>
            </div>
            <p>
                {{ __('Oli essenziali selezionati da un Aufguss Meister professionista per persistenza e durata in cabina.') }}
            </p>
        </div>

        <div class="home-oils__cards">
            @foreach ($essentialOils->take(3) as $initialOil)
                <div class="home-oils__slot">
                    @foreach ($essentialOils->filter(fn ($oil, $index) => $index % 3 === $loop->index) as $oil)
                        <article class="home-oils__card overflow-hidden rounded-lg" @if (! $loop->first) hidden @endif>
                            <a href="{{ $oil->url }}" class="home-oils__product">
                                <div class="home-oils__illustration">
                                    <img src="{{ $oil->image }}" alt="" loading="lazy" width="600" height="600" />
                                </div>
                                <div class="home-oils__content">
                                    <x-heading.component class="line-clamp-1">{{ $oil->name }}</x-heading.component>
                                    <p class="bg-background-400 text-trim text-secondary-300 w-fit rounded-full px-3 py-3 text-sm font-medium">
                                        {{ preg_replace('/\s*,\s*/u', ' · ', $oil->scent ?? '') }}
                                    </p>
                                </div>
                            </a>
                        </article>
                    @endforeach
                </div>
            @endforeach
        </div>

        <div class="home-oils__footer">
            <dl class="home-oils__facts">
                <div>
                    <dt>100%</dt>
                    <dd>{{ __('oli essenziali puri') }}</dd>
                </div>
                <div>
                    <dt>16</dt>
                    <dd>{{ __('fragranze da esplorare') }}</dd>
                </div>
                <div>
                    <dt>30 / 100 ml</dt>
                    <dd>{{ __('due formati, un rituale') }}</dd>
                </div>
            </dl>
            <x-button href="{{ route('essential-oils.index') }}">{{ __('Scopri le fragranze') }}</x-button>
        </div>
    </div>
</section>
