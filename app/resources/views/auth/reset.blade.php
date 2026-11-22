<x-layouts.form
	:title="$title"
	action="{{ route('auth.reset') }}"
	method="POST"
>

	<x-slot name="body">

		@if (session('submitted'))
			<p class="text-green-600">{{ __('Password cambiata con successo!') }}</p>
		@elseif (session('error'))
			<p class="text-red-600">{{ __('Il link di rest non è valido o è scaduto') }}</p>
		@else
			<p class="">
				{{ __('Inserisci qui sotto la nuova password desiderata:') }}
			</p>

			<x-input
				type="hidden"
				name="token"
				:value="$token"
			/>
			<x-input
				type="hidden"
				name="email"
				:value="$email"
			/>
			<x-input
				type="password"
				name="password"
				placeholder="{{ __('Nuova password') }}"
				required
			/>
			<x-input
				type="password"
				name="password_confirmation"
				placeholder="{{ __('Conferma la nuova password') }}"
				required
			/>

			@error('password')
				<x-alerts.error>{{ $message }}</x-alerts.error>
			@enderror
		@endif

	</x-slot>

	<x-slot name="footer">

		@if (session('error'))
			<x-button
				variant="secondary"
				href="{{ route('auth.recover') }}"
			>{{ __('Richiedi un nuovo codice') }}</x-button>
		@else
			@if (!session('submitted'))
				<x-button type="submit">{{ __('Reimposta la password') }}</x-button>
			@endif

			<x-button
				variant="secondary"
				:href="route('login')"
			>{{ __('Torna al login') }}</x-button>
		@endif

	</x-slot>

</x-layouts.form>
