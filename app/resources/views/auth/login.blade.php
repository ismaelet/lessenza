@pushOnce('styles')
	<link
		rel="stylesheet"
		href="{{ asset('css/legacy/login.css') }}"
	>
@endpushOnce

<x-layouts.legacy-main
	:$location
	:$title
>
	<div class="page-content span-full-width">
		<!-- Welcome panel -->
		<section class="welcome stack-content center-content contrasting-background grid">
			<div
				class="welcome_bgr fill-all background-fill"
				<?= background_image('login-background.webp') ?>
			></div>

		</section>

		<!-- Form -->
		<form
			method="POST"
			action="{{ route('login.attempt') }}"
			class="form pos-rel"
		>

			@csrf

			<!-- Header -->
			<div class="form-head mb-8 text-center">
				<x-heading.section>Login</x-heading.section>
			</div>

			<!-- Body -->
			<div class="form-body">
				<x-input
					type="email"
					name="email"
					placeholder="E-mail"
					required
				/>
				<x-input
					type="password"
					name="password"
					placeholder="Password"
					required
				/>

				@error('email')
					<x-alert
						type="error"
						:$message
					/>
				@enderror

				<div class="flex flex-wrap items-center justify-between gap-4">
					<x-checkbox
						name="remember"
						label="Ricordami"
						checked
					/>

					<p class="hover:text-primary transition-colors"><a href="<?= client_url('/recover') ?>">Hai dimenticato la
							password?</a></p>

				</div>
			</div>

			<!-- Footer -->
			<div class="mx-auto mt-8 grid max-w-64 grid-cols-1 gap-2">
				<x-button
					type="submit"
					class=""
					size="small"
				>Log In</x-button>

				<x-button
					href="{{ route('register') }}"
					class=""
					variant="secondary"
					size="small"
				>Registrati</x-button>
			</div>
		</form>
	</div>
</x-layouts.legacy-main>
