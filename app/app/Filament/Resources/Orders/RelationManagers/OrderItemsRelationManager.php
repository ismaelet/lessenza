<?php

namespace App\Filament\Resources\Orders\RelationManagers;

use App\Models\OrderItem;
use Filament\Actions\CreateAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class OrderItemsRelationManager extends RelationManager {
    protected static string $relationship = 'order_items';

    protected static ?string $title = 'Articoli dell\'ordine';

    public function table(Table $table): Table {
        return $table
            ->columns([
                // ID
                TextColumn::make('id')
                    ->state(function (OrderItem $record): string {
                        return $record->id_code;
                    })
                    ->searchable()
                    ->sortable()
                    ->numeric()
                    ->label('ID'),
                TextColumn::make('product.name')
                    ->label('Prodotto')
                    ->sortable()
                    ->searchable()
                    ->placeholder('nessun articolo'),
                TextColumn::make('quantity')
                    ->label('Quantità')
                    ->sortable()
                    ->numeric(),
            ])
            ->headerActions([
                CreateAction::make(),
            ]);
    }
}
