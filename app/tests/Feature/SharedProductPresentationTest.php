<?php

use App\Http\Controllers\EssentialOilController;
use App\Http\Controllers\ProductController;
use App\Livewire\Product\AddToCart;
use App\Livewire\Product\ExtraConcentratedCheck;
use App\Models\OrderItem;
use App\Models\Product;
use App\Support\EssentialOilCatalogue;
use App\Support\StorefrontItem;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Livewire\Livewire;
use Tests\TestCase;

class SharedProductPresentationTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        config(['database.connections.sqlite.database' => ':memory:']);
        DB::purge('sqlite');
        DB::setDefaultConnection('sqlite');
        app()->setLocale('it');

        Schema::create('product_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->foreignId('product_type_id');
            $table->text('description')->nullable();
            $table->text('ingredients')->nullable();
            $table->text('uses')->nullable();
            $table->text('warnings')->nullable();
            $table->float('price')->nullable();
            $table->boolean('inStock')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
        DB::table('product_types')->insert(['id' => 1, 'name' => 'Bagno Turco']);
        DB::table('products')->insert([
            'id' => 1, 'name' => 'Limone', 'slug' => '1-limone', 'product_type_id' => 1,
            'description' => '<p>Una Fragranza immancabile per l’estate.</p>',
            'ingredients' => 'Acqua, Citrus Lemon Oil', 'uses' => '<p>Usage instructions</p>',
            'warnings' => '<p>Product warnings</p>',
        ]);
    }

    public function test_both_routes_use_one_detail_template_with_conditional_fields(): void
    {
        $productView = app(ProductController::class)->show(Product::firstOrFail());
        $oilView = app(EssentialOilController::class)->show('anice', new EssentialOilCatalogue);
        $this->assertSame('product', $productView->name());
        $this->assertSame($productView->name(), $oilView->name());

        $item = $productView->getData()['item'];
        $this->assertInstanceOf(Product::class, $item->product);
        $this->assertTrue($item->product->canBeExtraConcentrated());
        $this->assertTrue($item->product->hasPromotion());
        $this->assertSame('Acqua, Citrus Lemon Oil', $item->ingredients);
        $this->assertSame('<p>Usage instructions</p>', $item->usageHtml);
        $this->assertSame('<p>Product warnings</p>', $item->warningsHtml);
        $this->assertNull($item->safety);
        $this->assertSame([], $item->variants);
        $this->assertCount(1, $item->gallery);

        $oil = $oilView->getData()['item'];
        $this->assertNull($oil->product);
        $this->assertCount(2, $oil->variants);
        $this->assertSame($oil->image, $oil->gallery[0]['src']);
        $this->assertCount(2, $oil->gallery);
        $this->assertSame('AANI-30', $oil->variants[0]['code']);
        $this->assertStringContainsString('Anice_30ml.jpg', $oil->gallery[1]['src']);
        $this->assertSame('AANI-100', $oil->variants[1]['code']);
        $this->assertSame('AANI-30', $oil->metadata['Codice']);
        $this->assertArrayNotHasKey('Nome botanico', $oil->metadata);
        $this->assertStringContainsString('formato=100%20ml', $oil->variants[1]['enquiryUrl']);
        $this->assertStringContainsString('SDS_Anice.pdf', $oil->safety['url']);
    }

    public function test_one_card_renders_products_and_oils_in_both_languages(): void
    {
        $product = Product::firstOrFail();
        $oil = (new EssentialOilCatalogue)->all()->first();
        $productHtml = Blade::render('<x-product-card :$product />', compact('product'));
        $oilHtml = Blade::render('<x-product-card :product="$oil" />', compact('oil'));
        $this->assertStringContainsString('1-limone', $productHtml);
        $this->assertStringContainsString('49,90', $productHtml);
        $this->assertStringNotContainsString('Pimpinella anisum', $productHtml);
        $this->assertStringContainsString('Pimpinella anisum', $oilHtml);
        $this->assertStringContainsString('15,90', $oilHtml);
        $this->assertStringContainsString('product-card__link', $oilHtml);

        app()->setLocale('en');
        $item = new StorefrontItem((new EssentialOilCatalogue)->all()->first());
        $html = Blade::render('<x-product-card :product="$item" />', compact('item'));
        $this->assertStringContainsString('Anise', $html);
        $this->assertStringContainsString('from', $html);
        $this->assertStringContainsString('+ VAT', $html);
    }

    public function test_database_oils_keep_purchasing_and_gain_their_safety_data(): void
    {
        $product = Product::firstOrFail();
        $product->slug = 'olio-essenziale-anice-100ml';
        $product->price = 35.9;
        $item = new StorefrontItem($product);
        $this->assertSame($product, $item->product);
        $this->assertFalse($item->priceFrom);
        $this->assertSame(1, $item->selectedVariant);
        $this->assertSame('AANI-100', $item->metadata['Codice']);
        $this->assertStringContainsString('/products/olio-essenziale-anice-30ml', $item->variants[0]['productUrl']);
        $this->assertSame('84650-59-9', $item->metadata['CAS']);
        $this->assertStringContainsString('anteprima/Anice.jpg', $item->image);
        $this->assertSame($product->priceString(), $item->priceLabel);
    }

    public function test_oil_sizes_share_base_gallery_images_but_keep_their_product_selection(): void
    {
        $product = Product::firstOrFail();
        $product->slug = 'olio-essenziale-anice-30ml';
        $small = new StorefrontItem($product);
        $product->slug = 'olio-essenziale-anice-100ml';
        $large = new StorefrontItem($product);

        $this->assertSame(array_column($small->gallery, 'src'), array_column($large->gallery, 'src'));
        $this->assertSame(0, $small->selectedVariant);
        $this->assertSame(1, $large->selectedVariant);
        $this->assertCount(2, $large->gallery);
        $this->assertStringContainsString('Anice_30ml.jpg', $large->gallery[1]['src']);
        $this->assertSame('AANI-100', $large->variants[1]['code']);
    }

    public function test_optional_empty_fields_are_hidden_and_availability_is_retained(): void
    {
        $product = Product::firstOrFail();
        $product->uses = '<p>&nbsp;</p>';
        $product->warnings = ' ';
        $product->ingredients = '';
        $product->inStock = false;
        $item = new StorefrontItem($product);
        $this->assertNull($item->usageHtml);
        $this->assertNull($item->warningsHtml);
        $this->assertNull($item->ingredients);
        $html = Livewire::test(AddToCart::class, ['product' => $product])->html();
        $document = new DOMDocument;
        @$document->loadHTML($html);
        $purchaseButtonFound = false;
        foreach ($document->getElementsByTagName('button') as $button) {
            if ($button->getAttribute('wire:click') === 'addToCart') {
                $purchaseButtonFound = true;
                $this->assertTrue($button->hasAttribute('disabled'));
            }
        }
        $this->assertTrue($purchaseButtonFound);
        Livewire::test(ExtraConcentratedCheck::class)->set('extraConcentrated', true)->assertDispatched('extraConcentratedUpdated', true);
    }

    public function test_add_to_cart_preserves_quantity_extra_concentration_pricing_and_events(): void
    {
        $this->createCartTables();

        Livewire::test(AddToCart::class, ['product' => Product::firstOrFail()])
            ->set('quantity', 3)
            ->call('extraConcentratedUpdated', true)
            ->call('addToCart')
            ->assertHasNoErrors()
            ->assertSet('quantity', 1)
            ->assertDispatched('updateCart')
            ->assertDispatched('meta-add-to-cart');

        $line = OrderItem::firstOrFail();
        $this->assertSame(3, $line->quantity);
        $this->assertEquals(1, $line->extra_concentrated);
        $this->assertEqualsWithDelta(54.9, $line->unit_price_net, 0.001);
        $this->assertEqualsWithDelta(164.7, $line->total_price_net, 0.001);
    }

    public function test_oil_order_buttons_add_the_matching_size_at_its_database_price(): void
    {
        $this->createCartTables();
        foreach ([['30ml', 15.9], ['100ml', 35.9]] as [$size, $price]) {
            DB::table('products')->insert([
                'name' => 'Anice '.$size,
                'slug' => 'olio-essenziale-anice-'.$size,
                'product_type_id' => 1,
                'price' => $price,
            ]);
        }
        $data = app(EssentialOilController::class)->show('anice', new EssentialOilCatalogue)->getData();
        $products = $data['purchaseProducts'];
        $this->assertCount(2, $products);

        foreach ([['30ml', 15.9], ['100ml', 35.9]] as [$size, $price]) {
            $product = $products['olio-essenziale-anice-'.$size];
            Livewire::test(AddToCart::class, [
                'product' => $product,
                'label' => "Aggiungi all'ordine",
                'showQuantity' => false,
            ])->assertSee("Aggiungi all'ordine")
                ->assertDontSee('name="quantity"', false)
                ->call('addToCart')
                ->assertHasNoErrors()
                ->assertDispatched('updateCart')
                ->assertDispatched('meta-add-to-cart');

            $line = OrderItem::where('product_id', $product->id)->firstOrFail();
            $this->assertSame(1, $line->quantity);
            $this->assertEqualsWithDelta($price, $line->unit_price_net, 0.001);
        }
        $this->assertDatabaseCount('order_items', 2);
    }

    private function createCartTables(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->foreignId('address_id')->nullable();
            $table->foreignId('shipping_method_id')->nullable();
            $table->foreignId('payment_method_id')->nullable();
            $table->integer('status')->default(0);
            $table->integer('quantity')->default(0);
            foreach (['items_price_net', 'shipping_fee_net', 'vat', 'total_price_gross'] as $field) {
                $table->float($field)->default(0);
            }
            $table->timestamps();
        });
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id');
            $table->foreignId('product_id');
            $table->integer('quantity');
            $table->boolean('extra_concentrated')->default(false);
            $table->float('unit_price_net')->nullable();
            $table->float('total_price_net')->nullable();
            $table->timestamps();
        });
        foreach (['shipping_methods', 'payment_methods'] as $name) {
            Schema::create($name, function (Blueprint $table) {
                $table->id();
                $table->string('name');
            });
            DB::table($name)->insert(['id' => 1, 'name' => 'Default']);
        }

    }
}
