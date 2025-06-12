@pushOnce('styles')
	<link
		rel="stylesheet"
		href="{{ asset('css/legacy/contacts.css') }}"
	>
@endpushOnce

<x-layouts.legacy-main
	:$title
	:$location
	:headerConfig="['floating' => true]"
>
	<x-page-header
		class="dark"
		image="contacts-background.webp"
		:$title
	/>

	<div
		class="main-wrap pad-v-7 grid"
		data-align="top"
		data-columns="25rem"
		data-row-spacing="600"
		data-column-spacing="900"
	>

		<!-- Contacts data -->
		<section
			class="grid"
			data-spacing="800"
		>
			<x-heading.section>L<span class="text-primary font-medium">'</span>Essenza<span class="text-primary">.</span>
			</x-heading.section>

			<p class="">
				Se hai dubbi, domande o vuoi richiedere un'informazione, compila il modulo di contatto che trovi in questa pagina
				oppure usando uno dei link di contatto qui sotto, ti risponderemo nel più breve tempo possibile.
			</p>

			<div
				class="contacts grid"
				data-spacing="400"
			>

				@foreach (config('custom.contacts') as $contactTag => $contact)
					<div class="contact">
						<a
							class="contact__icon grid aspect-square place-items-center text-white"
							href="{{ $contact['url'] }}"
							target="_blank"
						>
							<x-dynamic-component
								:component="'icon-' . $contactTag"
								class="h-[40%] w-[40%]"
							/>
						</a>

						<div class="contact__content">
							<p class="contact__label">{{ $contact['title'] }}</p>
							<p>
								<a
									class="fc-hover-primary"
									href="{{ $contact['url'] }}"
									target="_blank"
								>{{ $contact['label'] }}</a>
							</p>
						</div>
					</div>
				@endforeach

			</div>
		</section>

		<!-- Contact form -->
		<section class="contact-form">
			<form
				method="POST"
				autocomplete="off"
			>
				<div
					class="grid"
					data-spacing="700"
				>
					<div
						class="grid"
						data-spacing="400"
					>
						@session('success')
							<x-alerts.success>{{ $value }}</x-alerts.success>
						@endsession

						@session('error')
							<x-alerts.error :$message />
						@endsession

						<div class="animated-field">
							<p class="animated-field__label">Nome</p>
							<input
								type="text"
								name="name"
								class="animated-field__input"
								onfocus="$(this).parents('.animated-field').addClass('is-used')"
								onblur="if (!$(this).val().length) {$(this).parents('.animated-field').removeClass('is-used')}"
								required
							>
						</div>

						<div class="animated-field">
							<p class="animated-field__label">Indirizzo e-mail</p>
							<input
								type="email"
								name="email"
								class="animated-field__input"
								onfocus="$(this).parents('.animated-field').addClass('is-used')"
								onblur="if (!$(this).val().length) {$(this).parents('.animated-field').removeClass('is-used')}"
								required
							>
						</div>

						<div class="animated-field">
							<p class="animated-field__label">Testo</p>
							<textarea
							 name="text"
							 class="animated-field__input"
							 maxlength="1000"
							 onfocus="$(this).parents('.animated-field').addClass('is-used')"
							 onblur="if (!$(this).val().length) {$(this).parents('.animated-field').removeClass('is-used')}"
							 required
							></textarea>
						</div>
					</div>

					<x-button
						type="submit"
						class="place-right"
					>Invia</x-button>
				</div>
			</form>
		</section>
	</div>
</x-layouts.legacy-main>
