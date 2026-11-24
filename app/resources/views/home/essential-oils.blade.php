<section class="home-oils full-width" aria-labelledby="home-oils-title">
    <div class="breakout home-oils__inner">
        <div class="home-oils__intro">
            <div>
                <x-eyebrow>{{ __('Novità 2027') }}</x-eyebrow>
                <x-heading.section id="home-oils-title">{{ __('Oli essenziali') }}</x-heading.section>
                <p class="home-oils__tagline">{{ __('L’essenza più pura del tuo rituale in sauna.') }}</p>
            </div>
            <p>{{ __('Oli essenziali puri, senza alcol, per le gettate in sauna. Sedici fragranze da scoprire, dalle note balsamiche agli accordi agrumati e floreali.') }}</p>
        </div>

        <div class="home-oils__cards">
            @foreach ([
                ['image' => 'eucalyptus', 'name' => 'Eucalipto', 'notes' => 'Fresco · Balsamico · Penetrante'],
                ['image' => 'sweet-orange', 'name' => 'Arancio Dolce', 'notes' => 'Fruttato · Solare · Allegro'],
                ['image' => 'lavender', 'name' => 'Lavanda', 'notes' => 'Floreale · Morbido · Rilassante'],
            ] as $oil)
                <article class="home-oils__card">
                    <div class="home-oils__illustration">
                        <img
                            src="{{ asset('images/home/essential-oils/' . $oil['image'] . '.jpg') }}"
                            alt=""
                            loading="lazy"
                            width="443"
                            height="430"
                        >
                    </div>
                    <x-heading.small-component>{{ __($oil['name']) }}</x-heading.small-component>
                    <p>{{ __($oil['notes']) }}</p>
                </article>
            @endforeach
        </div>

        <div class="home-oils__footer">
            <dl class="home-oils__facts">
                <div><dt>100%</dt><dd>{{ __('oli essenziali puri') }}</dd></div>
                <div><dt>16</dt><dd>{{ __('fragranze da esplorare') }}</dd></div>
                <div><dt>30 / 100 ml</dt><dd>{{ __('due formati, un rituale') }}</dd></div>
            </dl>
            <x-button href="{{ route('essential-oils.index') }}">{{ __('Scopri le fragranze') }}</x-button>
        </div>
    </div>
</section>
