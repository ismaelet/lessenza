<?php

namespace App\Filament\Resources\ProductTypes;

use App\Filament\Resources\ProductTypes\Pages\CreateProductType;
use App\Filament\Resources\ProductTypes\Pages\EditProductType;
use App\Filament\Resources\ProductTypes\Pages\ListProductTypes;
use App\Filament\Resources\ProductTypes\Schemas\ProductTypeForm;
use App\Filament\Resources\ProductTypes\Tables\ProductTypesTable;
use App\Models\Product\ProductType;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class ProductTypeResource extends Resource {

	/**
	 * Property: The model associated with the resource
	 */
	protected static ?string $model = ProductType::class;

	/**
	 * Property: The icon for the resource in the navigation
	 */
	protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

	/**
	 * Property: The label of a singular resource
	 */
	protected static ?string $label = 'Categoria';

	/**
	 * Property: The label of a plural resource
	 */
	protected static ?string $pluralLabel = 'Categorie';

	/**
	 * Property: The group the resource should be displayed in the navigation
	 */
	protected static string|UnitEnum|null $navigationGroup = 'Negozio';

	/**
	 * Property: The position of the resource in the navigation
	 */
	protected static ?int $navigationSort = 2;

	public static function form(Schema $schema): Schema {
		return ProductTypeForm::configure($schema);
	}

	public static function table(Table $table): Table {
		return ProductTypesTable::configure($table);
	}

	public static function getRelations(): array {
		return [
			//
		];
	}

	public static function getPages(): array {
		return [
			'index' => ListProductTypes::route('/'),
			'create' => CreateProductType::route('/create'),
			'edit' => EditProductType::route('/{record}/edit'),
		];
	}
}
