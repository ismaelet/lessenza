<?php

namespace App\Filament\Resources\Products\Pages;

use App\Filament\Resources\Products\ProductResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditProduct extends EditRecord {
	protected static string $resource = ProductResource::class;

	protected function handleRecordUpdate(Model $record, array $data): Model {
		$data['slug'] = $record->id . '-' . str()->slug($data['name']);

		$record->update($data);

		return $record;
	}

	protected function getHeaderActions(): array {
		return [
			DeleteAction::make(),
		];
	}
}
