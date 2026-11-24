<?php

use App\Http\Controllers\HomeController;
use App\Support\EssentialOilCatalogue;
use Illuminate\Http\Request;

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
