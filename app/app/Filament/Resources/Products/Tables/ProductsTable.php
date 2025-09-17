<?php

namespace App\Filament\Resources\Products\Tables;

use Dom\Text;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProductsTable {
	public static function configure(Table $table): Table {
		return $table
			->defaultSort('id', 'desc')
			->columns([
				ImageColumn::make('storage_image_path')
					->label('')
					->imageSize(64)
					->checkFileExistence(false)
					->disk('public')
					->toggleable(),
				TextColumn::make('id')
					->label('ID')
					->searchable()
					->sortable(),
				TextColumn::make('name')
					->label('Nome')
					->searchable()
					->sortable(),
				TextColumn::make('product_type.name')
					->label('Tipo')
					->searchable()
					->sortable(),
				TextColumn::make('description')
					->label('Descrizione')
					->formatStateUsing(fn($state) => str()->limit(strip_tags($state), 100))
					->html()
					->wrap()
					->sortable(),
				TextColumn::make('created_at')
					->label('Aggiunto il')
					->dateTime('d/m/Y')
					->sortable(),
			])
			->filters([
				//
			])
			->recordActions([
				EditAction::make()
					->color('info'),
				DeleteAction::make(),
			])
			->toolbarActions([
				BulkActionGroup::make([
					DeleteBulkAction::make(),
				]),
			]);
	}
}
