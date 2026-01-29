@props(['label' => $slot])

@pushOnce('styles')
	<style>
		.label:has(+ input:required)::after {
			content: '*';
			color: var(--color-red-600);
		}
	</style>
@endpushOnce

<label {{ $attributes->merge(['class' => 'label font-medium text-neutral-700 dark:text-neutral-50']) }}>
	{{ $label }}
</label>
