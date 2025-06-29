@props([
    'type' => 'checkbox',
    'name' => null,
    'value' => null,
    'checked' => false,
    'label' => null,
    'required' => false,
])

<label {{ $attributes->merge(['class' => 'checkbox flex items-center gap-2 relative w-fit group']) }}>
	<input
		type="{{ $type }}"
		name="{{ $name }}"
		class="hidden"
		@if ($value !== null) value="{{ $value }}" @endif
		@checked($checked)
		@required($required)
	>

	<span
		class="group/icon flex h-5 w-5 cursor-pointer rounded-full border border-neutral-300 transition-colors group-has-[:checked]:border-neutral-700"
	>
		<span
			class="bg-primary-400 m-auto h-2 w-2 rounded-full opacity-0 transition-opacity group-hover/icon:opacity-100 group-has-[:checked]:opacity-100"
		></span>
	</span>

	<p class="cursor-pointer leading-none">{!! $label !!}</p>
</label>
