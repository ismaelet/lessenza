<?php

namespace App\Filament\Resources\Orders;

use App\Filament\Resources\Orders\Pages\CreateOrder;
use App\Filament\Resources\Orders\Pages\EditOrder;
use App\Filament\Resources\Orders\Pages\ListOrders;
use App\Filament\Resources\Orders\RelationManagers\OrderItemsRelationManager;
use App\Filament\Resources\Orders\Schemas\OrderForm;
use App\Filament\Resources\Orders\Tables\OrdersTable;
use App\Models\Order;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use UnitEnum;

class OrderResource extends Resource
{
    /**
     * Property: The model associated with the resource
     */
    protected static ?string $model = Order::class;

    /**
     * Property: The icon for the resource in the navigation
     */
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedShoppingBag;

    /**
     * Property: The label of a singular resource
     */
    protected static ?string $label = 'Ordine';

    /**
     * Property: The label of a plural resource
     */
    protected static ?string $pluralLabel = 'Ordini';

    /**
     * Determine whether the resource can be created
     */
    public static function canCreate(): bool
    {
        return false;
    }

    /**
     * Determine whether the resource can be deleted
     */
    public static function canDelete(Model $record): bool
    {
        return false;
    }

    /**
     * Property: The group the resource should be displayed in the navigation
     */
    protected static string|UnitEnum|null $navigationGroup = 'Vendite';

    public static function form(Schema $schema): Schema
    {
        return OrderForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return OrdersTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            OrderItemsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListOrders::route('/'),
            'create' => CreateOrder::route('/create'),
            'edit' => EditOrder::route('/{record}/edit'),
        ];
    }
}
