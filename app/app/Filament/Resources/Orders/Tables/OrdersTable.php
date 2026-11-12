<?php

namespace App\Filament\Resources\Orders\Tables;

use App\Models\Order;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Contracts\Database\Query\Builder;

class OrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            // The query that should be used to fetch records. This query
            ->query(function (): Builder {
                return Order::where('status', '!=', 0)
                    ->with('order_items', 'order_items.product');
            })
            ->columns([
                // ID
                TextColumn::make('id')
                    ->state(function (Order $record): string {
                        return $record->id_code;
                    })
                    ->searchable()
                    ->sortable()
                    ->numeric()
                    ->label('ID'),

                // Recipient
                TextColumn::make('address.full_name')
                    ->state(function (Order $record): array {
                        return $record->address->full_address;
                    })
                    ->label('Destinatario')
                    ->placeholder('-')
                    ->listWithLineBreaks()
                    ->wrap()
                    ->searchable(query: function (Builder $query, $search) {
                        $query->whereHas('address', function (Builder $query) use ($search) {
                            $query->where('full_name', 'like', '%'.$search.'%')
                                ->orWhere('street', 'like', '%'.$search.'%')
                                ->orWhere('city', 'like', '%'.$search.'%')
                                ->orWhere('zip', 'like', '%'.$search.'%')
                                ->orWhere('region', 'like', '%'.$search.'%')
                                ->orWhere('email', 'like', '%'.$search.'%');
                        });
                    })
                    ->sortable(),

                // Products
                TextColumn::make('order_items.full_name')
                    ->state(function (Order $record): array {
                        return $record->order_items->pluck('full_name')->toArray();
                    })
                    ->label('Articoli')
                    ->listWithLineBreaks()
                    ->wrap()
                    ->searchable(query: function (Builder $query, $search) {
                        $query->whereHas('order_items', function (Builder $query) use ($search) {
                            $query
                                ->WhereHas('product', function (Builder $query) use ($search) {
                                    $query->where('name', 'like', '%'.$search.'%');
                                });
                        });
                    })
                    ->placeholder('nessun articolo'),

                // Total price
                TextColumn::make('price')
                    ->label('Totale')
                    ->money(currency: 'EUR')
                    ->sortable(),

                // Status
                SelectColumn::make('status')
                    ->label('Stato')
                    ->sortable()
                    ->label('Stato')
                    ->options(
                        [
                            -1 => '<span class="text-red-500">Annullato</span>',
                            1 => '<span class="text-blue-500">In attesa di pagamento</span>',
                            2 => '<span class="text-green-500">Confermato</span>',
                            3 => '<span class="text-amber-500">Spedito</span>',
                            4 => '<span class="text-gray-500">Consegnato</span>',
                        ]
                    )
                    ->extraAttributes(['class' => 'select-order-status'])
                    ->allowOptionsHtml(true)
                    ->selectablePlaceholder(false),

                // Created at
                TextColumn::make('created_at')
                    ->label('Ricevuto il')
                    ->dateTime('d-m-Y')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([]),
            ]);
    }
}
