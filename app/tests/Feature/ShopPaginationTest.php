<?php

use App\Livewire\Shop;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Livewire\Livewire;
use Tests\TestCase;

class ShopPaginationTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        config(['database.connections.sqlite.database' => ':memory:']);
        DB::purge('sqlite');
        DB::setDefaultConnection('sqlite');

        Schema::create('product_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('names')->default('');
            $table->softDeletes();
        });
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->integer('product_type_id');
            $table->integer('statusId')->default(1);
            $table->integer('inStock')->default(1);
            $table->integer('recentSales')->default(0);
            $table->integer('sales')->default(0);
            $table->float('price')->default(15.9);
            $table->timestamps();
            $table->softDeletes();
        });
        DB::table('product_types')->insert([
            ['id' => 1, 'name' => 'Fragranze'],
            ['id' => 2, 'name' => 'Oli essenziali'],
        ]);
        for ($id = 1; $id <= 43; $id++) {
            DB::table('products')->insert([
                'id' => $id,
                'name' => 'Prodotto '.$id,
                'slug' => 'prodotto-'.$id,
                'product_type_id' => $id <= 40 ? 1 : 2,
            ]);
        }
    }

    public function test_catalogue_renders_multiple_pages_and_returns_only_the_current_page(): void
    {
        Livewire::test(Shop::class)
            ->assertStatus(200)
            ->assertSet('productCount', 43)
            ->assertSet('pageCount', 2)
            ->assertSet('products', fn ($products) => $products->count() === 35 && $products->first()->id === 1)
            ->assertSee('Successiva')
            ->call('setPage', 2)
            ->assertSet('page', 2)
            ->assertSet('products', fn ($products) => $products->count() === 8 && $products->first()->id === 36)
            ->assertSee('Prodotto 43');
    }

    public function test_filters_and_sorting_reset_the_current_page(): void
    {
        Livewire::test(Shop::class)
            ->call('setPage', 2)
            ->set('typeId', 2)
            ->assertSet('page', 1)
            ->assertSet('productCount', 3)
            ->assertSet('products', fn ($products) => $products->count() === 3)
            ->set('typeId', null)
            ->call('setPage', 2)
            ->set('search', 'Prodotto 43')
            ->assertSet('page', 1)
            ->assertSet('productCount', 1)
            ->set('search', null)
            ->call('setPage', 2)
            ->set('sort', 'new')
            ->assertSet('page', 1);
    }

    public function test_pages_are_clamped_to_the_available_range(): void
    {
        Livewire::test(Shop::class)
            ->call('setPage', 999)
            ->assertSet('page', 2)
            ->call('setPage', -1)
            ->assertSet('page', 1)
            ->set('page', 999)
            ->assertSet('page', 2);
    }

    public function test_empty_results_display_the_empty_state_without_pagination(): void
    {
        Livewire::test(Shop::class)
            ->call('setPage', 2)
            ->set('search', 'missing-product')
            ->assertSet('page', 1)
            ->assertSet('productCount', 0)
            ->assertSee('Nessun prodotto trovato.')
            ->assertDontSee('Successiva');
    }
}
