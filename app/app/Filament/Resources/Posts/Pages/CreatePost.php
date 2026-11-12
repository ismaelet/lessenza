<?php

namespace App\Filament\Resources\Posts\Pages;

use App\Filament\Resources\Posts\PostResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePost extends CreateRecord
{
    protected static string $resource = PostResource::class;

    protected function afterCreate(): void
    {
        $record = $this->record;
        $tempImagePath = storage_path('app/public/blog/temp-full.webp');
        $newImagePath = storage_path('app/public/blog/'.$record->id.'-full.webp');

        if (file_exists($tempImagePath)) {
            rename($tempImagePath, $newImagePath);
        }
    }
}
