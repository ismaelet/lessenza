<?php

namespace App\Filament\Resources\OrderItems\Tables;

use App\Models\OrderItem;
use Dom\Text;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Contracts\Database\Query\Builder;

class OrderItemsTable {
	public static function configure(Table $table): Table {
		return $table
			->query(function (): Builder {
				return OrderItem::with('product');
			})
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
			->filters([
				//
			])
			->recordActions([
				EditAction::make(),
			])
			->toolbarActions([
				BulkActionGroup::make([
					DeleteBulkAction::make(),
				]),
			]);
	}
}
