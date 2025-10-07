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
			action="{{ route('register.attempt') }}"
			class="form pos-rel"
		>

			@csrf

			<!-- Header -->
			<div class="form-head mb-8 text-center">
				<x-heading.section>Registrazione</x-heading.section>
			</div>

			<!-- Body -->
			<div class="form-body">
				<x-label label="E-mail:" />
				<x-input
					type="email"
					name="email"
					placeholder="E-mail"
					required
				/>

				@error('email')
					<x-alert
						type="error"
						:$message
					/>
				@enderror

				<x-label label="Password:" />
				<x-input
					type="password"
					name="password"
					placeholder="Password"
					required
				/>
				<x-input
					type="password"
					name="password_confirmation"
					placeholder="Password"
					required
				/>

				@error('password')
					<x-alert
						type="error"
						:$message
					/>
				@enderror

				<div class="">
					<p class="hover:text-primary transition-colors"><a href="{{ route('login') }}">Hai già un account?</a></p>
				</div>
			</div>

			<!-- Footer -->
			<div class="mx-auto mt-8 grid max-w-64 grid-cols-1 gap-2">
				<x-button
					type="submit"
					class=""
					size="small"
				>Registrati</x-button>

				<x-button
					href="{{ route('login') }}"
					class=""
					variant="secondary"
					size="small"
				>Indietro</x-button>
			</div>
		</form>
	</div>
</x-layouts.legacy-main>
