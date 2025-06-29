<x-heading.component class="flex items-center gap-4">
	<x-dynamic-component
		:component="'icon-' . $icon"
		class="text-primary h-6 w-6"
	/>
	<span class="text-600">
		{{ $slot }}
	</span>

</x-heading.component>
