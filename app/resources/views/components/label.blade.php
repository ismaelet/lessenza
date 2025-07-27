@props(['label'])

<label {{ $attributes->merge(['class' => 'font-medium  text-neutral-700 dark:text-neutral-50']) }}>
	{{ $slot }}
	{{ $label }}
</label>
