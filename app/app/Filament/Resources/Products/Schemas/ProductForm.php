<?php

namespace App\Filament\Resources\Products\Schemas;

use App\Models\Product;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ProductForm {
	public static function configure(Schema $schema): Schema {
		return $schema
			->components([
				TextInput::make('name')
					->label('Nome')
					->required()
					->placeholder('Nome del prodotto')
					->maxLength(255),
				Select::make('product_type_id')
					->label('Tipo')
					->relationship('product_type', 'name')
					->required(),
				RichEditor::make('description')
					->label('Descrizione')
					->placeholder('Inserisci la descrizione del prodotto')
					->toolbarButtons([
						'bold',
						'italic',
						'underline',
						'strike',
						'bulletList',
						'orderedList',
						'link',
					])
					->maxLength(65535),
				RichEditor::make('uses')
					->label('Modalità d\'uso')
					->placeholder('Inserisci le modalità d\'uso del prodotto')
					->toolbarButtons([
						'bold',
						'italic',
						'underline',
						'strike',
						'bulletList',
						'orderedList',
						'link',
					])
					->maxLength(255),
				RichEditor::make('warnings')
					->label('Avvertenze')
					->placeholder('Inserisci le avvertenze del prodotto')
					->toolbarButtons([
						'bold',
						'italic',
						'underline',
						'strike',
						'bulletList',
						'orderedList',
						'link',
					])
					->maxLength(255),
				FileUpload::make('image')
					->label('Immagine')
					->placeholder('Carica l\'immagine del prodotto')
					->image()
					->imageEditor()
					->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
					->moveFiles()
					->disk('public')
					->directory('products')
					->imageResizeTargetWidth('1024')
					->getUploadedFileNameForStorageUsing(
						fn(Product $record): string => $record ? $record->id . '-1024.webp' : 'temp-1024.webp',
					)
					->columnSpanFull(),
			]);
	}
}
