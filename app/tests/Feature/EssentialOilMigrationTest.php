<?php

use App\Models\Product;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class EssentialOilMigrationTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        // Use an isolated database: the project imports its legacy schema outside migrations.
        config(['database.connections.sqlite.database' => ':memory:']);
        DB::purge('sqlite');
        DB::setDefaultConnection('sqlite');

        Schema::create('product_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50)->nullable();
            $table->string('slug', 50)->nullable();
            $table->text('description')->nullable();
            $table->text('description_short')->nullable();
            $table->string('ingredients', 200)->default('');
            $table->string('uses', 255);
            $table->string('warnings', 255);
            $table->integer('product_type_id')->default(1);
            $table->float('price')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function test_imports_all_formats_with_fixed_prices_and_complete_safety_information(): void
    {
        $this->migration()->up();

        $this->assertDatabaseCount('products', 32);
        $this->assertDatabaseCount('product_types', 1);
        $typeId = DB::table('product_types')->where('name', 'Oli essenziali Aufguss')->value('id');
        $catalogue = json_decode(file_get_contents(resource_path('data/oli-essenziali.json')), true, flags: JSON_THROW_ON_ERROR);

        foreach ($catalogue as $oil) {
            foreach ($oil['varianti'] as $variant) {
                $slug = 'olio-essenziale-'.$oil['slug'].'-'.str_replace(' ', '', $variant['formato']);
                $product = Product::where('slug', $slug)->firstOrFail();
                $this->assertEquals((float) str_replace(',', '.', $variant['prezzo_iva_esclusa']), $product->price());
                $this->assertEquals($typeId, $product->product_type_id);
                $this->assertStringContainsString($variant['codice'], $product->description);
                $this->assertStringContainsString($oil['cas'], $product->ingredients);
                $this->assertStringContainsString(htmlspecialchars($oil['frasi_H'], ENT_QUOTES, 'UTF-8'), $product->description);
                $this->assertStringContainsString('/oli-essenziali/'.$oil['scheda_sicurezza'], $product->description);
                $this->assertSame($oil['consiglio_uso'], $product->uses);
                $this->assertLessThanOrEqual(50, mb_strlen($product->name));
                $this->assertLessThanOrEqual(50, mb_strlen($product->slug));
                $this->assertLessThanOrEqual(255, mb_strlen($product->warnings));
            }
        }
    }

    public function test_reuses_an_existing_type_and_rolls_back_only_imported_products(): void
    {
        $typeId = DB::table('product_types')->insertGetId(['name' => 'Oli essenziali Aufguss']);
        DB::table('products')->insert([
            'name' => 'Existing product',
            'slug' => 'existing-product',
            'uses' => '',
            'warnings' => '',
            'product_type_id' => $typeId,
        ]);

        $migration = $this->migration();
        $migration->up();
        $this->assertDatabaseCount('products', 33);
        $this->assertDatabaseCount('product_types', 1);

        $migration->down();
        $this->assertDatabaseCount('products', 1);
        $this->assertDatabaseHas('products', ['slug' => 'existing-product']);
        $this->assertDatabaseHas('product_types', ['id' => $typeId]);

        $migration->up();
        $this->assertDatabaseCount('products', 33);
    }

    public function test_slug_collisions_abort_without_overwriting_existing_records(): void
    {
        DB::table('products')->insert([
            'name' => 'Existing Anice',
            'slug' => 'olio-essenziale-anice-30ml',
            'uses' => '',
            'warnings' => '',
            'price' => 99,
            'deleted_at' => now(),
        ]);

        try {
            $this->migration()->up();
            $this->fail('Expected a slug collision to abort the import.');
        } catch (RuntimeException $exception) {
            $this->assertStringContainsString('slug already exists', $exception->getMessage());
        }

        $this->assertDatabaseCount('products', 1);
        $this->assertDatabaseCount('product_types', 0);
        $this->assertDatabaseHas('products', ['name' => 'Existing Anice', 'price' => 99]);
    }

    public function test_moves_existing_safety_links_to_storage_and_restores_them_on_rollback(): void
    {
        $this->migration()->up();
        $product = Product::where('slug', 'olio-essenziale-anice-30ml')->firstOrFail();
        $original = $product->description;
        $product->update(['description' => $original.'<p>Custom content</p>']);

        $migration = require database_path('migrations/2026_11_23_120000_move_essential_oil_safety_links_to_public_storage.php');
        $migration->up();

        $this->assertSame(
            str_replace('href="/oli-essenziali/', 'href="/storage/oli-essenziali/', $original).'<p>Custom content</p>',
            $product->fresh()->description,
        );

        $migration->up();
        $this->assertStringNotContainsString('/storage/storage/', $product->fresh()->description);

        $migration->down();
        $this->assertSame($original.'<p>Custom content</p>', $product->fresh()->description);
    }

    private function migration(): Migration
    {
        return require database_path('migrations/2026_11_22_170000_add_aufguss_essential_oil_products.php');
    }
}
