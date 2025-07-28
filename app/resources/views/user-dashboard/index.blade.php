@pushOnce('styles')
	<link
		rel="stylesheet"
		href="{{ asset('css/legacy/user-dashboard-index.css') }}"
	>
@endpushOnce

<x-layouts.user-dashboard
	:$title
	:$location
>

	<div class="page-block grid grid-cols-1 gap-12">
		<!-- Personal data -->
		<section>
			<x-user-dashboard.heading icon="user-circle">
				Account
			</x-user-dashboard.heading>

			<div class="">
				<div class="my-8 grid grid-cols-1">

					@if ($user->full_name)
						<p class="">Nome completo: <span class="text-strong">{{ $user->full_name }}</span></p>
					@endif

					<p class="">E-mail: <span class="text-strong">{{ $user->email }}</span></p>
				</div>

				<x-button
					href="{{ route('user-dashboard.settings') }}"
					class="inline-block"
					size="small"
					variant="secondary"
				>Modifica</x-button>
			</div>
		</section>

		<!-- Addresses -->
		<section>
			<x-user-dashboard.heading icon="address">
				Indirizzi registrati
			</x-user-dashboard.heading>

			<div class="mt-4">

				@if ($address)
					<div class="grid grid-cols-1 gap-8 lg:grid-cols-2">
						<div class="address rounded border border-neutral-300 p-4 sm:p-8">
							<p class="font-heading mb-2 text-lg font-medium text-neutral-700">Indirizzo di spedizione:</p>
							<p class="">
								<?= implode('<br>', $address->full_address) ?><br>
								-<br>
								<?= $address->email ?><br>
								<?= $address->phone ?>
							</p>
						</div>

						<div class="address rounded border border-neutral-300 p-4 sm:p-8">
							<h3 class="font-heading mb-2 text-lg font-medium text-neutral-700">Indirizzo di fatturazione:</h3>
							<p class="">
								<?= implode('<br>', $address->full_address) ?><br>
								-<br>
								<?= $address->email ?><br>
								<?= $address->phone ?>
							</p>
						</div>
					</div>

					<x-button
						href="{{ route('user-dashboard.settings') }}"
						class="mt-4 inline-block"
						variant="secondary"
						size="small"
					>Modifica</x-button>
				@else
					<p class="">Nessun indirizzo registrato</p>
				@endif

			</div>
		</section>
	</div>

</x-layouts.user-dashboard>
