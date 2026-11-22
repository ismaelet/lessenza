<?php

use App\Support\EssentialOilCatalogue;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class LocalizationTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        config(['app.locale' => 'it']);
        app()->setLocale('it');
        Route::middleware('web')->get('/_test/locale', fn () => response()->json([
            'locale' => app()->getLocale(),
            'catalogue' => __('Catalogo'),
        ]));
    }

    public function test_italian_is_the_default_and_english_persists_in_the_session(): void
    {
        $this->get('/_test/locale')->assertOk()->assertJson(['locale' => 'it', 'catalogue' => 'Catalogo']);
        $this->withSession(['locale' => 'en'])->get('/_test/locale')->assertOk()->assertJson(['locale' => 'en', 'catalogue' => 'Catalogue']);
    }

    public function test_language_switch_preserves_the_current_page_and_filters(): void
    {
        $this->withSession(['_token' => 'language-test'])->post(route('language', 'en'), [
            '_token' => 'language-test',
            'return_to' => '/shop?typeId=8&page=2',
        ])->assertRedirect('/shop?typeId=8&page=2')->assertSessionHas('locale', 'en');
        $this->get('/_test/locale')->assertJson(['locale' => 'en']);

        $this->post(route('language', 'it'), [
            '_token' => 'language-test',
            'return_to' => '/contacts',
        ])->assertRedirect('/contacts')->assertSessionHas('locale', 'it');
    }

    public function test_unsupported_languages_and_external_redirects_are_rejected(): void
    {
        $this->withSession(['_token' => 'language-test'])->post('/language/de', ['_token' => 'language-test'])->assertNotFound();
        foreach (['https://example.com', '//example.com', '/\\example.com'] as $returnTo) {
            $this->post(route('language', 'en'), ['_token' => 'language-test', 'return_to' => $returnTo])->assertStatus(422);
        }
    }

    public function test_invalid_session_locale_falls_back_to_italian(): void
    {
        $this->withSession(['locale' => 'unsupported'])->get('/_test/locale')->assertJson(['locale' => 'it']);
    }

    public function test_authored_content_is_translated_without_changing_markup_or_identifiers(): void
    {
        app()->setLocale('en');
        $this->assertSame('Lemon', localized_text('Limone'));
        $this->assertSame('<p>Lemon</p><a href="/products/1-limone">Discover →</a>', localized_html('<p>Limone</p><a href="/products/1-limone">Scopri →</a>'));
        $this->assertSame('New untranslated content', localized_text('New untranslated content'));
        $this->assertSame('3 results', trans_choice(':count risultato|:count risultati', 3));

        $oil = (new EssentialOilCatalogue)->all()->first();
        $this->assertSame('Anise', $oil['olio']);
        $this->assertSame('anice', $oil['slug']);
        $this->assertSame('AANI-30', $oil['varianti'][0]['codice']);
        $this->assertStringContainsString('Suspected of causing cancer', $oil['frasi_H']);

        app()->setLocale('it');
        $this->assertSame('<p>Limone</p>', localized_html('<p>Limone</p>'));
    }

    public function test_translation_catalogues_have_matching_keys_and_all_static_view_strings(): void
    {
        $english = json_decode(file_get_contents(lang_path('en.json')), true, flags: JSON_THROW_ON_ERROR);
        $italian = json_decode(file_get_contents(lang_path('it.json')), true, flags: JSON_THROW_ON_ERROR);
        $this->assertSame(array_keys($italian), array_keys($english));

        foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator(resource_path('views'))) as $file) {
            if (! $file->isFile() || ! str_ends_with($file->getFilename(), '.blade.php')) {
                continue;
            }
            preg_match_all("/\\b__\\('((?:\\\\.|[^'\\\\])*)'/s", file_get_contents($file->getPathname()), $matches);
            foreach ($matches[1] as $key) {
                $key = str_replace(["\\'", '\\\\'], ["'", '\\'], $key);
                $this->assertArrayHasKey($key, $english, $file->getPathname());
            }
        }
    }
}
