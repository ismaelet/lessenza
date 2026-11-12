<?php

namespace App\Filament\Resources\Products\Pages;

use App\Filament\Resources\Products\ProductResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;

    protected function afterCreate(): void
    {
        $this->record->slug = $this->record->id.'-'.str()->slug($this->record->name);
        $this->record->save();

        $tempImagePath = storage_path('app/public/products/temp-1024.webp');
        $newImagePath = storage_path('app/public/products/'.$this->record->id.'-1024.webp');

        if (file_exists($tempImagePath)) {
            rename($tempImagePath, $newImagePath);
        }
    }
}
