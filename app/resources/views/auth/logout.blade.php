<x-layouts.form
	:$title
	:$location
	method="POST"
	action="{{ route('logout.attempt') }}"
>
	<x-slot:body>
		<p class="text-center">
			Desideri davvero disconnetterti?
		</p>
	</x-slot:body>

	<x-slot:footer>
		<x-button
			type="submit"
			size="small"
		>Esci</x-button>
		<x-button
			href="{{ route('user-dashboard.index') }}"
			variant="secondary"
			size="small"
		>Indietro</x-button>
	</x-slot:footer>
</x-layouts.form>
