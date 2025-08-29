<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PostForm {
	public static function configure(Schema $schema): Schema {
		return $schema
			->components([
				TextInput::make('title')
					->label('Titolo')
					->placeholder('Inserisci il titolo')
					->required()
					->columnSpanFull(),
				Textarea::make('text')
					->label('Contenuto')
					->placeholder('Inserisci il contenuto')
					->required()
					->autosize()
					->columnSpanFull(),
				FileUpload::make('image')
					->label('Immagine')
					->image()
					->imageEditor()
					->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
					->moveFiles()
					->disk('public')
					->directory('blog')
					->getUploadedFileNameForStorageUsing(
						fn($record): string => $record ? $record->id . '-full.webp' : 'temp-full.webp',
					)
					->columnSpanFull(),

			]);
	}
}
