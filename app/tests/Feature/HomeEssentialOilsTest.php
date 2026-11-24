<?php

use App\Http\Controllers\HomeController;
use App\Support\EssentialOilCatalogue;
use Illuminate\Http\Request;

it('renders the home essential oils copy in English', function () {
    app()->setLocale('en');
    $data = app(HomeController::class)->index(Request::create('/'), new EssentialOilCatalogue)->getData();
    $html = view('home.essential-oils', $data)->render();

    foreach ([
        'New for 2027',
        'Essential oils',
        'The purest essence of your sauna ritual.',
        'Essential oils selected by a professional Aufguss Meister for their lasting fragrance in the sauna.',
        'pure essential oils',
        'fragrances to explore',
        'two sizes, one ritual',
        'Discover the fragrances',
    ] as $translation) {
        expect($html)->toContain($translation);
    }

    expect($html)->not->toContain('Novità 2027', 'Oli essenziali selezionati', 'due formati, un rituale');
});

it('renders every catalogue oil once across three rotating home cards', function () {
    $catalogue = new EssentialOilCatalogue;
    $data = app(HomeController::class)->index(Request::create('/'), $catalogue)->getData();
    $html = view('home.essential-oils', $data)->render();

    expect($data['essentialOils'])->toHaveCount($catalogue->all()->count());
    expect(substr_count($html, 'class="home-oils__slot"'))->toBe(3);
    expect(substr_count($html, ' hidden '))->toBe($catalogue->all()->count() - 3);

    foreach ($data['essentialOils'] as $oil) {
        expect(substr_count($html, 'href="'.$oil->url.'"'))->toBe(1);
        expect($html)->toContain(e($oil->image));
        expect($html)->toContain(e(preg_replace('/\s*,\s*/u', ' · ', $oil->scent)));
    }
});
