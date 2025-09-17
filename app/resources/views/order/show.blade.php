@use('App\Helpers\EcommerceHelper')
@use('App\Helpers\PreviewHelper')

@pushOnce('styles')
	<style>
		.status-bar {
			h3 {
				color: inherit;
			}
		}

		.status-icon {
			--icon-size: 50%;
			border-color: currentColor;
		}

		.page-panel p-4 rounded border border-neutral-200 grid grid-cols-1 gap-2 {
			display: grid;
			gap: 1rem;
			padding: 1.5rem;
		}
	</style>
@endpushOnce

<x-layouts.legacy-main>

	<div class="full-width justify-items-center bg-neutral-200 py-20 text-center">
		<x-heading.section>
			Ordine <span class="text-primary">{{ $order->id_code }}</span>
		</x-heading.section>
	</div>

	<div class="mb-20 mt-12 grid gap-12">
		<div @class([
			'status-bar flex items-center justify-center gap-4',
			'text-red-400' => EcommerceHelper::statusColor($order->status) == 'red',
			'text-gray-400' => EcommerceHelper::statusColor($order->status) == 'gray',
			'text-sky-400' => EcommerceHelper::statusColor($order->status) == 'sky',
			'text-green-400' => EcommerceHelper::statusColor($order->status) == 'green',
			'text-amber-400' => EcommerceHelper::statusColor($order->status) == 'amber',
			'text-orange-400' =>
				EcommerceHelper::statusColor($order->status) == 'orange',
		])>
			<span class="status-icon grid aspect-square w-12 place-items-center rounded-full border">
				<x-dynamic-component
					:component="'icon-' . EcommerceHelper::statusIcon($order->status)"
					class="w-1/2"
				/>
			</span>

			<x-heading.small-component>
				{{ EcommerceHelper::statusLabel($order->status) }}
			</x-heading.small-component>
		</div>

		<div class="grid items-start gap-6 sm:gap-8 lg:grid-cols-2 lg:gap-12">
			<div class="grid gap-6 sm:gap-8">
				{{-- Payment --}}
				<article class="grid grid-cols-1 gap-2 rounded border border-neutral-200 p-4">
					<x-subheading.component>
						Metodo di pagamento
					</x-subheading.component>

					<x-heading.small-component>{{ $order->payment_method?->name }}</x-heading.small-component>
				</article>

				{{-- Shipping --}}
				<article class="grid grid-cols-1 gap-2 rounded border border-neutral-200 p-4">
					<x-subheading.component>Metodo di spedizione</x-subheading.component>

					<x-heading.small-component>
						{!! $order->shipping_method->name !!}
					</x-heading.small-component>

					<div>
						<p>
							{!! $order->shipping_method->deliveryDateString() !!}
						</p>
					</div>
				</article>

				{{-- Address --}}
				<article class="grid grid-cols-1 gap-2 rounded border border-neutral-200 p-4">
					<x-heading.small-component>Indirizzo</x-heading.small-component>

					<p>
						{!! implode('<br>', $order->address?->full_address) !!}<br>
						-<br>
						{{ $order->address?->email ?? '' }}<br>
						{{ $order->address?->phone ?? '' }}
					</p>

				</article>
			</div>

			<div class="grid gap-6 sm:gap-8">
				<article class="grid grid-cols-1 gap-2 rounded border border-neutral-200 p-4">
					<x-heading.small-component>Articoli</x-heading.small-component>

					@foreach ($order->order_items as $orderItem)
						<div class="grid grid-cols-2 items-center gap-4 md:grid-cols-4">
							<a
								href="{{ $orderItem->product ? $orderItem->product->url() : '' }}"
								class="img_cont"
							>
								<img
									src="{{ $orderItem->product->image }}"
									class="rounded"
								>
							</a>

							<!--Data-->
							<div class="md:col-span-3">
								<a href="{{ $orderItem->product ? $orderItem->product->url() : null }}">
									<h3 class="art_name">{{ $orderItem->name }}</h3>
								</a>

								<p class="font-semibold">
									{{ $orderItem->price }}
								</p>
							</div>
						</div>
					@endforeach

				</article>

				<article class="grid grid-cols-1 gap-2 rounded border border-neutral-200 p-4">
					<x-heading.small-component>Riepilogo</x-heading.small-component>

					<div>
						<div class="flex justify-between gap-4 py-3">
							<p class="">Articoli</p>
							<p class="font-medium text-neutral-700">{{ $order->item_price }}</p>
						</div>

						<div class="border-border flex justify-between gap-4 border-t py-3">
							<p class="">Spedizione</p>
							<p class="font-medium text-neutral-700">{{ $order->shipping_fee }}</p>
						</div>

						<div class="border-border flex justify-between gap-4 border-t py-3 text-lg">
							<p class="">Totale</p>
							<p class="font-medium text-neutral-700">{{ $order->price }}</p>
						</div>
					</div>
				</article>
			</div>
		</div>
	</div>

</x-layouts.legacy-main>
