<?php

namespace App\Filament\Resources\Posts\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PostsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('id', 'desc')
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('title')
                    ->label('Titolo')
                    ->wrap()
                    ->searchable()
                    ->sortable(),
                TextColumn::make('text')
                    ->label('Contenuto')
                    ->wrap()
                    ->limit(200),
                IconColumn::make('has_video')
                    ->label('Ha video')
                    ->boolean()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Creato il')
                    ->date(),
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
