<x-layouts.cart>
	<div class="grid grid-cols-1 gap-8">

		<form
			method="POST"
			action="{{ route('cart.payment.store') }}"
		>
			@csrf

			<div class="cart-panel surface content-start">
				<x-heading.small-component>Pagamento</x-heading.small-component>
				@foreach ($paymentMethods as $paymentMethod)
					<label
						class="chck_item grid grid-cols-[max-content_1fr] items-center gap-4 border-b border-neutral-200 last:border-0 sm:grid-cols-[5rem_1fr]"
					>
						<x-checkbox
							type="radio"
							name="payment_method_id"
							:value="$paymentMethod->id"
							:checked="cart()->payment_method_id == $paymentMethod->id"
						/>

						<div class="grid grid-cols-1 gap-2 py-8">
							<h4 class="text-xl font-medium text-neutral-700">{{ $paymentMethod->name }}</h4>

							<img
								class="max-h-18"
								src="{{ Vite::image('payment_methods/' . $paymentMethod->slug . '.webp') }}"
							/>

							<p class="pay_desc">{{ $paymentMethod->description }}</p>
						</div>
					</label>
				@endforeach
			</div>

			<div class="mb-8 mt-4">
				<x-marketing-consent />
			</div>

			<div class="flex justify-end">
				<x-button
					type="submit"
					class="button"
					name="advance"
				>Procedi</x-button>
			</div>
		</form>
	</div>
</x-layouts.cart>
