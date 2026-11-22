@php
    $title = __('Aggiornamento dell’ordine :order', ['order' => $order->id_code]);
    $showRecap = in_array($order->status, [0, 1, 2]);
    $status = match ($order->status) {
        2 => __('CONFERMATO'),
        3 => __('SPEDITO'),
        4 => __('CONSEGNATO'),
        default => null,
    };
    $info = match ($order->status) {
        -1 => e(__('Il suo ordine è stato cancellato.')),
        0, 1 => e(__('Grazie per l’acquisto su :name. L’ordine è stato ricevuto e sarà processato al più presto.', ['name' => config('app.name')])),
        2, 3, 4 => e(__('Abbiamo aggiornato lo stato dell’ordine. Il nuovo stato è:')).'<br><strong>'.e($status).'</strong>',
        default => false,
    };
@endphp

<x-layouts.email>
	<table width="100%">

		<tr>
			<td>
				<h2 style="font-size: 20px; font-weight: 600; color: hsl(0, 0%, 13%)">{{ $title }}</h2>
			</td>
		</tr>

		<tr>
			<td style="padding: 32px; background-color: #f4f4f4; text-align: center">
				<p>{!! $info !!}</p>
			</td>
		</tr>

		<tr>
			<td style="padding-top: 32px">
				<center>
					<a href="{{ $order->recapUrlWithToken() }}">
						<p
							style="
							display: inline-block;
							padding: 0 32px;
							background-color: hsl(358deg, 93%, 74%);
							border-radius: 32px;
							color: #fff;
							font-size: 18px;
							font-weight: 500;
							line-height: 2.6;
							text-decoration: none;
						"
						>
							{{ __('Visualizza l\'ordine') }}
						</p>
					</a>
				</center>
			</td>
		</tr>

		@if ($showRecap)
			<tr>
				<td style="padding-top: 32px">
					<h2 style="padding-top: 16px; border-top: 1px solid #ebebeb; line-height: 2">{{ __('Riepilogo dell\'ordine') }}</h2>
					<table
						width="100%"
						style="border: 1px solid #ebebeb; padding: 2rem"
					>
						<tr>
							<td
								width="50%"
								style="padding-right: 32px; vertical-align: top"
							>
								<p style="font-weight: 600; margin-bottom: 8px">{{ __('Informazioni di contatto') }}</p>
								<p style="margin-bottom: 16px">{!! $order->address->email . '<br>' . $order->address->phone !!}</p>
							</td>
							<td style="padding-left: 32px; vertical-align: top">
								<p style="font-weight: 600; margin-bottom: 8px">{{ __('Forma di pagamento') }}</p>
								<p style="margin-bottom: 16px">{{ localized_text($order->payment_method->name ?? '-') }}</p>
							</td>
						</tr>

						<tr>
							<td
								width="50%"
								style="padding-right: 32px; vertical-align: top"
							>
								<p style="font-weight: 600; margin-bottom: 8px">{{ __('Indirizzo di spedizione') }}</p>
								<p>{!! implode('<br>', $order->address->full_address) !!}</p>
							</td>
							<td style="padding-left: 32px; vertical-align: top">
								<p style="font-weight: 600; margin-bottom: 8px">{{ __('Tipo di spedizione') }}</p>
								<p>{!! localized_html($order->shipping_method->name) !!}</p>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td>
					<h2 style="padding-top: 32px; border-bottom: 1px solid #ebebeb; line-height: 2">{{ __('Prodotti') }}</h2>
					<table
						width="100%"
						style="border-collapse: collapse"
					>

						@foreach ($order->order_items as $orderItem)
							<tr style="border-bottom: 1px solid #f4f4f4">
								<td>
									<p style="line-height: 3">{{ localized_text($orderItem->name) }}</p>
								</td>
								<td>
									<p style="text-align: right">{{ price($orderItem->total_price_net) }}</p>
								</td>
							</tr>
						@endforeach

						<tr>
							<td>
								<p style="">{{ __('Spedizione:') }}</p>
							</td>
							<td>
								<p style="text-align: right">{{ price($order->shipping_fee_net) }}</p>
							</td>
						</tr>

						<tr>
							<td>
								<p style="">{{ __('IVA:') }}</p>
							</td>
							<td>
								<p style="text-align: right">{{ price($order->vat) }}</p>
							</td>
						</tr>
						<tr>
							<td>
								<p><strong>{{ __('Totale dell\'ordine:') }}</strong></p>
							</td>
							<td>
								<p style="text-align: right"><strong>{{ price($order->total_price_gross) }}</strong></p>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		@endif
	</table>
</x-layouts.email>
