@props(['message' => null])

@pushOnce('styles')
	<style>
		.error-message {
			box-shadow: 0px 2rem 4rem -1rem hsl(var(--color-error-400-hsl) / .4);
		}
	</style>
@endpushOnce

<p
	{{ $attributes->merge(['class' => 'error-message text-red-400 px-4 py-2 border border-red-400 bg-red-400/10 text-center rounded']) }}
>
	@if (isset($message))
		{{ $message }}
	@else
		{{ $slot }}
	@endif
</p>
