<?php

namespace App\Filament\Resources\Orders\Schemas;

use App\Models\PaymentMethod;
use App\Models\ShippingMethod;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\View;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\Layout\Split;

class OrderForm {
	public static function configure(Schema $schema): Schema {
		return $schema
			->columns(['lg' => 4])
			->components([
				// First column
				Grid::make()
					->columnSpan(['lg' => 3])
					->schema([
						// Price
						Fieldset::make('Prezzo')
							->columnSpanFull()
							->schema([
								View::make('filament.forms.orders.order-items-recap')
									->columnSpanFull()
							]),

						// Address
						Fieldset::make('Destinatario')
							->relationship('address')
							->columnSpanFull()
							->columns(4)
							->schema([
								TextInput::make('full_name')
									->label('Nome completo')
									->placeholder('Nome e cognome')
									->required()
									->columnSpanFull(),

								TextInput::make('street')
									->label('Indirizzo')
									->placeholder('Indirizzo')
									->columnSpan(['lg' => 3]),

								TextInput::make('number')
									->label('Numero')
									->placeholder('Numero')
									->columnSpan(['lg' => 1]),

								TextInput::make('city')
									->label('Città')
									->placeholder('Città')
									->columnSpan(['lg' => 2]),

								TextInput::make('zip')
									->label('CAP')
									->placeholder('CAP')
									->length(5),

								TextInput::make('region')
									->label('Regione')
									->placeholder('Regione')
									->maxLength(2),

								TextInput::make('email')
									->label('E-mail')
									->placeholder('E-mail')
									->required()
									->suffixIcon('heroicon-o-envelope')
									->columnSpanFull(),

								TextInput::make('phone')
									->label('Telefono')
									->placeholder('Telefono')
									->required()
									->suffixIcon('heroicon-o-phone')
									->columnSpanFull(),
							]),
					]),

				// Second column
				Grid::make()
					->columnSpan(['lg' => 1])
					->schema([

						// Order details
						Fieldset::make('Dati dell\'ordine')
							->columnSpanFull()
							->schema([
								Select::make('status')
									->columnSpanFull()
									->label('Stato')
									->required()
									->options(
										[
											-1 => 'Annullato',
											1 => 'In attesa di pagamento',
											2 => 'Confermato',
											3 => 'Spedito',
											4 => 'Consegnato',
										]
									),
							]),

						// Shipping
						Fieldset::make('Spedizione')
							->columnSpanFull()
							->schema([
								Select::make('shipping_method_id')
									->columnSpanFull()
									->label('Metodo di spedizione')
									->options(
										ShippingMethod::all()->pluck('name', 'id')
									)
									->required(),

								TextInput::make('tracking')
									->label('Numero di tracking')
									->placeholder('-')
									->readOnly()
									->columnSpanFull(),
							]),

						// Payment
						Fieldset::make('Pagamento')
							->columnSpanFull()
							->schema([
								Select::make('payment_method_id')
									->columnSpanFull()
									->label('Metodo di pagamento')
									->options(
										PaymentMethod::all()->pluck('name', 'id')
									)
									->required(),

								TextInput::make('token')
									->label('Codice della transazione')
									->placeholder('-')
									->readOnly()
									->columnSpanFull(),
							]),
					])
			]);
	}
}
