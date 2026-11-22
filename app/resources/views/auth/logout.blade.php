<x-layouts.form
	:$title
	:$location
	method="POST"
	action="{{ route('logout.attempt') }}"
>
	<x-slot:body>
		<p class="text-center">
			{{ __('Desideri davvero disconnetterti?') }}
		</p>
	</x-slot:body>

	<x-slot:footer>
		<x-button
			type="submit"
			size="small"
		>{{ __('Esci') }}</x-button>
		<x-button
			href="{{ route('user-dashboard.index') }}"
			variant="secondary"
			size="small"
		>{{ __('Indietro') }}</x-button>
	</x-slot:footer>
</x-layouts.form>
