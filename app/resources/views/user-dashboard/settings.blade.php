<x-layouts.user-dashboard
	:$title
	:$location
>

	<div class="page-block grid grid-cols-1 gap-12">
		<section>
			<x-user-dashboard.heading icon="settings">
				{{ __('Impostazioni') }}
			</x-user-dashboard.heading>

			<div class="mt-8">
				<form
					action="{{ route('user-dashboard.settings.update') }}"
					method="POST"
					class="grid gap-4"
				>
					@csrf

					<p>{{ __('Qui puoi modificare i tuoi dati personali.') }}</p>

					@session('success')
						<x-alerts.success :message="session('success')" />
					@endsession

					<x-form.field>
						<x-label label="{{ __('E-mail:') }}" />
						<x-input
							type="email"
							name="email"
							placeholder="{{ __('E-mail') }}"
							value="{{ old('email', auth()->user()->email) }}"
							required
						/>

						@error('email')
							<x-alerts.error :message="$message" />
						@enderror
					</x-form.field>

					<x-form.field>
						<x-label label="{{ __('Nome completo:') }}" />
						<div class="grid gap-x-2 gap-y-[inherit] md:grid-cols-2">
							<x-input
								type="text"
								name="first_name"
								placeholder="{{ __('Nome') }}"
								value="{{ old('first_name', auth()->user()->first_name) }}"
							/>

							<x-input
								type="text"
								name="last_name"
								placeholder="{{ __('Cognome') }}"
								value="{{ old('last_name', auth()->user()->last_name) }}"
							/>
						</div>

						@error('first_name')
							<x-alerts.error :message="$message" />
						@enderror

						@error('last_name')
							<x-alerts.error :message="$message" />
						@enderror
					</x-form.field>

					<div class="flex justify-center">
						<x-button
							type="submit"
							size="small"
						>{{ __('Salva modifiche') }}</x-button>
					</div>
				</form>
			</div>

			<div class="mt-12">
				<x-user-dashboard.heading icon="password">
					Password
				</x-user-dashboard.heading>

				<p class="mt-4">{{ __('Qui puoi modificare la tua password.') }}</p>

				@session('success_password')
					<x-alerts.success :message="session('success_password')" />
				@endsession

				<form
					action="{{ route('user-dashboard.settings.password.update') }}"
					method="POST"
					class="mt-8 grid gap-4"
				>
					@csrf

					<x-form.field>
						<x-label label="{{ __('Password attuale:') }}" />
						<x-input
							type="password"
							name="current_password"
							placeholder="{{ __('Password attuale') }}"
							required
						/>

						@error('current_password')
							<x-alerts.error :message="$message" />
						@enderror
					</x-form.field>

					<x-form.field>
						<x-label label="{{ __('Nuova password:') }}" />
						<x-input
							type="password"
							name="new_password"
							placeholder="{{ __('Nuova password') }}"
							required
						/>

						@error('new_password')
							<x-alerts.error :message="$message" />
						@enderror
					</x-form.field>

					<x-form.field>
						<x-label label="{{ __('Conferma nuova password:') }}" />
						<x-input
							type="password"
							name="new_password_confirmation"
							placeholder="{{ __('Conferma nuova password') }}"
							required
						/>

						@error('new_password_confirmation')
							<x-alerts.error :message="$message" />
						@enderror
					</x-form.field>

					<div class="flex justify-center">
						<x-button
							type="submit"
							size="small"
						>{{ __('Cambia password') }}</x-button>
					</div>
				</form>
			</div>
		</section>
	</div>

</x-layouts.user-dashboard>
