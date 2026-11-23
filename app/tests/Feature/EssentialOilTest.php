<?php

use App\Http\Controllers\ContactsController;
use App\Http\Controllers\EssentialOilController;
use App\Livewire\EssentialOils;
use App\Support\EssentialOilCatalogue;
use Illuminate\Http\Request;
use Livewire\Livewire;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Tests\TestCase;

class EssentialOilTest extends TestCase
{
    public function test_catalogue_lists_all_oils(): void
    {
        $data = app(EssentialOilController::class)->index(Request::create('/oli-essenziali'), new EssentialOilCatalogue)->getData();
        expect($data['total'])->toBe(16);
        expect($data['oils'])->toHaveCount(16);
        expect($data['oils']->pluck('slug')->all())->toContain('pino-cembro');
    }

    public function test_search_matches_names_botanical_names_and_fragrances(): void
    {
        foreach ([[' LAVANDA ', 'Lavanda'], ['pinus sibirica', 'Pino Cembro (Cirmolo)'], ['AGRUMATO', 'Limone']] as [$query, $name]) {
            $data = app(EssentialOilController::class)->index(
                Request::create('/oli-essenziali', 'GET', ['q' => $query]),
                new EssentialOilCatalogue,
            )->getData();
            $this->assertContains($name, $data['oils']->pluck('olio')->all());
            $this->assertLessThan(16, $data['oils']->count());
        }
    }

    public function test_unknown_search_has_no_results(): void
    {
        $data = app(EssentialOilController::class)->index(
            Request::create('/oli-essenziali', 'GET', ['q' => 'non-esistente']),
            new EssentialOilCatalogue,
        )->getData();

        expect($data['oils'])->toBeEmpty();
    }

    public function test_live_search_filters_and_clears_without_submitting(): void
    {
        $component = Livewire::test(EssentialOils::class)
            ->assertSeeHtml('wire:model.live.debounce.250ms="query"')
            ->assertViewHas('oils', fn ($oils) => $oils->count() === 16);

        foreach ([' LAVANDA ', 'pinus sibirica', 'AGRUMATO'] as $query) {
            $component->set('query', $query)
                ->assertViewHas('oils', fn ($oils) => $oils->isNotEmpty() && $oils->count() < 16);
        }

        $component->set('query', 'non-esistente')
            ->assertViewHas('oils', fn ($oils) => $oils->isEmpty())
            ->set('query', '')
            ->assertViewHas('oils', fn ($oils) => $oils->count() === 16);
    }

    public function test_live_search_reads_query_from_url(): void
    {
        Livewire::withQueryParams(['q' => 'pinus sibirica'])
            ->test(EssentialOils::class)
            ->assertSet('query', 'pinus sibirica')
            ->assertViewHas('oils', fn ($oils) => $oils->pluck('slug')->all() === ['pino-cembro']);
    }

    public function test_detail_data(): void
    {
        $data = app(EssentialOilController::class)->show('anice', new EssentialOilCatalogue)->getData();
        expect($data['oil']['cas'])->toBe('84650-59-9');
        expect($data['oil']['frasi_H'])->toContain('H351');
        expect(array_column($data['oil']['varianti'], 'prezzo_iva_esclusa'))->toBe(['15,90', '35,90']);
        expect(array_column($data['oil']['varianti'], 'codice'))->toBe(['AANI-30', 'AANI-100']);
        expect($data['related'])->toHaveCount(4);
        expect($data['related']->pluck('slug')->all())->not->toContain('anice');
    }

    public function test_unknown_oil(): void
    {
        $this->expectException(HttpException::class);
        app(EssentialOilController::class)->show('non-esistente', new EssentialOilCatalogue);
    }

    public function test_catalogue_assets(): void
    {
        $oils = (new EssentialOilCatalogue)->all();

        expect($oils)->toHaveCount(16);
        expect($oils->pluck('slug')->unique())->toHaveCount(16);

        foreach ($oils as $oil) {
            expect(array_column($oil['varianti'], 'formato'))->toBe(['30 ml', '100 ml']);
            foreach ([$oil['anteprima'], $oil['scheda_sicurezza'], ...array_column($oil['varianti'], 'immagine')] as $asset) {
                expect(is_file(public_path('oli-essenziali/'.$asset)))->toBeTrue();
            }
        }
    }

    public function test_enquiry_prefill(): void
    {
        $controller = app(ContactsController::class);
        $catalogue = new EssentialOilCatalogue;
        $valid = $controller->index(Request::create('/contacts', 'GET', ['olio' => 'anice', 'formato' => '100 ml']), $catalogue);
        $invalid = $controller->index(Request::create('/contacts', 'GET', ['olio' => 'anice', 'formato' => '500 ml']), $catalogue);

        expect($valid->getData()['message'])->toContain('Anice 100 ml (AANI-100)');
        expect($invalid->getData()['message'])->toBe('');
    }
}
